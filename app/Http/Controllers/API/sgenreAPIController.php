<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatesgenreAPIRequest;
use App\Http\Requests\API\UpdatesgenreAPIRequest;
use App\Models\sgenre;
use App\Repositories\sgenreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class sgenreController
 * @package App\Http\Controllers\API
 */

class sgenreAPIController extends AppBaseController
{
    /** @var  sgenreRepository */
    private $sgenreRepository;

    public function __construct(sgenreRepository $sgenreRepo)
    {
        $this->sgenreRepository = $sgenreRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sgenres",
     *      summary="Get a listing of the sgenres.",
     *      tags={"sgenre"},
     *      description="Get all sgenres",
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
     *                  @SWG\Items(ref="#/definitions/sgenre")
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
        $sgenres = $this->sgenreRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($sgenres->toArray(), 'Sgenres retrieved successfully');
    }

    /**
     * @param CreatesgenreAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sgenres",
     *      summary="Store a newly created sgenre in storage",
     *      tags={"sgenre"},
     *      description="Store sgenre",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sgenre that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sgenre")
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
     *                  ref="#/definitions/sgenre"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatesgenreAPIRequest $request)
    {
        $input = $request->all();

        $sgenre = $this->sgenreRepository->create($input);

        return $this->sendResponse($sgenre->toArray(), 'Sgenre saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sgenres/{id}",
     *      summary="Display the specified sgenre",
     *      tags={"sgenre"},
     *      description="Get sgenre",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sgenre",
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
     *                  ref="#/definitions/sgenre"
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
        /** @var sgenre $sgenre */
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            return $this->sendError('Sgenre not found');
        }

        return $this->sendResponse($sgenre->toArray(), 'Sgenre retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatesgenreAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sgenres/{id}",
     *      summary="Update the specified sgenre in storage",
     *      tags={"sgenre"},
     *      description="Update sgenre",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sgenre",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="sgenre that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/sgenre")
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
     *                  ref="#/definitions/sgenre"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatesgenreAPIRequest $request)
    {
        $input = $request->all();

        /** @var sgenre $sgenre */
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            return $this->sendError('Sgenre not found');
        }

        $sgenre = $this->sgenreRepository->update($input, $id);

        return $this->sendResponse($sgenre->toArray(), 'sgenre updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sgenres/{id}",
     *      summary="Remove the specified sgenre from storage",
     *      tags={"sgenre"},
     *      description="Delete sgenre",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of sgenre",
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
        /** @var sgenre $sgenre */
        $sgenre = $this->sgenreRepository->find($id);

        if (empty($sgenre)) {
            return $this->sendError('Sgenre not found');
        }

        $sgenre->delete();

        return $this->sendSuccess('Sgenre deleted successfully');
    }
}
