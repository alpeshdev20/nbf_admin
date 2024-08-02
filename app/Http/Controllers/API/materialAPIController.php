<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatematerialAPIRequest;
use App\Http\Requests\API\UpdatematerialAPIRequest;
use App\Models\material;
use App\Repositories\materialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class materialController
 * @package App\Http\Controllers\API
 */

class materialAPIController extends AppBaseController
{
    /** @var  materialRepository */
    private $materialRepository;

    public function __construct(materialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/materials",
     *      summary="Get a listing of the materials.",
     *      tags={"material"},
     *      description="Get all materials",
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
     *                  @SWG\Items(ref="#/definitions/material")
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
        $materials = $this->materialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($materials->toArray(), 'Materials retrieved successfully');
    }

    /**
     * @param CreatematerialAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/materials",
     *      summary="Store a newly created material in storage",
     *      tags={"material"},
     *      description="Store material",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="material that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/material")
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
     *                  ref="#/definitions/material"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatematerialAPIRequest $request)
    {
        $input = $request->all();

        $material = $this->materialRepository->create($input);

        return $this->sendResponse($material->toArray(), 'Material saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/materials/{id}",
     *      summary="Display the specified material",
     *      tags={"material"},
     *      description="Get material",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material",
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
     *                  ref="#/definitions/material"
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
        /** @var material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material not found');
        }

        return $this->sendResponse($material->toArray(), 'Material retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatematerialAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/materials/{id}",
     *      summary="Update the specified material in storage",
     *      tags={"material"},
     *      description="Update material",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="material that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/material")
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
     *                  ref="#/definitions/material"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatematerialAPIRequest $request)
    {
        $input = $request->all();

        /** @var material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material not found');
        }

        $material = $this->materialRepository->update($input, $id);

        return $this->sendResponse($material->toArray(), 'material updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/materials/{id}",
     *      summary="Remove the specified material from storage",
     *      tags={"material"},
     *      description="Delete material",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material",
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
        /** @var material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material not found');
        }

        $material->delete();

        return $this->sendSuccess('Material deleted successfully');
    }
}
