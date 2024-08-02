<?php

namespace App\Http\Controllers;

use App\DataTables\materialDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatematerialRequest;
use App\Http\Requests\UpdatematerialRequest;
use App\Repositories\materialRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class materialController extends AppBaseController
{
    /** @var  materialRepository */
    private $materialRepository;

    public function __construct(materialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the material.
     *
     * @param materialDataTable $materialDataTable
     * @return Response
     */
    public function index(materialDataTable $materialDataTable)
    {
        return $materialDataTable->render('materials.index');
    }

    /**
     * Show the form for creating a new material.
     *
     * @return Response
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created material in storage.
     *
     * @param CreatematerialRequest $request
     *
     * @return Response
     */
    public function store(CreatematerialRequest $request)
    {
        $input = $request->all();

        $material = $this->materialRepository->create($input);

        Flash::success('Material saved successfully.');

        return redirect(route('materials.index'));
    }

    /**
     * Display the specified material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        return view('materials.show')->with('material', $material);
    }

    /**
     * Show the form for editing the specified material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        return view('materials.edit')->with('material', $material);
    }

    /**
     * Update the specified material in storage.
     *
     * @param  int              $id
     * @param UpdatematerialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatematerialRequest $request)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        $material = $this->materialRepository->update($request->all(), $id);

        Flash::success('Material updated successfully.');

        return redirect(route('materials.index'));
    }

    /**
     * Remove the specified material from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        $this->materialRepository->delete($id);

        Flash::success('Material deleted successfully.');

        return redirect(route('materials.index'));
    }
    public function downloadSampleCsv()
    {
        try {
            return response()->download(public_path('csv/app_materialssample.csv'), 'app_materialssample.csv');
        } catch(\Throwable $exception) {

        }
    }
	
	public function downloadBookSample()
    {
        try {
            return response()->download(public_path('csv/Materials.xlsx'), 'Materials.xlsx');
        } catch(\Throwable $exception) {

        }
    }
	
	public function downloadBulkUploadSample()
    {
        try {
            return response()->download(public_path('templates/bulk_upload_template.zip'), 'bulk_upload_template.zip');
        } catch(\Throwable $exception) {

        }
    }
	
	
}
