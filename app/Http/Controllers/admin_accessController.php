<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createadmin_accessRequest;
use App\Http\Requests\Updateadmin_accessRequest;
use App\Repositories\admin_accessRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class admin_accessController extends AppBaseController
{
    /** @var  admin_accessRepository */
    private $adminAccessRepository;

    public function __construct(admin_accessRepository $adminAccessRepo)
    {
        $this->adminAccessRepository = $adminAccessRepo;
    }

    /**
     * Display a listing of the admin_access.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $adminAccesses = $this->adminAccessRepository->paginate(10);

        return view('admin_accesses.index')
            ->with('adminAccesses', $adminAccesses);
    }

    /**
     * Show the form for creating a new admin_access.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin_accesses.create');
    }

    /**
     * Store a newly created admin_access in storage.
     *
     * @param Createadmin_accessRequest $request
     *
     * @return Response
     */
    public function store(Createadmin_accessRequest $request)
    {
        $input = $request->all();

        $adminAccess = $this->adminAccessRepository->create($input);

        Flash::success('Admin Access saved successfully.');

        return redirect(route('adminAccesses.index'));
    }

    /**
     * Display the specified admin_access.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            Flash::error('Admin Access not found');

            return redirect(route('adminAccesses.index'));
        }

        return view('admin_accesses.show')->with('adminAccess', $adminAccess);
    }

    /**
     * Show the form for editing the specified admin_access.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            Flash::error('Admin Access not found');

            return redirect(route('adminAccesses.index'));
        }

        return view('admin_accesses.edit')->with('adminAccess', $adminAccess);
    }

    /**
     * Update the specified admin_access in storage.
     *
     * @param int $id
     * @param Updateadmin_accessRequest $request
     *
     * @return Response
     */
    public function update($id, Updateadmin_accessRequest $request)
    {
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            Flash::error('Admin Access not found');

            return redirect(route('adminAccesses.index'));
        }

        $adminAccess = $this->adminAccessRepository->update($request->all(), $id);

        Flash::success('Admin Access updated successfully.');

        return redirect(route('adminAccesses.index'));
    }

    /**
     * Remove the specified admin_access from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            Flash::error('Admin Access not found');

            return redirect(route('adminAccesses.index'));
        }

        $this->adminAccessRepository->delete($id);

        Flash::success('Admin Access deleted successfully.');

        return redirect(route('adminAccesses.index'));
    }
}
