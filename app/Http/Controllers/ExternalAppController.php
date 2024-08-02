<?php

namespace App\Http\Controllers;

use App\DataTables\ExternalAppDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExternalAppRequest;
use App\Http\Requests\UpdateExternalAppRequest;
use App\Repositories\ExternalAppRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExternalAppController extends AppBaseController
{
    /** @var  ExternalAppRepository */
    private $externalAppRepository;

    public function __construct(ExternalAppRepository $externalAppRepo)
    {
        $this->externalAppRepository = $externalAppRepo;
    }

    /**
     * Display a listing of the ExternalApp.
     *
     * @param ExternalAppDataTable $externalAppDataTable
     * @return Response
     */
    public function index(ExternalAppDataTable $externalAppDataTable)
    {
        return $externalAppDataTable->render('external_apps.index');
    }

    /**
     * Show the form for creating a new ExternalApp.
     *
     * @return Response
     */
    public function create()
    {
        return view('external_apps.create');
    }

    /**
     * Store a newly created ExternalApp in storage.
     *
     * @param CreateExternalAppRequest $request
     *
     * @return Response
     */
    public function store(CreateExternalAppRequest $request)
    {
        $input = $request->all();

        $externalApp = $this->externalAppRepository->create($input);

        Flash::success('External App saved successfully.');

        return redirect(route('externalApps.index'));
    }

    /**
     * Display the specified ExternalApp.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            Flash::error('External App not found');

            return redirect(route('externalApps.index'));
        }

        return view('external_apps.show')->with('externalApp', $externalApp);
    }

    /**
     * Show the form for editing the specified ExternalApp.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            Flash::error('External App not found');

            return redirect(route('externalApps.index'));
        }

        return view('external_apps.edit')->with('externalApp', $externalApp);
    }

    /**
     * Update the specified ExternalApp in storage.
     *
     * @param  int              $id
     * @param UpdateExternalAppRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExternalAppRequest $request)
    {
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            Flash::error('External App not found');

            return redirect(route('externalApps.index'));
        }

        $externalApp = $this->externalAppRepository->update($request->all(), $id);

        Flash::success('External App updated successfully.');

        return redirect(route('externalApps.index'));
    }

    /**
     * Remove the specified ExternalApp from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            Flash::error('External App not found');

            return redirect(route('externalApps.index'));
        }

        $this->externalAppRepository->delete($id);

        Flash::success('External App deleted successfully.');

        return redirect(route('externalApps.index'));
    }
}
