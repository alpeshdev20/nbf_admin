<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSubscription_planAPIRequest;
use App\Http\Requests\API\UpdateSubscription_planAPIRequest;
use App\Models\Subscription_plan;
use App\Repositories\Subscription_planRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Subscription_planController
 * @package App\Http\Controllers\API
 */

class Subscription_planAPIController extends AppBaseController
{
    /** @var  Subscription_planRepository */
    private $subscriptionPlanRepository;

    public function __construct(Subscription_planRepository $subscriptionPlanRepo)
    {
        $this->subscriptionPlanRepository = $subscriptionPlanRepo;
    }

    /**
     * Display a listing of the Subscription_plan.
     * GET|HEAD /subscriptionPlans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $subscriptionPlans = $this->subscriptionPlanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($subscriptionPlans->toArray(), 'Subscription Plans retrieved successfully');
    }

    /**
     * Store a newly created Subscription_plan in storage.
     * POST /subscriptionPlans
     *
     * @param CreateSubscription_planAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscription_planAPIRequest $request)
    {
        $input = $request->all();

        $subscriptionPlan = $this->subscriptionPlanRepository->create($input);

        return $this->sendResponse($subscriptionPlan->toArray(), 'Subscription Plan saved successfully');
    }

    /**
     * Display the specified Subscription_plan.
     * GET|HEAD /subscriptionPlans/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Subscription_plan $subscriptionPlan */
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);

        if (empty($subscriptionPlan)) {
            return $this->sendError('Subscription Plan not found');
        }

        return $this->sendResponse($subscriptionPlan->toArray(), 'Subscription Plan retrieved successfully');
    }

    /**
     * Update the specified Subscription_plan in storage.
     * PUT/PATCH /subscriptionPlans/{id}
     *
     * @param int $id
     * @param UpdateSubscription_planAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscription_planAPIRequest $request)
    {
        $input = $request->all();

        /** @var Subscription_plan $subscriptionPlan */
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);

        if (empty($subscriptionPlan)) {
            return $this->sendError('Subscription Plan not found');
        }

        $subscriptionPlan = $this->subscriptionPlanRepository->update($input, $id);

        return $this->sendResponse($subscriptionPlan->toArray(), 'Subscription_plan updated successfully');
    }

    /**
     * Remove the specified Subscription_plan from storage.
     * DELETE /subscriptionPlans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Subscription_plan $subscriptionPlan */
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);

        if (empty($subscriptionPlan)) {
            return $this->sendError('Subscription Plan not found');
        }

        $subscriptionPlan->delete();

        return $this->sendSuccess('Subscription Plan deleted successfully');
    }
}
