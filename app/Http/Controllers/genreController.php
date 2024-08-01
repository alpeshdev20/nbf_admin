<?php

namespace App\Http\Controllers;

use App\DataTables\genreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreategenreRequest;
use App\Http\Requests\UpdategenreRequest;
use App\Repositories\genreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class genreController extends AppBaseController
{
    /** @var  genreRepository */
    private $genreRepository;

    public function __construct(genreRepository $genreRepo)
    {
        $this->genreRepository = $genreRepo;
    }

    /**
     * Display a listing of the genre.
     *
     * @param genreDataTable $genreDataTable
     * @return Response
     */
    public function index(genreDataTable $genreDataTable)
    {
        return $genreDataTable->render('genres.index');
    }

    /**
     * Show the form for creating a new genre.
     *
     * @return Response
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param CreategenreRequest $request
     *
     * @return Response
     */
    public function store(CreategenreRequest $request)
    {
        $input = $request->all();

        $genre = $this->genreRepository->create($input);

        Flash::success('Genre saved successfully.');

        return redirect(route('genres.index'));
    }

    /**
     * Display the specified genre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        return view('genres.show')->with('genre', $genre);
    }

    /**
     * Show the form for editing the specified genre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        return view('genres.edit')->with('genre', $genre);
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  int              $id
     * @param UpdategenreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategenreRequest $request)
    {
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        $genre = $this->genreRepository->update($request->all(), $id);

        Flash::success('Genre updated successfully.');

        return redirect(route('genres.index'));
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genre = $this->genreRepository->find($id);

        if (empty($genre)) {
            Flash::error('Genre not found');

            return redirect(route('genres.index'));
        }

        $this->genreRepository->delete($id);

        Flash::success('Genre deleted successfully.');

        return redirect(route('genres.index'));
    }
}
