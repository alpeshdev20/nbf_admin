<?php

namespace App\Http\Controllers;

use App\DataTables\userfavDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateuserfavRequest;
use App\Http\Requests\UpdateuserfavRequest;
use App\Repositories\userfavRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class userfavController extends AppBaseController
{
    /** @var  userfavRepository */
    private $userfavRepository;

    public function __construct(userfavRepository $userfavRepo)
    {
        $this->userfavRepository = $userfavRepo;
    }

    /**
     * Display a listing of the userfav.
     *
     * @param userfavDataTable $userfavDataTable
     * @return Response
     */
    public function index(userfavDataTable $userfavDataTable)
    {
        return $userfavDataTable->render('userfavs.index');
    }

    /**
     * Show the form for creating a new userfav.
     *
     * @return Response
     */
    public function create()
    {
        return view('userfavs.create');
    }

    /**
     * Store a newly created userfav in storage.
     *
     * @param CreateuserfavRequest $request
     *
     * @return Response
     */
    public function store(CreateuserfavRequest $request)
    {
        $input = $request->all();

        $userfav = $this->userfavRepository->create($input);

        Flash::success('Userfav saved successfully.');

        return redirect(route('userfavs.index'));
    }

    /**
     * Display the specified userfav.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            Flash::error('Userfav not found');

            return redirect(route('userfavs.index'));
        }

        return view('userfavs.show')->with('userfav', $userfav);
    }

    /**
     * Show the form for editing the specified userfav.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            Flash::error('Userfav not found');

            return redirect(route('userfavs.index'));
        }

        return view('userfavs.edit')->with('userfav', $userfav);
    }

    /**
     * Update the specified userfav in storage.
     *
     * @param  int              $id
     * @param UpdateuserfavRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateuserfavRequest $request)
    {
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            Flash::error('Userfav not found');

            return redirect(route('userfavs.index'));
        }

        $userfav = $this->userfavRepository->update($request->all(), $id);

        Flash::success('Userfav updated successfully.');

        return redirect(route('userfavs.index'));
    }

    /**
     * Remove the specified userfav from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userfav = $this->userfavRepository->find($id);

        if (empty($userfav)) {
            Flash::error('Userfav not found');

            return redirect(route('userfavs.index'));
        }

        $this->userfavRepository->delete($id);

        Flash::success('Userfav deleted successfully.');

        return redirect(route('userfavs.index'));
    }
}
