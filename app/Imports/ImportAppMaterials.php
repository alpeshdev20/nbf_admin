<?php

namespace App\Imports;

use App\Models\app_material;
use App\Models\genre;
use App\Models\app_department;
use App\Models\app_subject;
use App\Models\book_publisher;
use App\Models\material;
use App\Models\language;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Exception;


class ImportAppMaterials implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     if (!empty($row['isbn_code'])) {
    //        return new app_material([
    //             'isbn_code'    => $row['isbn_code'],
    //             'publisher_name'    => $row['publisher'], 
    //             'publication_year'    => $row['year'],
    //             'length'    => $row['length']??null, 
    //             'summary'    => $row['summary']??null, 
    //             'language'    => $row['language'], 
    //             'material_type'    => $row['material'], 
    //             'genre'    => $row['genre'], 
    //             'subgenre'    => $row['department'], 
    //             'author_name'    => $row['author'], 
    //         ]); 
    //     }
        
    // }

	
	private $rules=[
		"material"=>'required',
		"title"=>'required',
		"genre"=>'required',
		"department"=>'required',
		"subject"=>'required',
		"language"=>'required',
		"publisher"=>'required',
		"author"=>'required',
		"year"=>'required',
		"isbn_code"=>'required|unique:books,tags', // should be unique?, ask Angel.
		"length"=>'required',
		"summary"=>'present',
		"cover_file"=>'required',
		"content_file"=>'required',
	];
	
	private $locations;
	private $_errors;
	private $files_processed="";
	private $listener;
	
	
	public function setListener($lst){
		$this->listener=$lst;
	}
	
	public function setLocations($curr,$final){
		if($this->locations==null)$this->locations = Array();
		$this->locations['current']=$curr;
		$this->locations['final']=$final;
	}
	
	private function hd($val){
		return (isset($val) && !empty($val));
	}

    public function collection(Collection $rows)
    {
		
		if(!($this->locations!=null 
			&& array_key_exists('current',$this->locations) 
			&& array_key_exists('final',$this->locations) 
			&& !empty($this->locations['current'])
			&& !empty($this->locations['final'])
			))throw new Exception("Current or final location of the uploaded files is not set.");
		
		$d = DIRECTORY_SEPARATOR ;
		$total=count($rows);
		$t_count=0;
		$p_count=0;
		$this->_errors = Array();
        foreach ($rows as $row) 
        {
			
			// skip extra records in excel sheet, that have been added by the client to create dropdowns
			if(!$this->hd($row['isbn_code']))continue;
			$t_count++;
			$tname = ($this->hd($row['title']))?$row['title']:"Unknown Title";
			if($this->listener!=null){	
				$this->listener->publish_evt("Processing $tname...");
			}
			
			$row['genre'] = genre::where('genre_name',$row['genre'])->value('id');
			$row['department'] = app_department::where('department_name',$row['department'])->value('id');
			$row['subject'] = app_subject::where('subject_name',$row['subject'])->value('id');
			$row['publisher'] = book_publisher::where('publisher',$row['publisher'])->value('id');
			$row['material'] = material::where('material_type',$row['material'])->value('id');
			$row['language'] = language::where('language_name',$row['language'])->value('id');
			
			$validator = Validator::make($row->toArray(),$this->rules);
			if($validator->fails()){
				$this->_errors[$row['title']]='';
				$verr = $validator->messages()->get('*');
				foreach ($verr as $key => $value){
					$this->_errors[$row['title']] .= '-- '.implode(",",$value).'<br />';
				}
			}else{
				// all data entries are okay. proceed to files
				
				//TODO: Scenario where duplicate entries(file names) have been made in rows, needs to be handled.
				
				// create fhe final location dirs
				if(!file_exists($this->locations['final']) && !mkdir($this->locations['final'])){
					throw new Exception("Could not create the destination directory.");
				}
				
				// check if cover and content files are the same:
				if($row['cover_file']==$row['content_file']){
					$this->_errors[$row['title']] = (array_key_exists($row['title'],$this->_errors)?$this->_errors[$row['title']]:"")
															."-- Content and cover files cannot be the same.<br />";
				}

				// checking/moving cover file
				if(!file_exists($this->locations['current'].$d.$row['cover_file'])){
					$this->_errors[$row['title']] = "-- Cover file: {$row['cover_file']}, not uploaded.<br />";
				}else{
					//move file
					$ffn = $row['isbn_code'].'_'.$row['cover_file'];
					File::move($this->locations['current'].$d.$row['cover_file'],$this->locations['final'].$d.$ffn);
					$row['cover_file']=$ffn;
				}
				
				// checking/moving content file
				if(!file_exists($this->locations['current'].$d.$row['content_file'])){
					$this->_errors[$row['title']] = (array_key_exists($row['title'],$this->_errors)?$this->_errors[$row['title']]:"")
															."-- Content file: {$row['content_file']}, not uploaded.<br />";
				}else{
					//move file
					$ffn = $row['isbn_code'].'_'.$row['content_file'];
					File::move($this->locations['current'].$d.$row['content_file'],$this->locations['final'].$d.$ffn);
					$row['content_file']=$ffn;
				}
				
				// touch the database only if there are no errors.
				if(array_key_exists($row['title'],$this->_errors)!==true){
					$material=app_material::create([
						'material_type' => $row['material'] ?: 0,
						'book_name' => $row['title'],
						'genre_id'    => $row['genre'] ?: 0,
						'department_id' => $row['department'] ?: 0,
						'subject_id' => $row['subject'] ?: 0,
						'language'    => $row['language'] ?: 1,
						'Isbn_Code'    => $row['isbn_code'],
						'tags'    => $row['isbn_code'],
						'year'    => $row['year'],
						'publisher_id' => $row['publisher'] ?: 0,
						'length'    => $row['length']?:null, 
						'summary'    => $row['summary']?:null, 
						'author'    => $row['author'], 
						'book_image'    => $row['cover_file'], 
						'book_pdf'    => $row['content_file']
					]);
					$p_count++;
				}
				//calm down and obflush evt.
				usleep(250);
			}
			
			if(array_key_exists($row['title'],$this->_errors))
				$this->_errors[$row['title']] = '<br />Errors:<br />'.$this->_errors[$row['title']].'<br />';
			
			$this->files_processed=	$p_count.'/'.$t_count;
			usleep(250);			
			if($this->listener!=null){
				$this->listener->publish_evt("Done!");
			}
        }
		$this->listener=null;
    }
	
	public function getErrors(){
		return $this->_errors;
	}
	
	public function getFilesProcessed(){
		return $this->files_processed;
	}
	
	
	
	
}
