<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreategenresortAPIRequest;
use App\Http\Requests\API\UpdategenresortAPIRequest;
use App\Models\genresort;
use App\Repositories\genresortRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class genresortController
 * @package App\Http\Controllers\API
 */

class genresortAPIController extends AppBaseController
{
    /** @var  genresortRepository */
    private $genresortRepository;

    public function __construct(genresortRepository $genresortRepo)
    {
        $this->genresortRepository = $genresortRepo;
    }

    /**
     * Display a listing of the genresort.
     * GET|HEAD /genresorts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $genresorts = $this->genresortRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($genresorts->toArray(), 'Genresorts retrieved successfully');
    }

    /**
     * Store a newly created genresort in storage.
     * POST /genresorts
     *
     * @param CreategenresortAPIRequest $request
     *
     * @return Response
     */
    public function store(CreategenresortAPIRequest $request)
    {
        $input = $request->all();

        $genresort = $this->genresortRepository->create($input);

        return $this->sendResponse($genresort->toArray(), 'Genresort saved successfully');
    }

    /**
     * Display the specified genresort.
     * GET|HEAD /genresorts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var genresort $genresort */
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            return $this->sendError('Genresort not found');
        }

        return $this->sendResponse($genresort->toArray(), 'Genresort retrieved successfully');
    }

    /**
     * Update the specified genresort in storage.
     * PUT/PATCH /genresorts/{id}
     *
     * @param int $id
     * @param UpdategenresortAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategenresortAPIRequest $request)
    {
        $input = $request->all();

        /** @var genresort $genresort */
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            return $this->sendError('Genresort not found');
        }

        $genresort = $this->genresortRepository->update($input, $id);

        return $this->sendResponse($genresort->toArray(), 'genresort updated successfully');
    }

    /**
     * Remove the specified genresort from storage.
     * DELETE /genresorts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var genresort $genresort */
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            return $this->sendError('Genresort not found');
        }

        $genresort->delete();

        return $this->sendSuccess('Genresort deleted successfully');
    }
}
