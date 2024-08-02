<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_publisherAPIRequest;
use App\Http\Requests\API\Updateapp_publisherAPIRequest;
use App\Models\app_publisher;
use App\Repositories\app_publisherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_publisherController
 * @package App\Http\Controllers\API
 */

class app_publisherAPIController extends AppBaseController
{
    /** @var  app_publisherRepository */
    private $appPublisherRepository;

    public function __construct(app_publisherRepository $appPublisherRepo)
    {
        $this->appPublisherRepository = $appPublisherRepo;
    }

    /**
     * Display a listing of the app_publisher.
     * GET|HEAD /appPublishers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $appPublishers = $this->appPublisherRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appPublishers->toArray(), 'App Publishers retrieved successfully');
    }

    /**
     * Store a newly created app_publisher in storage.
     * POST /appPublishers
     *
     * @param Createapp_publisherAPIRequest $request
     *
     * @return Response
     */
    public function store(Createapp_publisherAPIRequest $request)
    {
        $input = $request->all();

        $appPublisher = $this->appPublisherRepository->create($input);

        return $this->sendResponse($appPublisher->toArray(), 'App Publisher saved successfully');
    }

    /**
     * Display the specified app_publisher.
     * GET|HEAD /appPublishers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var app_publisher $appPublisher */
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            return $this->sendError('App Publisher not found');
        }

        return $this->sendResponse($appPublisher->toArray(), 'App Publisher retrieved successfully');
    }

    /**
     * Update the specified app_publisher in storage.
     * PUT/PATCH /appPublishers/{id}
     *
     * @param int $id
     * @param Updateapp_publisherAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_publisherAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_publisher $appPublisher */
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            return $this->sendError('App Publisher not found');
        }

        $appPublisher = $this->appPublisherRepository->update($input, $id);

        return $this->sendResponse($appPublisher->toArray(), 'app_publisher updated successfully');
    }

    /**
     * Remove the specified app_publisher from storage.
     * DELETE /appPublishers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var app_publisher $appPublisher */
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            return $this->sendError('App Publisher not found');
        }

        $appPublisher->delete();

        return $this->sendSuccess('App Publisher deleted successfully');
    }
}
