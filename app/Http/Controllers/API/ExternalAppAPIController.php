<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExternalAppAPIRequest;
use App\Http\Requests\API\UpdateExternalAppAPIRequest;
use App\Models\ExternalApp;
use App\Repositories\ExternalAppRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ExternalAppResource;
use Response;

/**
 * Class ExternalAppController
 * @package App\Http\Controllers\API
 */

class ExternalAppAPIController extends AppBaseController
{
    /** @var  ExternalAppRepository */
    private $externalAppRepository;

    public function __construct(ExternalAppRepository $externalAppRepo)
    {
        $this->externalAppRepository = $externalAppRepo;
    }

    /**
     * Display a listing of the ExternalApp.
     * GET|HEAD /externalApps
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $externalApps = $this->externalAppRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ExternalAppResource::collection($externalApps), 'External Apps retrieved successfully');
    }

    /**
     * Store a newly created ExternalApp in storage.
     * POST /externalApps
     *
     * @param CreateExternalAppAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExternalAppAPIRequest $request)
    {
        $input = $request->all();

        $externalApp = $this->externalAppRepository->create($input);

        return $this->sendResponse(new ExternalAppResource($externalApp), 'External App saved successfully');
    }

    /**
     * Display the specified ExternalApp.
     * GET|HEAD /externalApps/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExternalApp $externalApp */
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            return $this->sendError('External App not found');
        }

        return $this->sendResponse(new ExternalAppResource($externalApp), 'External App retrieved successfully');
    }

    /**
     * Update the specified ExternalApp in storage.
     * PUT/PATCH /externalApps/{id}
     *
     * @param int $id
     * @param UpdateExternalAppAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExternalAppAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExternalApp $externalApp */
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            return $this->sendError('External App not found');
        }

        $externalApp = $this->externalAppRepository->update($input, $id);

        return $this->sendResponse(new ExternalAppResource($externalApp), 'ExternalApp updated successfully');
    }

    /**
     * Remove the specified ExternalApp from storage.
     * DELETE /externalApps/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ExternalApp $externalApp */
        $externalApp = $this->externalAppRepository->find($id);

        if (empty($externalApp)) {
            return $this->sendError('External App not found');
        }

        $externalApp->delete();

        return $this->sendSuccess('External App deleted successfully');
    }
}
