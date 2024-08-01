<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_userAPIRequest;
use App\Http\Requests\API\Updateapp_userAPIRequest;
use App\Models\app_user;
use App\Repositories\app_userRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_userController
 * @package App\Http\Controllers\API
 */

class app_userAPIController extends AppBaseController
{
    /** @var  app_userRepository */
    private $appUserRepository;

    public function __construct(app_userRepository $appUserRepo)
    {
        $this->appUserRepository = $appUserRepo;
    }

    /**
     * Display a listing of the app_user.
     * GET|HEAD /appUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $appUsers = $this->appUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appUsers->toArray(), 'App Users retrieved successfully');
    }

    /**
     * Store a newly created app_user in storage.
     * POST /appUsers
     *
     * @param Createapp_userAPIRequest $request
     *
     * @return Response
     */
    public function store(Createapp_userAPIRequest $request)
    {
        $input = $request->all();

        $appUser = $this->appUserRepository->create($input);

        return $this->sendResponse($appUser->toArray(), 'App User saved successfully');
    }

    /**
     * Display the specified app_user.
     * GET|HEAD /appUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var app_user $appUser */
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            return $this->sendError('App User not found');
        }

        return $this->sendResponse($appUser->toArray(), 'App User retrieved successfully');
    }

    /**
     * Update the specified app_user in storage.
     * PUT/PATCH /appUsers/{id}
     *
     * @param int $id
     * @param Updateapp_userAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_userAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_user $appUser */
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            return $this->sendError('App User not found');
        }

        $appUser = $this->appUserRepository->update($input, $id);

        return $this->sendResponse($appUser->toArray(), 'app_user updated successfully');
    }

    /**
     * Remove the specified app_user from storage.
     * DELETE /appUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var app_user $appUser */
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            return $this->sendError('App User not found');
        }

        $appUser->delete();

        return $this->sendSuccess('App User deleted successfully');
    }
}
