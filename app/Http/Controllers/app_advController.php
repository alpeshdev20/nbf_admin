<?php

namespace App\Http\Controllers;

use App\DataTables\app_advDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_advRequest;
use App\Http\Requests\Updateapp_advRequest;
use App\Repositories\app_advRepository;
use App\Models\material;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class app_advController extends AppBaseController
{
    /** @var  app_advRepository */
    private $appAdvRepository;

    public function __construct(app_advRepository $appAdvRepo)
    {
        $this->appAdvRepository = $appAdvRepo;
    }

    /**
     * Display a listing of the app_adv.
     *
     * @param app_advDataTable $appAdvDataTable
     * @return Response
     */
    public function index(app_advDataTable $appAdvDataTable)
    {
        return $appAdvDataTable->render('app_advs.index');
    }

    /**
     * Show the form for creating a new app_adv.
     *
     * @return Response
     */
    public function create()
    {
        $mat = material::orderBy('id')->pluck('material_type', 'id');
        $mdata = $mat->toArray();
        return view('app_advs.create')->with(array('material' => $mdata));
    }

    /**
     * Store a newly created app_adv in storage.
     *
     * @param Createapp_advRequest $request
     *
     * @return Response
     */
    public function store(Createapp_advRequest $request)
    {
        $input = $request->all();

        $file1 = $request->file('image');
        $fileName= $file1->getClientOriginalName();
     
        $fileName=str_replace(" ","_",$fileName);
       // return  $fileName;
        $input['image']=$fileName;

        $file1->move(public_path('../../ebook/public/uploads/banner'),$fileName);

        $appAdv = $this->appAdvRepository->create($input);

        Flash::success('App Adv saved successfully.');

        return redirect(route('appAdvs.index'));
    }

    /**
     * Display the specified app_adv.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            Flash::error('App Adv not found');

            return redirect(route('appAdvs.index'));
        }

        return view('app_advs.show')->with('appAdv', $appAdv);
    }

    /**
     * Show the form for editing the specified app_adv.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            Flash::error('App Adv not found');

            return redirect(route('appAdvs.index'));
        }

        $mat = material::orderBy('id')->pluck('material_type', 'id');
        $mdata = $mat->toArray();

        return view('app_advs.edit')->with(array('material' => $mdata, 'appAdv' => $appAdv));
    }

    /**
     * Update the specified app_adv in storage.
     *
     * @param  int              $id
     * @param Updateapp_advRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_advRequest $request)
    {

        $input = $request->all();
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            Flash::error('App Adv not found');

            return redirect(route('appAdvs.index'));
        }

        $file1 = $request->file('image');

    	if($file1) {
            $fileName= $file1->getClientOriginalName();
             $fileName=str_replace(" ","_",$fileName);
             $input['image']=$fileName;
	        $file1->move(public_path('../../ebook/public/uploads/banner'),$fileName);
    	} else {
	    	$input['image']=$appAdv->image;
    	}

        $appAdv = $this->appAdvRepository->update($input, $id);

        Flash::success('App Adv updated successfully.');

        return redirect(route('appAdvs.index'));
    }

    /**
     * Remove the specified app_adv from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            Flash::error('App Adv not found');

            return redirect(route('appAdvs.index'));
        }

        $this->appAdvRepository->delete($id);

        Flash::success('App Adv deleted successfully.');

        return redirect(route('appAdvs.index'));
    }
}
