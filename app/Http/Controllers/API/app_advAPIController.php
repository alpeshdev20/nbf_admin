<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_advAPIRequest;
use App\Http\Requests\API\Updateapp_advAPIRequest;
use App\Models\app_adv;
use App\Repositories\app_advRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_advController
 * @package App\Http\Controllers\API
 */

class app_advAPIController extends AppBaseController
{
    /** @var  app_advRepository */
    private $appAdvRepository;

    public function __construct(app_advRepository $appAdvRepo)
    {
        $this->appAdvRepository = $appAdvRepo;
    }

    /**
     * Display a listing of the app_adv.
     * GET|HEAD /appAdvs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $appAdvs = $this->appAdvRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appAdvs->toArray(), 'App Advs retrieved successfully');
    }

    /**
     * Store a newly created app_adv in storage.
     * POST /appAdvs
     *
     * @param Createapp_advAPIRequest $request
     *
     * @return Response
     */
    public function store(Createapp_advAPIRequest $request)
    {
        $input = $request->all();

        $appAdv = $this->appAdvRepository->create($input);

        return $this->sendResponse($appAdv->toArray(), 'App Adv saved successfully');
    }

    /**
     * Display the specified app_adv.
     * GET|HEAD /appAdvs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var app_adv $appAdv */
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            return $this->sendError('App Adv not found');
        }

        return $this->sendResponse($appAdv->toArray(), 'App Adv retrieved successfully');
    }

    /**
     * Update the specified app_adv in storage.
     * PUT/PATCH /appAdvs/{id}
     *
     * @param int $id
     * @param Updateapp_advAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_advAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_adv $appAdv */
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            return $this->sendError('App Adv not found');
        }

        $appAdv = $this->appAdvRepository->update($input, $id);

        return $this->sendResponse($appAdv->toArray(), 'app_adv updated successfully');
    }

    /**
     * Remove the specified app_adv from storage.
     * DELETE /appAdvs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var app_adv $appAdv */
        $appAdv = $this->appAdvRepository->find($id);

        if (empty($appAdv)) {
            return $this->sendError('App Adv not found');
        }

        $appAdv->delete();

        return $this->sendSuccess('App Adv deleted successfully');
    }
}
