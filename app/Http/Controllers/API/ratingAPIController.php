<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateratingAPIRequest;
use App\Http\Requests\API\UpdateratingAPIRequest;
use App\Models\rating;
use App\Repositories\ratingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ratingController
 * @package App\Http\Controllers\API
 */

class ratingAPIController extends AppBaseController
{
    /** @var  ratingRepository */
    private $ratingRepository;

    public function __construct(ratingRepository $ratingRepo)
    {
        $this->ratingRepository = $ratingRepo;
    }

    /**
     * Display a listing of the rating.
     * GET|HEAD /ratings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ratings = $this->ratingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ratings->toArray(), 'Ratings retrieved successfully');
    }

    /**
     * Store a newly created rating in storage.
     * POST /ratings
     *
     * @param CreateratingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateratingAPIRequest $request)
    {
        $input = $request->all();

        $rating = $this->ratingRepository->create($input);

        return $this->sendResponse($rating->toArray(), 'Rating saved successfully');
    }

    /**
     * Display the specified rating.
     * GET|HEAD /ratings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        return $this->sendResponse($rating->toArray(), 'Rating retrieved successfully');
    }

    /**
     * Update the specified rating in storage.
     * PUT/PATCH /ratings/{id}
     *
     * @param int $id
     * @param UpdateratingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateratingAPIRequest $request)
    {
        $input = $request->all();

        /** @var rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating = $this->ratingRepository->update($input, $id);

        return $this->sendResponse($rating->toArray(), 'rating updated successfully');
    }

    /**
     * Remove the specified rating from storage.
     * DELETE /ratings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rating $rating */
        $rating = $this->ratingRepository->find($id);

        if (empty($rating)) {
            return $this->sendError('Rating not found');
        }

        $rating->delete();

        return $this->sendSuccess('Rating deleted successfully');
    }
}
