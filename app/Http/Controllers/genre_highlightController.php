<?php

namespace App\Http\Controllers;

use App\DataTables\genre_highlightDataTable;
use App\Http\Requests;
use App\Http\Requests\Creategenre_highlightRequest;
use App\Http\Requests\Updategenre_highlightRequest;
use App\Repositories\genre_highlightRepository;
use Flash;
use App\Models\genre;
use App\Http\Controllers\AppBaseController;
use Response;

class genre_highlightController extends AppBaseController
{
    /** @var  genre_highlightRepository */
    private $genreHighlightRepository;

    public function __construct(genre_highlightRepository $genreHighlightRepo)
    {
        $this->genreHighlightRepository = $genreHighlightRepo;
    }

    /**
     * Display a listing of the genre_highlight.
     *
     * @param genre_highlightDataTable $genreHighlightDataTable
     * @return Response
     */
    public function index(genre_highlightDataTable $genreHighlightDataTable)
    {
        return $genreHighlightDataTable->render('genre_highlights.index');
    }

    /**
     * Show the form for creating a new genre_highlight.
     *
     * @return Response
     */
    public function create()
    {
        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        return view('genre_highlights.create')->with(array('genre' => $gdata));
    }

    /**
     * Store a newly created genre_highlight in storage.
     *
     * @param Creategenre_highlightRequest $request
     *
     * @return Response
     */
    public function store(Creategenre_highlightRequest $request)
    {
        $input = $request->all();

        $genreHighlight = $this->genreHighlightRepository->create($input);

        Flash::success('Genre Highlight saved successfully.');

        return redirect(route('genreHighlights.index'));
    }

    /**
     * Display the specified genre_highlight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            Flash::error('Genre Highlight not found');

            return redirect(route('genreHighlights.index'));
        }

        return view('genre_highlights.show')->with('genreHighlight', $genreHighlight);
    }

    /**
     * Show the form for editing the specified genre_highlight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            Flash::error('Genre Highlight not found');

            return redirect(route('genreHighlights.index'));
        }

        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();


        return view('genre_highlights.edit')->with(array('genre' => $gdata,'genreHighlight' => $genreHighlight));
    }

    /**
     * Update the specified genre_highlight in storage.
     *
     * @param  int              $id
     * @param Updategenre_highlightRequest $request
     *
     * @return Response
     */
    public function update($id, Updategenre_highlightRequest $request)
    {
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            Flash::error('Genre Highlight not found');

            return redirect(route('genreHighlights.index'));
        }

        $genreHighlight = $this->genreHighlightRepository->update($request->all(), $id);

        Flash::success('Genre Highlight updated successfully.');

        return redirect(route('genreHighlights.index'));
    }

    /**
     * Remove the specified genre_highlight from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            Flash::error('Genre Highlight not found');

            return redirect(route('genreHighlights.index'));
        }

        $this->genreHighlightRepository->delete($id);

        Flash::success('Genre Highlight deleted successfully.');

        return redirect(route('genreHighlights.index'));
    }
}
