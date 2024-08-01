<?php

namespace App\Http\Controllers;

use App\Models\app_logos;
use App\DataTables\app_logosDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_logosRequest;
use App\Http\Requests\Updateapp_logosRequest;
use App\Repositories\app_logosRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class app_logosController extends AppBaseController
{
    /** @var  app_logosRepository */
    private $appLogosRepository;

    public function __construct(app_logosRepository $appLogosRepo)
    {
        $this->appLogosRepository = $appLogosRepo;
    }

    /**
     * Display a listing of the app_logos.
     *
     * @param app_logosDataTable $appLogosDataTable
     * @return Response
     */
    public function index(app_logosDataTable $appLogosDataTable)
    {
        return $appLogosDataTable->render('app_logos.index');
    }

    /**
     * Show the form for creating a new app_logos.
     *
     * @return Response
     */
    public function create()
    {
        return view('app_logos.create');
    }

    /**
     * Store a newly created app_logos in storage.
     *
     * @param Createapp_logosRequest $request
     *
     * @return Response
     */
    public function store(Createapp_logosRequest $request)
    {
        $input = $request->all();
        // return $input;
        $file = $request->file('file_path');
        $fileName= $file->getClientOriginalName();
        $fileName=str_replace("","_",$fileName);
        $file->move(public_path('../../ebook/public/uploads'),$fileName);
        $input['file_path']='/uploads/'.$fileName;

        $appLogos = $this->appLogosRepository->create($input);

        Flash::success('App Logos saved successfully.');

        return redirect(route('appLogos.index'));
    }

    /**
     * Display the specified app_logos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            Flash::error('App Logos not found');

            return redirect(route('appLogos.index'));
        }

        return view('app_logos.show')->with('appLogos', $appLogos);
    }

    /**
     * Show the form for editing the specified app_logos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            Flash::error('App Logos not found');

            return redirect(route('appLogos.index'));
        }

        return view('app_logos.edit')->with('appLogos', $appLogos);
    }

    /**
     * Update the specified app_logos in storage.
     *
     * @param  int              $id
     * @param Updateapp_logosRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_logosRequest $request)
    {
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            Flash::error('App Logos not found');

            return redirect(route('appLogos.index'));
        }

        $appLogos = $this->appLogosRepository->update($request->all(), $id);

        Flash::success('App Logos updated successfully.');

        return redirect(route('appLogos.index'));
    }

    /**
     * Remove the specified app_logos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            Flash::error('App Logos not found');

            return redirect(route('appLogos.index'));
        }

        $this->appLogosRepository->delete($id);

        Flash::success('App Logos deleted successfully.');

        return redirect(route('appLogos.index'));
    }
}
