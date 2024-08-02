<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreategenreAPIRequest;
use App\Http\Requests\API\UpdategenreAPIRequest;
use App\Models\genre;
use App\Repositories\genreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class genreController
 * @package App\Http\Controllers\API
 */

class genreAPIController extends AppBaseController
{
    /** @var  genreRepository */
    private $genreRepository;

    public function __construct(genreRepository $genreRepo)
    {
        $this->genreRepository = $genreRepo;
    }

    /**
     * Display a listing of the genre.
     * GET|HEAD /genres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $genres = $this->genreRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($genres->toArray(), 'Genres retrieved successfully');
    }

    /**
     * Store a newly created genre in storage.
     * POST /genres
     *
     * @param CreategenreAPIRequest $request
     *
     * @return Response
     */
    public function store(CreategenreAPIRequest $request)
    {
        $input = $request->all();

        $genre = $this->genreRepository->create($input);

        return $this->sendResponse($genre->toArray(), 'Genre saved successfully');
    }

    /**
     * Display the specified genre.
     * GET|HEAD /genres/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var genre $genre */
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            return $this->sendError('Genre not found');
        }

        return $this->sendResponse($genre->toArray(), 'Genre retrieved successfully');
    }

    /**
     * Update the specified genre in storage.
     * PUT/PATCH /genres/{id}
     *
     * @param int $id
     * @param UpdategenreAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategenreAPIRequest $request)
    {
        $input = $request->all();

        /** @var genre $genre */
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            return $this->sendError('Genre not found');
        }

        $genre = $this->genreRepository->update($input, $id);

        return $this->sendResponse($genre->toArray(), 'genre updated successfully');
    }

    /**
     * Remove the specified genre from storage.
     * DELETE /genres/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var genre $genre */
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            return $this->sendError('Genre not found');
        }

        $genre->delete();

        return $this->sendSuccess('Genre deleted successfully');
    }
}
