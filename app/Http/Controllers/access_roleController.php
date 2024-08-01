<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createaccess_roleRequest;
use App\Http\Requests\Updateaccess_roleRequest;
use App\Repositories\access_roleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class access_roleController extends AppBaseController
{
    /** @var  access_roleRepository */
    private $accessRoleRepository;

    public function __construct(access_roleRepository $accessRoleRepo)
    {
        $this->accessRoleRepository = $accessRoleRepo;
    }

    /**
     * Display a listing of the access_role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accessRoles = $this->accessRoleRepository->paginate(10);

        return view('access_roles.index')
            ->with('accessRoles', $accessRoles);
    }

    /**
     * Show the form for creating a new access_role.
     *
     * @return Response
     */
    public function create()
    {
        return view('access_roles.create');
    }

    /**
     * Store a newly created access_role in storage.
     *
     * @param Createaccess_roleRequest $request
     *
     * @return Response
     */
    public function store(Createaccess_roleRequest $request)
    {
        $input = $request->all();

        $accessRole = $this->accessRoleRepository->create($input);

        Flash::success('Access Role saved successfully.');

        return redirect(route('accessRoles.index'));
    }

    /**
     * Display the specified access_role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            Flash::error('Access Role not found');

            return redirect(route('accessRoles.index'));
        }

        return view('access_roles.show')->with('accessRole', $accessRole);
    }

    /**
     * Show the form for editing the specified access_role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            Flash::error('Access Role not found');

            return redirect(route('accessRoles.index'));
        }

        return view('access_roles.edit')->with('accessRole', $accessRole);
    }

    /**
     * Update the specified access_role in storage.
     *
     * @param int $id
     * @param Updateaccess_roleRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccess_roleRequest $request)
    {
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            Flash::error('Access Role not found');

            return redirect(route('accessRoles.index'));
        }

        $accessRole = $this->accessRoleRepository->update($request->all(), $id);

        Flash::success('Access Role updated successfully.');

        return redirect(route('accessRoles.index'));
    }

    /**
     * Remove the specified access_role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            Flash::error('Access Role not found');

            return redirect(route('accessRoles.index'));
        }

        $this->accessRoleRepository->delete($id);

        Flash::success('Access Role deleted successfully.');

        return redirect(route('accessRoles.index'));
    }
}
