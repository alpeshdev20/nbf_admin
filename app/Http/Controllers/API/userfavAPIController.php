<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateuserfavAPIRequest;
use App\Http\Requests\API\UpdateuserfavAPIRequest;
use App\Models\userfav;
use App\Repositories\userfavRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class userfavController
 * @package App\Http\Controllers\API
 */

class userfavAPIController extends AppBaseController
{
    /** @var  userfavRepository */
    private $userfavRepository;

    public function __construct(userfavRepository $userfavRepo)
    {
        $this->userfavRepository = $userfavRepo;
    }

    /**
     * Display a listing of the userfav.
     * GET|HEAD /userfavs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userfavs = $this->userfavRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userfavs->toArray(), 'Userfavs retrieved successfully');
    }

    /**
     * Store a newly created userfav in storage.
     * POST /userfavs
     *
     * @param CreateuserfavAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateuserfavAPIRequest $request)
    {
        $input = $request->all();

        $userfav = $this->userfavRepository->create($input);

        return $this->sendResponse($userfav->toArray(), 'Userfav saved successfully');
    }

    /**
     * Display the specified userfav.
     * GET|HEAD /userfavs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var userfav $userfav */
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            return $this->sendError('Userfav not found');
        }

        return $this->sendResponse($userfav->toArray(), 'Userfav retrieved successfully');
    }

    /**
     * Update the specified userfav in storage.
     * PUT/PATCH /userfavs/{id}
     *
     * @param int $id
     * @param UpdateuserfavAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateuserfavAPIRequest $request)
    {
        $input = $request->all();

        /** @var userfav $userfav */
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            return $this->sendError('Userfav not found');
        }

        $userfav = $this->userfavRepository->update($input, $id);

        return $this->sendResponse($userfav->toArray(), 'userfav updated successfully');
    }

    /**
     * Remove the specified userfav from storage.
     * DELETE /userfavs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var userfav $userfav */
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            return $this->sendError('Userfav not found');
        }

        $userfav->delete();

        return $this->sendSuccess('Userfav deleted successfully');
    }
}
