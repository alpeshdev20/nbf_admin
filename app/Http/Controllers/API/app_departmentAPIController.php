<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_departmentAPIRequest;
use App\Http\Requests\API\Updateapp_departmentAPIRequest;
use App\Models\app_department;
use App\Repositories\app_departmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_departmentController
 * @package App\Http\Controllers\API
 */

class app_departmentAPIController extends AppBaseController
{
    /** @var  app_departmentRepository */
    private $appDepartmentRepository;

    public function __construct(app_departmentRepository $appDepartmentRepo)
    {
        $this->appDepartmentRepository = $appDepartmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/appDepartments",
     *      summary="Get a listing of the app_departments.",
     *      tags={"app_department"},
     *      description="Get all app_departments",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/app_department")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $appDepartments = $this->appDepartmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appDepartments->toArray(), 'App Departments retrieved successfully');
    }

    /**
     * @param Createapp_departmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/appDepartments",
     *      summary="Store a newly created app_department in storage",
     *      tags={"app_department"},
     *      description="Store app_department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_department that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_department")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/app_department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createapp_departmentAPIRequest $request)
    {
        $input = $request->all();

        $appDepartment = $this->appDepartmentRepository->create($input);

        return $this->sendResponse($appDepartment->toArray(), 'App Department saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/appDepartments/{id}",
     *      summary="Display the specified app_department",
     *      tags={"app_department"},
     *      description="Get app_department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/app_department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var app_department $appDepartment */
        $appDepartment = $this->appDepartmentRepository->find($id);

        if (empty($appDepartment)) {
            return $this->sendError('App Department not found');
        }

        return $this->sendResponse($appDepartment->toArray(), 'App Department retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updateapp_departmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/appDepartments/{id}",
     *      summary="Update the specified app_department in storage",
     *      tags={"app_department"},
     *      description="Update app_department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_department that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_department")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/app_department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updateapp_departmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_department $appDepartment */
        $appDepartment = $this->appDepartmentRepository->find($id);

        if (empty($appDepartment)) {
            return $this->sendError('App Department not found');
        }

        $appDepartment = $this->appDepartmentRepository->update($input, $id);

        return $this->sendResponse($appDepartment->toArray(), 'app_department updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/appDepartments/{id}",
     *      summary="Remove the specified app_department from storage",
     *      tags={"app_department"},
     *      description="Delete app_department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var app_department $appDepartment */
        $appDepartment = $this->appDepartmentRepository->find($id);

        if (empty($appDepartment)) {
            return $this->sendError('App Department not found');
        }

        $appDepartment->delete();

        return $this->sendSuccess('App Department deleted successfully');
    }
}
