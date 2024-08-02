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
use App\Models\material;
use App\Models\language;
use App\Models\app_subject;
use App\Models\app_department;
use App\Models\book_publisher;
use App\Http\Controllers\AppBaseController;
use App\Imports\ImportAppMaterials;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

        $mat = material::orderBy('material_type')->pluck('material_type', 'id');
        $mdata = $mat->toArray();

        $genre = genre::orderBy('id')->pluck('genre_name', 'id');
        $gdata = $genre->toArray();

        // $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // // ->where('genre', '=', $gdata);
        // $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'id');
        $ldata = $lang->toArray();

        $pubs = book_publisher::orderBy('id')->pluck('publisher', 'id');
        $appMaterial = array();
        $pub = $pubs->toArray();
        if(Auth::user()->access->access_role == 1) {
            return view('app_materials.create')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'publisher'=>$pub, 'disabled'=>'', 'appMaterial' => $appMaterial));
        }
        $pubs = book_publisher::where('user_id', Auth::user()->id)->pluck('publisher', 'id');
        $pub = $pubs->toArray();
        $appMaterial["publisher"] = book_publisher::where('user_id', Auth::user()->id)->first()->id;
        return view('app_materials.create')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'publisher'=>$pub, 'disabled'=>'', 'appMaterial' => $appMaterial));
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
        $input = $request->all();

        $input = $request->all();
        $file1 = $request->file('book_image');
        $fileName= $file1->getClientOriginalName();
     
        $fileName=str_replace(" ","_",$fileName);
       // return  $fileName;
        $input['book_image']=$fileName;

        $file2 = $request->file('book_pdf');

        $fileName1= $file2->getClientOriginalName();
       
        $fileextension =strtolower($file2->getClientOriginalExtension());
       

        $fileName1=str_replace(" ","_",$fileName1);
       // return $fileName1;
       
        $input['book_pdf']=$fileName1;

        $file1->move(public_path('../../ebook/public/uploads'),$fileName);
        $file2->move(public_path('../../ebook/public/uploads'),$fileName1);


        $appMaterial = $this->appMaterialRepository->create($input);

        Flash::success('App Material saved successfully.');

        return redirect(route('appMaterials.index'));
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
        $appMaterial = $this->appMaterialRepository->find($id);

        $mat = material::orderBy('id')->pluck('material_type', 'id');
        $mdata = $mat->toArray();

        $genre = genre::orderBy('id')->pluck('genre_name', 'id');
        $gdata = $genre->toArray();

        // $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // // ->where('genre', '=', $gdata);
        // $sgenredata = $sgenre->toArray();


        $lang = language::orderBy('id')->pluck('language_name', 'id');
        $ldata = $lang->toArray();

        $pubs = book_publisher::orderBy('id')->pluck('publisher', 'id');
        $pub = $pubs->toArray();

        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));
        }

        if(Auth::user()->access->access_role == 1) {
            return view('app_materials.edit')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'appMaterial' => $appMaterial, 'publisher'=>$pub, 'disabled'=>''));
        }
        $pubs = book_publisher::where('user_id', Auth::user()->id)->pluck('publisher', 'id');
        $pub = $pubs->toArray();
        return view('app_materials.edit')->with(array('material' => $mdata,'genre' => $gdata,'lang' =>$ldata, 'appMaterial' => $appMaterial, 'publisher'=>$pub, 'disabled'=>''));
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
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            Flash::error('App Material not found');

            return redirect(route('appMaterials.index'));
        }


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
}
