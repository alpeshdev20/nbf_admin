<?php

namespace App\Http\Controllers;

use App\DataTables\flaged_genreDataTable;
use App\Http\Requests;
use App\Http\Requests\Createflaged_genreRequest;
use App\Http\Requests\Updateflaged_genreRequest;
use App\Repositories\flaged_genreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class flaged_genreController extends AppBaseController
{
    /** @var  flaged_genreRepository */
    private $flagedGenreRepository;

    public function __construct(flaged_genreRepository $flagedGenreRepo)
    {
        $this->flagedGenreRepository = $flagedGenreRepo;
    }

    /**
     * Display a listing of the flaged_genre.
     *
     * @param flaged_genreDataTable $flagedGenreDataTable
     * @return Response
     */
    public function index(flaged_genreDataTable $flagedGenreDataTable)
    {
        return $flagedGenreDataTable->render('flaged_genres.index');
    }

    /**
     * Show the form for creating a new flaged_genre.
     *
     * @return Response
     */
    public function create()
    {
        return view('flaged_genres.create');
    }

    /**
     * Store a newly created flaged_genre in storage.
     *
     * @param Createflaged_genreRequest $request
     *
     * @return Response
     */
    public function store(Createflaged_genreRequest $request)
    {
        $input = $request->all();

        $flagedGenre = $this->flagedGenreRepository->create($input);

        Flash::success('Flaged Genre saved successfully.');

        return redirect(route('flagedGenres.index'));
    }

    /**
     * Display the specified flaged_genre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            Flash::error('Flaged Genre not found');

            return redirect(route('flagedGenres.index'));
        }

        return view('flaged_genres.show')->with('flagedGenre', $flagedGenre);
    }

    /**
     * Show the form for editing the specified flaged_genre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            Flash::error('Flaged Genre not found');

            return redirect(route('flagedGenres.index'));
        }

        return view('flaged_genres.edit')->with('flagedGenre', $flagedGenre);
    }

    /**
     * Update the specified flaged_genre in storage.
     *
     * @param  int              $id
     * @param Updateflaged_genreRequest $request
     *
     * @return Response
     */
    public function update($id, Updateflaged_genreRequest $request)
    {
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            Flash::error('Flaged Genre not found');

            return redirect(route('flagedGenres.index'));
        }

        $flagedGenre = $this->flagedGenreRepository->update($request->all(), $id);

        Flash::success('Flaged Genre updated successfully.');

        return redirect(route('flagedGenres.index'));
    }

    /**
     * Remove the specified flaged_genre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flagedGenre = $this->flagedGenreRepository->find($id);

        if (empty($flagedGenre)) {
            Flash::error('Flaged Genre not found');

            return redirect(route('flagedGenres.index'));
        }

        $this->flagedGenreRepository->delete($id);

        Flash::success('Flaged Genre deleted successfully.');

        return redirect(route('flagedGenres.index'));
    }
}
