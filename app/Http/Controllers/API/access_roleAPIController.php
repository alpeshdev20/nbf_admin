<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createaccess_roleAPIRequest;
use App\Http\Requests\API\Updateaccess_roleAPIRequest;
use App\Models\access_role;
use App\Repositories\access_roleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class access_roleController
 * @package App\Http\Controllers\API
 */

class access_roleAPIController extends AppBaseController
{
    /** @var  access_roleRepository */
    private $accessRoleRepository;

    public function __construct(access_roleRepository $accessRoleRepo)
    {
        $this->accessRoleRepository = $accessRoleRepo;
    }

    /**
     * Display a listing of the access_role.
     * GET|HEAD /accessRoles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accessRoles = $this->accessRoleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($accessRoles->toArray(), 'Access Roles retrieved successfully');
    }

    /**
     * Store a newly created access_role in storage.
     * POST /accessRoles
     *
     * @param Createaccess_roleAPIRequest $request
     *
     * @return Response
     */
    public function store(Createaccess_roleAPIRequest $request)
    {
        $input = $request->all();

        $accessRole = $this->accessRoleRepository->create($input);

        return $this->sendResponse($accessRole->toArray(), 'Access Role saved successfully');
    }

    /**
     * Display the specified access_role.
     * GET|HEAD /accessRoles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var access_role $accessRole */
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            return $this->sendError('Access Role not found');
        }

        return $this->sendResponse($accessRole->toArray(), 'Access Role retrieved successfully');
    }

    /**
     * Update the specified access_role in storage.
     * PUT/PATCH /accessRoles/{id}
     *
     * @param int $id
     * @param Updateaccess_roleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccess_roleAPIRequest $request)
    {
        $input = $request->all();

        /** @var access_role $accessRole */
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            return $this->sendError('Access Role not found');
        }

        $accessRole = $this->accessRoleRepository->update($input, $id);

        return $this->sendResponse($accessRole->toArray(), 'access_role updated successfully');
    }

    /**
     * Remove the specified access_role from storage.
     * DELETE /accessRoles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var access_role $accessRole */
        $accessRole = $this->accessRoleRepository->find($id);

        if (empty($accessRole)) {
            return $this->sendError('Access Role not found');
        }

        $accessRole->delete();

        return $this->sendSuccess('Access Role deleted successfully');
    }
}
