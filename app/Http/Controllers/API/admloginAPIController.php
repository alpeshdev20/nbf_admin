<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateadmloginAPIRequest;
use App\Http\Requests\API\UpdateadmloginAPIRequest;
use App\Models\admlogin;
use App\Repositories\admloginRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class admloginController
 * @package App\Http\Controllers\API
 */

class admloginAPIController extends AppBaseController
{
    /** @var  admloginRepository */
    private $admloginRepository;

    public function __construct(admloginRepository $admloginRepo)
    {
        $this->admloginRepository = $admloginRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/admlogins",
     *      summary="Get a listing of the admlogins.",
     *      tags={"admlogin"},
     *      description="Get all admlogins",
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
     *                  @SWG\Items(ref="#/definitions/admlogin")
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
        $admlogins = $this->admloginRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($admlogins->toArray(), 'Admlogins retrieved successfully');
    }

    /**
     * @param CreateadmloginAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/admlogins",
     *      summary="Store a newly created admlogin in storage",
     *      tags={"admlogin"},
     *      description="Store admlogin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="admlogin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/admlogin")
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
     *                  ref="#/definitions/admlogin"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateadmloginAPIRequest $request)
    {
        $input = $request->all();

        $admlogin = $this->admloginRepository->create($input);

        return $this->sendResponse($admlogin->toArray(), 'Admlogin saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/admlogins/{id}",
     *      summary="Display the specified admlogin",
     *      tags={"admlogin"},
     *      description="Get admlogin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of admlogin",
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
     *                  ref="#/definitions/admlogin"
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
        /** @var admlogin $admlogin */
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            return $this->sendError('Admlogin not found');
        }

        return $this->sendResponse($admlogin->toArray(), 'Admlogin retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateadmloginAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/admlogins/{id}",
     *      summary="Update the specified admlogin in storage",
     *      tags={"admlogin"},
     *      description="Update admlogin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of admlogin",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="admlogin that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/admlogin")
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
     *                  ref="#/definitions/admlogin"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateadmloginAPIRequest $request)
    {
        $input = $request->all();

        /** @var admlogin $admlogin */
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            return $this->sendError('Admlogin not found');
        }

        $admlogin = $this->admloginRepository->update($input, $id);

        return $this->sendResponse($admlogin->toArray(), 'admlogin updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/admlogins/{id}",
     *      summary="Remove the specified admlogin from storage",
     *      tags={"admlogin"},
     *      description="Delete admlogin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of admlogin",
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
        /** @var admlogin $admlogin */
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            return $this->sendError('Admlogin not found');
        }

        $admlogin->delete();

        return $this->sendSuccess('Admlogin deleted successfully');
    }
}
