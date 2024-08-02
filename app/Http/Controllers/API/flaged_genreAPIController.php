<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createflaged_genreAPIRequest;
use App\Http\Requests\API\Updateflaged_genreAPIRequest;
use App\Models\flaged_genre;
use App\Repositories\flaged_genreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class flaged_genreController
 * @package App\Http\Controllers\API
 */

class flaged_genreAPIController extends AppBaseController
{
    /** @var  flaged_genreRepository */
    private $flagedGenreRepository;

    public function __construct(flaged_genreRepository $flagedGenreRepo)
    {
        $this->flagedGenreRepository = $flagedGenreRepo;
    }

    /**
     * Display a listing of the flaged_genre.
     * GET|HEAD /flagedGenres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $flagedGenres = $this->flagedGenreRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($flagedGenres->toArray(), 'Flaged Genres retrieved successfully');
    }

    /**
     * Store a newly created flaged_genre in storage.
     * POST /flagedGenres
     *
     * @param Createflaged_genreAPIRequest $request
     *
     * @return Response
     */
    public function store(Createflaged_genreAPIRequest $request)
    {
        $input = $request->all();

        $flagedGenre = $this->flagedGenreRepository->create($input);

        return $this->sendResponse($flagedGenre->toArray(), 'Flaged Genre saved successfully');
    }

    /**
     * Display the specified flaged_genre.
     * GET|HEAD /flagedGenres/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var flaged_genre $flagedGenre */
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            return $this->sendError('Flaged Genre not found');
        }

        return $this->sendResponse($flagedGenre->toArray(), 'Flaged Genre retrieved successfully');
    }

    /**
     * Update the specified flaged_genre in storage.
     * PUT/PATCH /flagedGenres/{id}
     *
     * @param int $id
     * @param Updateflaged_genreAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateflaged_genreAPIRequest $request)
    {
        $input = $request->all();

        /** @var flaged_genre $flagedGenre */
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            return $this->sendError('Flaged Genre not found');
        }

        $flagedGenre = $this->flagedGenreRepository->update($input, $id);

        return $this->sendResponse($flagedGenre->toArray(), 'flaged_genre updated successfully');
    }

    /**
     * Remove the specified flaged_genre from storage.
     * DELETE /flagedGenres/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var flaged_genre $flagedGenre */
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            return $this->sendError('Flaged Genre not found');
        }

        $flagedGenre->delete();

        return $this->sendSuccess('Flaged Genre deleted successfully');
    }
}
