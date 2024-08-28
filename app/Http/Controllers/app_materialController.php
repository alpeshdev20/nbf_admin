<?php

namespace App\Http\Controllers;

use App\DataTables\app_materialDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_materialRequest;
use App\Http\Requests\Updateapp_materialRequest;
use App\Repositories\app_materialRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use App\Models\genre;
use App\Models\app_material;
use App\Models\material;
use App\Models\language;
use App\Models\app_department;
use App\Models\book_publisher;
use App\Models\book_genre_map;
use App\Models\app_subject;
use App\Models\Region;
use App\Models\appmaterial_item;
use App\Http\Controllers\AppBaseController;
use App\Imports\ImportAppMaterials;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Response;

class app_materialController extends AppBaseController
{
    /** @var  app_materialRepository */
    private $appMaterialRepository;

    public function __construct(app_materialRepository $appMaterialRepo)
    {        
        $this->appMaterialRepository = $appMaterialRepo;
    }

    public function uploadCsv(Request $request){
        $request->validate(['file'=>'required']);
        
        Excel::import(new ImportAppMaterials, request()->file('file'));
            
        return back();
    }
	
	
	 public function getpublisherbooks(Request $request)
    {
		$request->validate(['publisher_id'=>'required|numeric']);
		$rsult = $this->appMaterialRepository->getPublisherBooks($request->publisher_id);
		return response()->json($rsult);
    }
    public function getteacherbooks(Request $request)
    {
        $request->validate(['teacher_id'=>'required|numeric']);
        $result = $this->appMaterialRepository->getTeacherBooks($request->teacher_id);
        return response()->json($result);
    }
	
	

    /**
     * Display a listing of the app_material.
     *
     * @param app_materialDataTable $appMaterialDataTable
     * @return Response
     */
    public function index(app_materialDataTable $appMaterialDataTable)
    {
        return $appMaterialDataTable->render('app_materials.index');
    }

    /**
     * Show the form for creating a new app_material.
     *
     * @return Response
     */
    public function create()
    {
        $episodes = old('episodes');
        $mat = material::orderBy('material_type')->pluck('material_type', 'id');
        $mdata = $mat->toArray();


        $genre = genre::orderBy('id')->pluck('genre_name', 'id');
        $gdata = $genre->toArray();

        $age= array(0=>"All",1=>"Foundational Stage (03-08 Years)",2=>"Preparatory Stage (08-11 Years)",3=>"Middle Stage (11-14 Years)",4=>"Secondary Stage (14 to 18 Years)",5=>"Higher Education (18 to 22 Years)");

        // $product = array(0=>"Free",1=>"Basic",2=>"Premium");
        $product = app_material::getMaterialAllCategories();
        $genre_data = genre::all();

        // $country = Region::all();
        // $country = Region::all();
       // $countries = Region::all();
$countries = [];

        $allow_region = [];
        // $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // // ->where('genre', '=', $gdata);
        // $sgenredata = $sgenre->toArray();
        
        $genre_ids = [];

        $book_pdf_val = "";
        $book_image_val = "";

        $lang = language::orderBy('id')->pluck('language_name', 'id');
        $ldata = $lang->toArray();

        $pubs = book_publisher::orderBy('id')->pluck('publisher', 'id');
        $appMaterial = array();
        $pub = $pubs->toArray();
        if(Auth::user()->access->access_role == 1) {
            return view('app_materials.create')->with(array('episodes'=> $episodes, 'material' => $mdata, 'region_data'=>$countries,'genre' => $gdata,'lang' =>$ldata, 'publisher'=>$pub, 'disabled'=>'', 'appMaterial' => $appMaterial,'age'=>$age,'product'=>$product,'allow_region'=>$allow_region,'genre_ids'=>$genre_ids,'genre_data'=>$genre_data,"book_pdf_val"=>$book_pdf_val,"book_image_val"=>$book_image_val));
        } elseif(Auth::user()->access->access_role == 3) {
            return view('app_materials.create')->with(array('episodes'=> $episodes, 'material' => $mdata,'region_data'=>$countries,'genre' => $gdata,'lang' =>$ldata, 'publisher'=>$pub, 'disabled'=>'', 'appMaterial' => $appMaterial,'age'=>$age,'product'=>$product,'allow_region'=>$allow_region,'genre_ids'=>$genre_ids,'genre_data'=>$genre_data,"book_pdf_val"=>$book_pdf_val,"book_image_val"=>$book_image_val));
        }
        $pubs = book_publisher::where('user_id', Auth::user()->id)->pluck('publisher', 'id');
        $pub = $pubs->toArray();
        $appMaterial["publisher"] = book_publisher::where('user_id', Auth::user()->id)->first()->id;
        return view('app_materials.create')->with(array('episodes'=> $episodes,'material' => $mdata,'region_data'=>$countries,'genre' => $gdata,'lang' =>$ldata, 'publisher'=>$pub, 'disabled'=>'', 'appMaterial' => $appMaterial,'age'=>$age, 'product'=>$product,'allow_region'=>$allow_region,'genre_ids'=>$genre_ids,'genre_data'=>$genre_data,"book_pdf_val"=>$book_pdf_val,"book_image_val"=>$book_image_val));
    }


    /**
     * Store a newly created app_material in storage.
     *
     * @param Createapp_materialRequest $request
     *
     * @return Response
     */
	public function store(Createapp_materialRequest $request)
    { 
        if(Auth::user()->access->access_role == 3) {
            $validator = Validator::make($request->all(),[
                'book_pdf' => 'required|mimetypes:pdf'
            ]); 
        } else {
            $validator = Validator::make($request->all(),[
                'book_pdf' => 'required|mimetypes:'. $this->getAllowedMimeTypes($request->material_type),
                'episodes.*.file' => 'mimetypes:' . $this->getAllowedMimeTypes($request->material_type)
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if(Auth::user()->access->access_role == 3) {
            $input = $request->all();
            $file1 = $request->file('book_image');
            $fileName= $file1->getClientOriginalName();
            $fileName=str_replace(" ","_",$fileName);

            
            $file2 = $request->file('book_pdf');
            $fileName1= $file2->getClientOriginalName();
            $fileextension =strtolower($file2->getClientOriginalExtension());
            $fileName1=str_replace(" ","_",$fileName1);
            
            
            $file1->move(public_path('../../ebook/public/uploads'),$fileName);
            $file2->move(public_path('../../ebook/public/uploads'),$fileName1);
            
            $fileindex=1;
            
            $input['book_image'] = $fileName;
            $input['book_pdf']= $fileName1;
            $input['summary'] = 0;
            $input['author'] = 0;
            $input['table_of_content'] = 0;
            $input['author_detail'] = 0;
            $appMaterial = $this->appMaterialRepository->create($input);
            Flash::success('App Material saved successfully.');
            return redirect(route('appMaterials.index'));
        } 

        if(isset($request->allow_region) && $request->allow_region != "" && $request->allow_region != null)
        {
            $country_ids =  implode(",",$request->allow_region);
            $request->merge(['allow_region' => $country_ids]);
        }else{
            $request->merge(['allow_region' => "0"]);
        }

        $input = $request->all();

        if (isset($input["episodes"])) {
            unset($input["file"]);
        }

        $file1 = $request->file('book_image');
        $fileName= $file1->getClientOriginalName();
        $fileName=str_replace(" ","_",$fileName);

        
		$file2 = $request->file('book_pdf');
        $fileName1= $file2->getClientOriginalName();
        $fileextension =strtolower($file2->getClientOriginalExtension());
        $fileName1=str_replace(" ","_",$fileName1);
        
        
        $file1->move(public_path('../../ebook/public/uploads'),$fileName);
        $file2->move(public_path('../../ebook/public/uploads'),$fileName1);
        
        $fileindex=1;
        
        $input['book_image'] = $fileName; //$input['book_image'] = $fileindex.time()."_". $fileName;
		$input['book_pdf']= $fileName1;
        
        $appMaterial = $this->appMaterialRepository->create($input);
		
		//add the extra genres to the 	
		$indeces = ['0','1','2'];//['','0','1','2'];
		$res = array();
		foreach($indeces as $i){
			$search = array();
			$values = array();
			$search['book_id']=$appMaterial->id;
			if(isset($input['genre_id'.$i]) && !empty($input['genre_id'.$i])){
				$search['genre_id'] = $input['genre_id'.$i];
				$values['genre_id'] = $input['genre_id'.$i];
			}
			if(isset($input['department_id'.$i]) && !empty($input['department_id'.$i])){
				$search['department_id'] = $input['department_id'.$i];
				$values['department_id'] = $input['department_id'.$i];
			}
			if(isset($input['subject_id'.$i]) && !empty($input['subject_id'.$i])){
				$search['subject_id'] = $input['subject_id'.$i];
				$values['subject_id'] = $input['subject_id'.$i];
			}
			if(count($search)>1){
				$res[] = book_genre_map::updateOrCreate($search, $values);
			}
		}
     
        if($request->material_type == '2' || $request->material_type == '4' || $request->material_type == '5' ) {
            $episodes = $request->episodes;
            if(!empty($episodes)) {

                foreach($episodes as $episode) {
                    $item = [
                        'appmaterial_id' => $appMaterial->id,
                        'title' => $episode['title'],
                        'summary' => $episode['summary'],
                        'image_file' => $episode['image_file']->getClientOriginalName(),
                        'file' => $episode['file']->getClientOriginalName(),
                        'length' => $episode['length'],
                        'sequence' => $episode['sequence']
                    ];
                    if(!empty($episode['image_file'])) {
                        $episode['image_file']->move(public_path('../../ebook/public/uploads'), $episode['image_file']->getClientOriginalName());
                    }
                    if(!empty($episode['file'])) {
                        $episode['file']->move(public_path('../../ebook/public/uploads'), $episode['file']->getClientOriginalName());
                    }
                    appmaterial_item::create($item);
                }
            }
        }


        Flash::success('App Material saved successfully.');
        return redirect(route('appMaterials.index'));
    }

    private function getAllowedMimeTypes($fileType)
    {

        $allowedMimeTypes = [];

        switch ($fileType) {
            case '2':
               $allowedMimeTypes = ['video/mp4'];
               break;
            case '3':
                $allowedMimeTypes = ['application/pdf', 'application/epub+zip'];
                break;
            case '4':
                $allowedMimeTypes = ['audio/mp3', 'audio/mpeg'];
                break;
            case '5':
                $allowedMimeTypes = ['application/pdf', 'application/epub+zip'];
                break;
    
        }
         return implode(',', $allowedMimeTypes);
    }

    /**
     * Display the specified app_material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));
        }

        return view('app_materials.show')->with('appMaterial', $appMaterial);
    }

    /**
     * Show the form for editing the specified app_material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $episodes = old('episodes');
        // dd($episodes);
        $appMaterial = $this->appMaterialRepository->find($id);
        $material = $appMaterial->material_type;

        if($appMaterial->material_type == '2' || $appMaterial->material_type == '4' || $appMaterial->material_type == '5') {
            $episode = appmaterial_item::where('appmaterial_id',$id)->get()->toArray();
        }

        $mat = material::orderBy('id')->pluck('material_type', 'id');
        $mdata = $mat->toArray();

        $genre = genre::orderBy('id')->pluck('genre_name', 'id');
        $gdata = $genre->toArray();

        $book_pdf_val = $appMaterial->book_pdf;
        $book_image_val = $appMaterial->book_image;

        $department_selected = app_department::orderBy('id')->pluck('department_name', 'id');
        $department_selected = $department_selected->toArray();

        $subject_selected = app_subject::orderBy('id')->pluck('subject_name', 'id');
        $subject_selected = $subject_selected->toArray();

        $age= array(0=>"All",1=>"Foundational Stage (03-08 Years)",2=>"Preparatory Stage (08-11 Years)",3=>"Middle Stage (11-14 Years)",4=>"Secondary Stage (14 to 18 Years)",5=>"Higher Education (18 to 22 Years)");

        $product = app_material::getMaterialAllCategories();

       
        // $genre_ids = book_genre_map::where('book_id',$id)->pluck('genre_id');
        $genre_data = genre::all();

        $book_genres = book_genre_map::where('book_id',$id)->get();
        
        $departments = [];
        $subjects = [];
        $genre_ids=[];
        $department_ids=[];
        $subject_ids=[];
        foreach($book_genres as $bgenre)
        {
            $genre_ids[]=$bgenre->genre_id;
            $department_ids[]=$bgenre->department_id;
            $subject_ids[]=$bgenre->subject_id;

            if($bgenre->genre_id!="" && $bgenre->genre_id!=null)
                $departments[$bgenre->genre_id] = app_department::where('genre_id',$bgenre->genre_id)->get();
            else
                $departments[$bgenre->genre_id] = [];


            if($bgenre->department_id!="" && $bgenre->department_id!=null)
                $subjects[$bgenre->department_id] = app_subject::where('department_id',$bgenre->department_id)->get();
            else
                $subjects[$bgenre->department_id] = [];
        }


        $lang = language::orderBy('id')->pluck('language_name', 'id');
        $ldata = $lang->toArray();

        $pubs = book_publisher::orderBy('id')->pluck('publisher', 'id');
        $pub = $pubs->toArray();

        $countries = Region::all();
        
        $allow_region = $appMaterial->allow_region != ""? explode(',',$appMaterial->allow_region):[];

        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));   
        }

        if (Auth::user()->access->access_role == 1) {
            $viewData = array(
                'material' => $mdata,
                'material_type' => $appMaterial->material_type,
                'genre' => $gdata,
                'lang' => $ldata,
                'appMaterial' => $appMaterial,
                'publisher' => $pub,
                'disabled' => '',
                'age' => $age,
                'product' => $product,
                'region_data' => $countries,
                'allow_region' => $allow_region,
                'genre_ids' => $genre_ids,
                'genre_data' => $genre_data,
                'departments' => $departments,
                'subjects' => $subjects,
                'department_ids' => $department_ids,
                'subject_ids' => $subject_ids,
                'department_selected' => $department_selected,
                'subject_selected' => $subject_selected,
                'book_pdf_val' => $book_pdf_val,
                'book_image_val' => $book_image_val,
                'episodes' => $episodes
            );
        
            if (isset($episode)) {
                $viewData['episode'] = $episode;
            }
            return view('app_materials.edit')->with($viewData);
        }
        $pubs = book_publisher::where('user_id', Auth::user()->id)->pluck('publisher', 'id');
        $pub = $pubs->toArray();
        if(Auth::user()->access->access_role == 3) {
            return view('app_materials.edit')->with(array('material_type' => $appMaterial->material_type,'material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'appMaterial' => $appMaterial, 'publisher'=>$pub, 'disabled'=>'','age'=>$age,'product'=>$product,'region_data'=>$countries,'allow_region'=>$allow_region,'genre_ids'=>$genre_ids,'genre_data'=>$genre_data, 'departments'=>$departments, 'subjects' => $subjects, 'department_ids' => $department_ids, 'subject_ids' => $subject_ids, 'department_selected'=>$department_selected, 'subject_selected'=>$subject_selected,"book_pdf_val"=>$book_pdf_val,"book_image_val"=>$book_image_val));
        }
        return view('app_materials.edit')->with(array('episodes' => $episodes,'material_type' => $appMaterial->material_type, 'episode' => $episode,'material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'appMaterial' => $appMaterial, 'publisher'=>$pub, 'disabled'=>'','age'=>$age,'product'=>$product,'region_data'=>$countries,'allow_region'=>$allow_region,'genre_ids'=>$genre_ids,'genre_data'=>$genre_data, 'departments'=>$departments, 'subjects' => $subjects, 'department_ids' => $department_ids, 'subject_ids' => $subject_ids, 'department_selected'=>$department_selected, 'subject_selected'=>$subject_selected,"book_pdf_val"=>$book_pdf_val,"book_image_val"=>$book_image_val));
    }

    /**
     * Update the specified app_material in storage.
     *
     * @param  int              $id
     * @param Updateapp_materialRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_materialRequest $request)
    {   
        $rules = [
            'episodes.*.file' => 'mimetypes:' . $this->getAllowedMimeTypes($request->material_type),
        ];
        if ($request->hasFile('book_pdf')) {
            $rules['book_pdf'] = 'mimetypes:' . $this->getAllowedMimeTypes($request->material_type);
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $appMaterial = $this->appMaterialRepository->find($id);
        
        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));
        }

        if(Auth::user()->access->access_role == 3) {

            $input = $request->all();
    
            $file1 = $request->file('book_image');
    
    
            if($file1) {
                $fileName= $file1->getClientOriginalName();
                $fileName=str_replace(" ","_",$fileName);
                    $input['book_image']=$fileName;
    
                    $file1->move(public_path('../../ebook/public/uploads'),$fileName);
    
            } else {
                $input['book_image']=$appMaterial->book_image;
            }
    
                $file2 = $request->file('book_pdf');
    
            if($file2) {
                    $fileName1= $file2->getClientOriginalName();
                    $fileName1=str_replace(" ","_",$fileName1);
                    $input['book_pdf']=$fileName1;
    
                    $file2->move(public_path('../../ebook/public/uploads'),$fileName1);
    
            } else {
                        $input['book_pdf']=$appMaterial->book_pdf;
            }

            $appMaterial = $this->appMaterialRepository->update($input, $id);

            Flash::success('App Material updated successfully.');
    
            return redirect(route('appMaterials.index'));
        }

        if(isset($request->allow_region) && $request->allow_region != "" && $request->allow_region != null)
        {
            $country_ids =  implode(",",$request->allow_region);
            $request->merge(['allow_region' => $country_ids]);
        }else{
            $request->merge(['allow_region' => "0"]);
        }
        
        $input = $request->all();

       
        if (isset($input["episodes"])) {
            unset($input["episodes"]);
        }

        $file1 = $request->file('book_image');


        if($file1) {
            $fileName= $file1->getClientOriginalName();
            $fileName=str_replace(" ","_",$fileName);
                $input['book_image']=$fileName;

                $file1->move(public_path('../../ebook/public/uploads'),$fileName);

        } else {
            $input['book_image']=$appMaterial->book_image;
        }

            $file2 = $request->file('book_pdf');

        if($file2) {
                $fileName1= $file2->getClientOriginalName();
                $fileName1=str_replace(" ","_",$fileName1);
                $input['book_pdf']=$fileName1;

                $file2->move(public_path('../../ebook/public/uploads'),$fileName1);

        } else {
                    $input['book_pdf']=$appMaterial->book_pdf;
        }

        //
        //update the extra genres to the 	
		$indeces = ['0','1','2'];//['','0','1','2'];
		$res = array();
        book_genre_map::where('book_id',$id)->delete();
		foreach($indeces as $i){
			$search = array();
			$values = array();
			$search['book_id']=$appMaterial->id;
			if(isset($input['genre_id'.$i]) && !empty($input['genre_id'.$i])){
				$search['genre_id'] = $input['genre_id'.$i];
				$values['genre_id'] = $input['genre_id'.$i];
			}
			if(isset($input['department_id'.$i]) && !empty($input['department_id'.$i])){
				$search['department_id'] = $input['department_id'.$i];
				$values['department_id'] = $input['department_id'.$i];
			}
			if(isset($input['subject_id'.$i]) && !empty($input['subject_id'.$i])){
				$search['subject_id'] = $input['subject_id'.$i];
				$values['subject_id'] = $input['subject_id'.$i];
			}
			if(count($search)>1){
				$res[] = book_genre_map::updateOrCreate($search, $values);
			}
		}

       
        if ($request->material_type == '2' || $request->material_type == '4') {
            $episodes = $request->episodes;
            if (!empty($episodes)) {
                foreach ($episodes as $episode) {
                    $file_image = isset($episode['image_file']) ? $episode['image_file']->getClientOriginalName() : appmaterial_item::where('id', $episode['episode_id'])->pluck('image_file')->first();
                    $file = isset($episode['file']) ? $episode['file']->getClientOriginalName() : appmaterial_item::where('id', $episode['episode_id'])->pluck('file')->first();
            
                    $item = [
                        'appmaterial_id' => $appMaterial->id,
                        'title' => $episode['title'],
                        'summary' => $episode['summary'],
                        'image_file' => $file_image,
                        'file' => $file,
                        'length' => $episode['length'],
                        'sequence' => $episode['sequence']
                    ];
          
                    if (isset($episode['image_file'])) {
                        $episode['image_file']->move(public_path('../../ebook/public/uploads'), $file_image);
                    }
            
                    if (isset($episode['file'])) {
                        $episode['file']->move(public_path('../../ebook/public/uploads'), $file);
                    }
            
                    appmaterial_item::updateOrCreate(
                        ['id' => $episode['episode_id'] ?? null, 'appmaterial_id' => $appMaterial->id],
                        $item
                    );
                }
            }
           
        }

        //
        $appMaterial = $this->appMaterialRepository->update($input, $id);

        Flash::success('App Material updated successfully.');

        return redirect(route('appMaterials.index'));
    }

    /**
     * Remove the specified app_material from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));
        }

        $this->appMaterialRepository->delete($id);

        Flash::success('App Material deleted successfully.');

        return redirect(route('appMaterials.index'));
    }

    public function regionsearch(Request $request)
    {
        return Region::where('region_name', 'like', '%'.$request->q.'%')->select('id', 'region_name')->get();
    }
}
