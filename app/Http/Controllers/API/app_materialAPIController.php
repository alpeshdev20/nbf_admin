<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_materialAPIRequest;
use App\Http\Requests\API\Updateapp_materialAPIRequest;
use App\Models\app_material;
use App\Models\language;
use App\Models\app_subject;
use App\Models\app_department;
use App\Repositories\app_materialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_materialController
 * @package App\Http\Controllers\API
 */

class app_materialAPIController extends AppBaseController
{
    /** @var  app_materialRepository */
    private $appMaterialRepository;

    public function __construct(app_materialRepository $appMaterialRepo)
    {
        $this->appMaterialRepository = $appMaterialRepo;
    }

    /**
     * Display a listing of the app_material.
     * GET|HEAD /appMaterials
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $appMaterials = $this->appMaterialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appMaterials->toArray(), 'App Materials retrieved successfully');
    }

    /**
     * Store a newly created app_material in storage.
     * POST /appMaterials
     *
     * @param Createapp_materialAPIRequest $request
     *
     * @return Response
     */
    public function store(Createapp_materialAPIRequest $request)
    {
        $input = $request->all();

        $appMaterial = $this->appMaterialRepository->create($input);

        return $this->sendResponse($appMaterial->toArray(), 'App Material saved successfully');
    }

    /**
     * Display the specified app_material.
     * GET|HEAD /appMaterials/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var app_material $appMaterial */
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            return $this->sendError('App Material not found');
        }

        return $this->sendResponse($appMaterial->toArray(), 'App Material retrieved successfully');
    }

    public function getdepartment($id) {
        $id = explode(',', $id);
        $lang = app_department::whereIn('genre_id', $id)->orderBy('id')->pluck('department_name', 'id');
        $ldata = $lang->toArray();

        return $this->sendResponse($ldata, 'App Department saved successfully');
    }

    public function getsubject($id) {
        $id = explode(',', $id);
        $lang = app_subject::whereIn('department_id', $id)->orderBy('id')->pluck('subject_name', 'id');
        $ldata = $lang->toArray();

        return $this->sendResponse($ldata, 'App subject saved successfully');
    }



    /**
     * Update the specified app_material in storage.
     * PUT/PATCH /appMaterials/{id}
     *
     * @param int $id
     * @param Updateapp_materialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_materialAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_material $appMaterial */
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            return $this->sendError('App Material not found');
        }

        $appMaterial = $this->appMaterialRepository->update($input, $id);

        return $this->sendResponse($appMaterial->toArray(), 'app_material updated successfully');
    }

    /**
     * Remove the specified app_material from storage.
     * DELETE /appMaterials/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var app_material $appMaterial */
        $appMaterial = $this->appMaterialRepository->find($id);

        if (empty($appMaterial)) {
            return $this->sendError('App Material not found');
        }

        $appMaterial->delete();

        return $this->sendSuccess('App Material deleted successfully');
    }
}
