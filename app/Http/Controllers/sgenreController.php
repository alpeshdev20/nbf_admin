<?php

namespace App\Http\Controllers;

use App\DataTables\sgenreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatesgenreRequest;
use App\Http\Requests\UpdatesgenreRequest;
use App\Repositories\sgenreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;

class sgenreController extends AppBaseController
{
    /** @var  sgenreRepository */
    private $sgenreRepository;

    public function __construct(sgenreRepository $sgenreRepo)
    {
        $this->sgenreRepository = $sgenreRepo;
    }

    /**
     * Display a listing of the sgenre.
     *
     * @param sgenreDataTable $sgenreDataTable
     * @return Response
     */
    public function index(sgenreDataTable $sgenreDataTable)
    {
        return $sgenreDataTable->render('sgenres.index');
    }

    /**
     * Show the form for creating a new sgenre.
     *
     * @return Response
     */
    public function create()
    {
        $categories = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $data = $categories->toArray();
        return view('sgenres.create')->with('genre', $data);
    }

    /**
     * Store a newly created sgenre in storage.
     *
     * @param CreatesgenreRequest $request
     *
     * @return Response
     */
    public function store(CreatesgenreRequest $request)
    {
        $input = $request->all();

        $sgenre = $this->sgenreRepository->create($input);

        Flash::success('Sgenre saved successfully.');

        return redirect(route('sgenres.index'));
    }

    /**
     * Display the specified sgenre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            Flash::error('Sgenre not found');

            return redirect(route('sgenres.index'));
        }

        return view('sgenres.show')->with('sgenre', $sgenre);
    }

    /**
     * Show the form for editing the specified sgenre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            Flash::error('Sgenre not found');

            return redirect(route('sgenres.index'));
        }

        $categories = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $data = $categories->toArray();

        return view('sgenres.edit')->with('sgenre', $sgenre)->with(array('sgenre'=> $sgenre ,'genre'=> $data));
    }

    /**
     * Update the specified sgenre in storage.
     *
     * @param  int              $id
     * @param UpdatesgenreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesgenreRequest $request)
    {
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            Flash::error('Sgenre not found');

            return redirect(route('sgenres.index'));
        }

        $sgenre = $this->sgenreRepository->update($request->all(), $id);

        Flash::success('Sgenre updated successfully.');

        return redirect(route('sgenres.index'));
    }

    /**
     * Remove the specified sgenre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            Flash::error('Sgenre not found');

            return redirect(route('sgenres.index'));
        }

        $this->sgenreRepository->delete($id);

        Flash::success('Sgenre deleted successfully.');

        return redirect(route('sgenres.index'));
    }
}
