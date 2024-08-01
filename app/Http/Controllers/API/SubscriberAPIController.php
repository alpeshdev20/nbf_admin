<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSubscriberAPIRequest;
use App\Http\Requests\API\UpdateSubscriberAPIRequest;
use App\Models\Subscriber;
use App\Repositories\SubscriberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SubscriberController
 * @package App\Http\Controllers\API
 */

class SubscriberAPIController extends AppBaseController
{
    /** @var  SubscriberRepository */
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepo)
    {
        $this->subscriberRepository = $subscriberRepo;
    }

    /**
     * Display a listing of the Subscriber.
     * GET|HEAD /subscribers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $subscribers = $this->subscriberRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($subscribers->toArray(), 'Subscribers retrieved successfully');
    }

    /**
     * Store a newly created Subscriber in storage.
     * POST /subscribers
     *
     * @param CreateSubscriberAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriberAPIRequest $request)
    {
        $input = $request->all();

        $subscriber = $this->subscriberRepository->create($input);

        return $this->sendResponse($subscriber->toArray(), 'Subscriber saved successfully');
    }

    /**
     * Display the specified Subscriber.
     * GET|HEAD /subscribers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Subscriber $subscriber */
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            return $this->sendError('Subscriber not found');
        }

        return $this->sendResponse($subscriber->toArray(), 'Subscriber retrieved successfully');
    }

    /**
     * Update the specified Subscriber in storage.
     * PUT/PATCH /subscribers/{id}
     *
     * @param int $id
     * @param UpdateSubscriberAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriberAPIRequest $request)
    {
        $input = $request->all();

        /** @var Subscriber $subscriber */
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            return $this->sendError('Subscriber not found');
        }

        $subscriber = $this->subscriberRepository->update($input, $id);

        return $this->sendResponse($subscriber->toArray(), 'Subscriber updated successfully');
    }

    /**
     * Remove the specified Subscriber from storage.
     * DELETE /subscribers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Subscriber $subscriber */
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            return $this->sendError('Subscriber not found');
        }

        $subscriber->delete();

        return $this->sendSuccess('Subscriber deleted successfully');
    }
}
