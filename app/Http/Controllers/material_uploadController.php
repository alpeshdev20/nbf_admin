<?php

namespace App\Http\Controllers;

use App\DataTables\material_uploadDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\Creatematerial_uploadRequest;
use App\Http\Requests\Updatematerial_uploadRequest;
use App\Repositories\material_uploadRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;
use App\Models\sgenre;
use App\Models\material;
use App\Models\language;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAppMaterials;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\File;



class material_uploadController extends AppBaseController
{
    /** @var  material_uploadRepository */
    private $materialUploadRepository;

    public function __construct(material_uploadRepository $materialUploadRepo)
    {
        $this->materialUploadRepository = $materialUploadRepo;
    }

    /**
     * Display a listing of the material_upload.
     *
     * @param material_uploadDataTable $materialUploadDataTable
     * @return Response
     */
    public function index(material_uploadDataTable $materialUploadDataTable)
    {
        return $materialUploadDataTable->render('material_uploads.index');
    }

    /**
     * Show the form for creating a new material_upload.
     *
     * @return Response
     */
    public function create()
    {

        $mat = material::orderBy('id')->pluck('material_type', 'material_type');
        $mdata = $mat->toArray();
		dd($mdata );
        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();
        return view('material_uploads.create')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata));
    }

    public function getGenreList(Request $request)
    {
        $states = DB::table("sgenre")
        ->where("genre",$request->genre)
        ->pluck("subgenre","id");
        return response()->json($states);
    }

    /**
     * Store a newly created material_upload in storage.
     *
     * @param Creatematerial_uploadRequest $request
     *
     * @return Response
     */
    public function store(Creatematerial_uploadRequest $request)
    {
        $input = $request->all();


        $input = $request->all();
        $file1 = $request->file('cover');  
        $fileName= $file1->getClientOriginalName();
     
        $fileName=str_replace(" ","_",$fileName);
       // return  $fileName;
        $file1->move(public_path('uploads/file'),$fileName);
        $input['cover']=$fileName;

        $file2 = $request->file('file');
         $fileArray = array('file' => $file2);
    
        // Tell the validator that this file should be an image
        $rules = array(
          'file' => 'required' // max 10000kb
        );   
        
        $validator = Validator::make($fileArray,$rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
              // Redirect or return json to frontend with a helpful message to inform the user 
              // that the provided file was not an adequate type
              return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }
       
        $fileName1= $file2->getClientOriginalName();
       
        $fileextension =strtolower($file2->getClientOriginalExtension());
       

        $fileName1=str_replace(" ","_",$fileName1);
       // return $fileName1;
       
        $file2->move(public_path('uploads/file'),$fileName1);
        $input['file']=$fileName1;  


        $materialUpload = $this->materialUploadRepository->create($input);

        Flash::success('Material Upload saved successfully.');

        return redirect(route('materialUploads.index'));
    }

    /**
     * Display the specified material_upload.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            Flash::error('Material Upload not found');

            return redirect(route('materialUploads.index'));
        }

        return view('material_uploads.show')->with('materialUpload', $materialUpload);
    }

    /**
     * Show the form for editing the specified material_upload.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            Flash::error('Material Upload not found');

            return redirect(route('materialUploads.index'));
        }

        $mat = material::orderBy('id')->pluck('material_type', 'material_type');
        $mdata = $mat->toArray();

        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();


        return view('material_uploads.edit')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata,'materialUpload'=> $materialUpload));
    }

    /**
     * Update the specified material_upload in storage.
     *
     * @param  int              $id
     * @param Updatematerial_uploadRequest $request
     *
     * @return Response
     */
    public function update($id, Updatematerial_uploadRequest $request)
    {
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            Flash::error('Material Upload not found');

            return redirect(route('materialUploads.index'));
        }

        $input = $request->all();
        $file1 = $request->file('cover');  
        $fileName= $file1->getClientOriginalName();
     
        $fileName=str_replace(" ","_",$fileName);
       // return  $fileName;
        $file1->move(public_path('uploads/file'),$fileName);
        $input['cover']=$fileName;

        $file2 = $request->file('file');
         $fileArray = array('file' => $file2);
    
        // Tell the validator that this file should be an image
        $rules = array(
          'file' => 'mimes:pdf,PDF' // max 10000kb
        );   
        
        $validator = Validator::make($fileArray,$rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
              // Redirect or return json to frontend with a helpful message to inform the user 
              // that the provided file was not an adequate type
              return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }
       
        $fileName1= $file2->getClientOriginalName();
       
        $fileextension =strtolower($file2->getClientOriginalExtension());
       

        $fileName1=str_replace(" ","_",$fileName1);
       // return $fileName1;
       
        $file2->move(public_path('uploads/file'),$fileName1);
        $input['file']=$fileName1;  


        $materialUpload = $this->materialUploadRepository->update($input, $id);

        Flash::success('Material Upload updated successfully.');

        return redirect(route('materialUploads.index'));
    }

    /**
     * Remove the specified material_upload from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            Flash::error('Material Upload not found');

            return redirect(route('materialUploads.index'));
        }

        $this->materialUploadRepository->delete($id);

        Flash::success('Material Upload deleted successfully.');

        return redirect(route('materialUploads.index'));
    }






    public function uploadCsv(Request $request){
        ini_set('max_execution_time', '0');
		$result=$this->processBatchUploadZip($request->file('file'));
		
		if(array_key_exists('fail',$result)){
			Flash::error($result['fail']);
			return response()->json(['message'=>$result['fail']],351);
		}else{
			Flash::success($result['success']);
			return response()->json(['message'=>$result['success']],200);
		}
		return back();
				
    }
	
	/*
		
		// https://admin.netbookflix.com/public/uploads/file/admin_backup_complete_27012022.zip
		The app's code was not studied in depth, so in the interest of keeping things simple,
		we are going make changes in least number of files. Reduce new libraries/dependencies
		needing install. Will try to use native function wherever possible.
		Util functions are being added to the existing files.
		
		files modified:
		app\Imports\ImportAppMaterials.php,
		resources\views\app_materials\index.blade.php,
		app\Http\Controllers\material_uploadController.php
		
		extensions added: ZipArchive.
	
	*/
	
	/* EDIT: rahul. created: 26/1/2022 */
	public function publish_evt($evt){
		echo $evt."|";
		ob_flush();
        flush();
	}

	// makeshift fn. TODO: use laravel's utils to sanitize file names.
	private function sanitize_name($fn){
		$chr = ["@",",","+","-"," ","."];
		foreach($chr as $c){
			$fn = str_replace($c,"_",$fn);
		}
		return $fn;
	}
	
	private function processBatchUploadZip($zipFile){
		
		$d = DIRECTORY_SEPARATOR ;
		$xls_file = 'Materials.xlsx';
		$upload_loc = 'uploads'.$d.'zips';
		$final_loc = 'uploads'.$d.'file';
		$errors = Array();
		
		try{
			
			
			// first check if the uploaded file is a zip file.
			
			// get the username first
			$upload_loc .= $d.$this->sanitize_name(Auth::user()->email);
			$upload_loc = public_path($upload_loc);
			$fn=time().$this->sanitize_name($zipFile->getClientOriginalName());
			$zipFile->move($upload_loc,$fn);
			
			// extract zip file;
			$zip = new \ZipArchive;
			$res=$zip->open($upload_loc.$d.$fn);
			if($res!==true){
				throw new Exception("Invalid zip archive: {$zipFile->getClientOriginalName()}.");
				//TODO: $res to error string.
			}
					
			if($zip->extractTo($upload_loc)===FALSE){
				throw new Exception("Could not extract the zip archive: {$zipFile->getClientOriginalName()}.");
			}					
			$zip->close();
			// check if the xls file exists in the extracted files.
			$fn=$upload_loc.$d.$xls_file;
			if(!file_exists($fn)){
				File::deleteDirectory($upload_loc);// delete the extracted directory before returning error;
				throw new Exception("Entries file: $xls_file not found.");
			}
			
			ob_start();
            ob_end_flush();
            ob_flush();
            flush();
			
			// read the xls file and extract the entries
			$import_sheet = new ImportAppMaterials;
			$import_sheet->setListener($this);
			$import_sheet->setLocations($upload_loc,public_path($final_loc));
			Excel::import($import_sheet, $fn);
			
			File::deleteDirectory($upload_loc);// delete the extracted directory
			if(!empty($import_sheet->getErrors())){
				throw new Exception("Processed {$import_sheet->getFilesProcessed()} entries.<br />".json_encode($import_sheet->getErrors()));
			}
			$errors['success'] = 'All operations completed successfully!';
			ob_end_flush();
		}catch(Exception $ex){
			$errors['fail'] = 'Error while processing data. ' . $ex->getMessage();
		}
		return $errors;
	}
	
	/* EDIT: rahul, ends */
	
	
	
	
}
