<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createadmin_accessAPIRequest;
use App\Http\Requests\API\Updateadmin_accessAPIRequest;
use App\Models\admin_access;
use App\Repositories\admin_accessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class admin_accessController
 * @package App\Http\Controllers\API
 */

class admin_accessAPIController extends AppBaseController
{
    /** @var  admin_accessRepository */
    private $adminAccessRepository;

    public function __construct(admin_accessRepository $adminAccessRepo)
    {
        $this->adminAccessRepository = $adminAccessRepo;
    }

    /**
     * Display a listing of the admin_access.
     * GET|HEAD /adminAccesses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $adminAccesses = $this->adminAccessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($adminAccesses->toArray(), 'Admin Accesses retrieved successfully');
    }

    /**
     * Store a newly created admin_access in storage.
     * POST /adminAccesses
     *
     * @param Createadmin_accessAPIRequest $request
     *
     * @return Response
     */
    public function store(Createadmin_accessAPIRequest $request)
    {
        $input = $request->all();

        $adminAccess = $this->adminAccessRepository->create($input);

        return $this->sendResponse($adminAccess->toArray(), 'Admin Access saved successfully');
    }

    /**
     * Display the specified admin_access.
     * GET|HEAD /adminAccesses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var admin_access $adminAccess */
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            return $this->sendError('Admin Access not found');
        }

        return $this->sendResponse($adminAccess->toArray(), 'Admin Access retrieved successfully');
    }

    /**
     * Update the specified admin_access in storage.
     * PUT/PATCH /adminAccesses/{id}
     *
     * @param int $id
     * @param Updateadmin_accessAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateadmin_accessAPIRequest $request)
    {
        $input = $request->all();

        /** @var admin_access $adminAccess */
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            return $this->sendError('Admin Access not found');
        }

        $adminAccess = $this->adminAccessRepository->update($input, $id);

        return $this->sendResponse($adminAccess->toArray(), 'admin_access updated successfully');
    }

    /**
     * Remove the specified admin_access from storage.
     * DELETE /adminAccesses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var admin_access $adminAccess */
        $adminAccess = $this->adminAccessRepository->find($id);

        if (empty($adminAccess)) {
            return $this->sendError('Admin Access not found');
        }

        $adminAccess->delete();

        return $this->sendSuccess('Admin Access deleted successfully');
    }
}
