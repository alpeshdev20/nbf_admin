<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_logosAPIRequest;
use App\Http\Requests\API\Updateapp_logosAPIRequest;
use App\Models\app_logos;
use App\Repositories\app_logosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\app_logosResource;
use Response;

/**
 * Class app_logosController
 * @package App\Http\Controllers\API
 */

class app_logosAPIController extends AppBaseController
{
    /** @var  app_logosRepository */
    private $appLogosRepository;

    public function __construct(app_logosRepository $appLogosRepo)
    {
        $this->appLogosRepository = $appLogosRepo;
    }

    /**
     * Display a listing of the app_logos.
     * GET|HEAD /appLogos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $appLogos = $this->appLogosRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(app_logosResource::collection($appLogos), 'App Logos retrieved successfully');
    }

    /**
     * Store a newly created app_logos in storage.
     * POST /appLogos
     *
     * @param Createapp_logosAPIRequest $request
     *
     * @return Response
     */
    public function store(Createapp_logosAPIRequest $request)
    {
        $input = $request->all();

        $appLogos = $this->appLogosRepository->create($input);

        return $this->sendResponse(new app_logosResource($appLogos), 'App Logos saved successfully');
    }

    /**
     * Display the specified app_logos.
     * GET|HEAD /appLogos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var app_logos $appLogos */
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            return $this->sendError('App Logos not found');
        }

        return $this->sendResponse(new app_logosResource($appLogos), 'App Logos retrieved successfully');
    }

    /**
     * Update the specified app_logos in storage.
     * PUT/PATCH /appLogos/{id}
     *
     * @param int $id
     * @param Updateapp_logosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_logosAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_logos $appLogos */
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            return $this->sendError('App Logos not found');
        }

        $appLogos = $this->appLogosRepository->update($input, $id);

        return $this->sendResponse(new app_logosResource($appLogos), 'app_logos updated successfully');
    }

    /**
     * Remove the specified app_logos from storage.
     * DELETE /appLogos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var app_logos $appLogos */
        $appLogos = $this->appLogosRepository->find($id);

        if (empty($appLogos)) {
            return $this->sendError('App Logos not found');
        }

        $appLogos->delete();

        return $this->sendSuccess('App Logos deleted successfully');
    }
}
