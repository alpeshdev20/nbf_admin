<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_subjectAPIRequest;
use App\Http\Requests\API\Updateapp_subjectAPIRequest;
use App\Models\app_subject;
use App\Repositories\app_subjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_subjectController
 * @package App\Http\Controllers\API
 */

class app_subjectAPIController extends AppBaseController
{
    /** @var  app_subjectRepository */
    private $appSubjectRepository;

    public function __construct(app_subjectRepository $appSubjectRepo)
    {
        $this->appSubjectRepository = $appSubjectRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/appSubjects",
     *      summary="Get a listing of the app_subjects.",
     *      tags={"app_subject"},
     *      description="Get all app_subjects",
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
     *                  @SWG\Items(ref="#/definitions/app_subject")
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
        $appSubjects = $this->appSubjectRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appSubjects->toArray(), 'App Subjects retrieved successfully');
    }

    /**
     * @param Createapp_subjectAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/appSubjects",
     *      summary="Store a newly created app_subject in storage",
     *      tags={"app_subject"},
     *      description="Store app_subject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_subject that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_subject")
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
     *                  ref="#/definitions/app_subject"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createapp_subjectAPIRequest $request)
    {
        $input = $request->all();

        $appSubject = $this->appSubjectRepository->create($input);

        return $this->sendResponse($appSubject->toArray(), 'App Subject saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/appSubjects/{id}",
     *      summary="Display the specified app_subject",
     *      tags={"app_subject"},
     *      description="Get app_subject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_subject",
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
     *                  ref="#/definitions/app_subject"
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
        /** @var app_subject $appSubject */
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            return $this->sendError('App Subject not found');
        }

        return $this->sendResponse($appSubject->toArray(), 'App Subject retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updateapp_subjectAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/appSubjects/{id}",
     *      summary="Update the specified app_subject in storage",
     *      tags={"app_subject"},
     *      description="Update app_subject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_subject",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_subject that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_subject")
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
     *                  ref="#/definitions/app_subject"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updateapp_subjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_subject $appSubject */
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            return $this->sendError('App Subject not found');
        }

        $appSubject = $this->appSubjectRepository->update($input, $id);

        return $this->sendResponse($appSubject->toArray(), 'app_subject updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/appSubjects/{id}",
     *      summary="Remove the specified app_subject from storage",
     *      tags={"app_subject"},
     *      description="Delete app_subject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_subject",
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
        /** @var app_subject $appSubject */
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            return $this->sendError('App Subject not found');
        }

        $appSubject->delete();

        return $this->sendSuccess('App Subject deleted successfully');
    }
}
