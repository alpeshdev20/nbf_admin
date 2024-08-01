<?php

namespace App\Http\Controllers;

use App\DataTables\genresortDataTable;
use App\Http\Requests;
use App\Http\Requests\CreategenresortRequest;
use App\Http\Requests\UpdategenresortRequest;
use App\Repositories\genresortRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class genresortController extends AppBaseController
{
    /** @var  genresortRepository */
    private $genresortRepository;

    public function __construct(genresortRepository $genresortRepo)
    {
        $this->genresortRepository = $genresortRepo;
    }

    /**
     * Display a listing of the genresort.
     *
     * @param genresortDataTable $genresortDataTable
     * @return Response
     */
    public function index(genresortDataTable $genresortDataTable)
    {
        return $genresortDataTable->render('genresorts.index');
    }

    /**
     * Show the form for creating a new genresort.
     *
     * @return Response
     */
    public function create()
    {
        return view('genresorts.create');
    }

    /**
     * Store a newly created genresort in storage.
     *
     * @param CreategenresortRequest $request
     *
     * @return Response
     */
    public function store(CreategenresortRequest $request)
    {
        $input = $request->all();

        $genresort = $this->genresortRepository->create($input);

        Flash::success('Genresort saved successfully.');

        return redirect(route('genresorts.index'));
    }

    /**
     * Display the specified genresort.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            Flash::error('Genresort not found');

            return redirect(route('genresorts.index'));
        }

        return view('genresorts.show')->with('genresort', $genresort);
    }

    /**
     * Show the form for editing the specified genresort.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            Flash::error('Genresort not found');

            return redirect(route('genresorts.index'));
        }

        return view('genresorts.edit')->with('genresort', $genresort);
    }

    /**
     * Update the specified genresort in storage.
     *
     * @param  int              $id
     * @param UpdategenresortRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategenresortRequest $request)
    {
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            Flash::error('Genresort not found');

            return redirect(route('genresorts.index'));
        }

        $genresort = $this->genresortRepository->update($request->all(), $id);

        Flash::success('Genresort updated successfully.');

        return redirect(route('genresorts.index'));
    }

    /**
     * Remove the specified genresort from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $genresort = $this->genresortRepository->find($id);

        if (empty($genresort)) {
            Flash::error('Genresort not found');

            return redirect(route('genresorts.index'));
        }

        $this->genresortRepository->delete($id);

        Flash::success('Genresort deleted successfully.');

        return redirect(route('genresorts.index'));
    }
}
