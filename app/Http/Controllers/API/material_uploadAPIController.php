<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Creatematerial_uploadAPIRequest;
use App\Http\Requests\API\Updatematerial_uploadAPIRequest;
use App\Models\material_upload;
use App\Repositories\material_uploadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use DB;

/**
 * Class material_uploadController
 * @package App\Http\Controllers\API
 */

class material_uploadAPIController extends AppBaseController
{
    /** @var  material_uploadRepository */
    private $materialUploadRepository;

    public function __construct(material_uploadRepository $materialUploadRepo)
    {
        $this->materialUploadRepository = $materialUploadRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/materialUploads",
     *      summary="Get a listing of the material_uploads.",
     *      tags={"material_upload"},
     *      description="Get all material_uploads",
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
     *                  @SWG\Items(ref="#/definitions/material_upload")
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
        $materialUploads = $this->materialUploadRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($materialUploads->toArray(), 'Material Uploads retrieved successfully');
    }

    /**
     * @param Creatematerial_uploadAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/materialUploads",
     *      summary="Store a newly created material_upload in storage",
     *      tags={"material_upload"},
     *      description="Store material_upload",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="material_upload that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/material_upload")
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
     *                  ref="#/definitions/material_upload"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Creatematerial_uploadAPIRequest $request)
    {
        $input = $request->all();

        // $users = DB::table('material_upload')
        // ->join('book', 'material_upload.id', '=', 'book.materialupload_id')
        // ->select('material_upload.*')
        // ->where(['materialupload_id' => 1])
        // ->get();

        $materialUpload = $this->materialUploadRepository->create($input);

        return $this->sendResponse($materialUpload->toArray(), 'Material Upload saved successfully');
    }

    public function getSubgenreList(Request $request)
        {
            $states = DB::table("sgenre")
            ->where("genre",$request->genre)
            ->pluck("subgenre","subgenre");
            return response()->json($states);
        }

    

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/materialUploads/{id}",
     *      summary="Display the specified material_upload",
     *      tags={"material_upload"},
     *      description="Get material_upload",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material_upload",
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
     *                  ref="#/definitions/material_upload"
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
        /** @var material_upload $materialUpload */
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            return $this->sendError('Material Upload not found');
        }

        return $this->sendResponse($materialUpload->toArray(), 'Material Upload retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatematerial_uploadAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/materialUploads/{id}",
     *      summary="Update the specified material_upload in storage",
     *      tags={"material_upload"},
     *      description="Update material_upload",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material_upload",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="material_upload that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/material_upload")
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
     *                  ref="#/definitions/material_upload"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatematerial_uploadAPIRequest $request)
    {
        $input = $request->all();

        /** @var material_upload $materialUpload */
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            return $this->sendError('Material Upload not found');
        }

        $materialUpload = $this->materialUploadRepository->update($input, $id);

        return $this->sendResponse($materialUpload->toArray(), 'material_upload updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/materialUploads/{id}",
     *      summary="Remove the specified material_upload from storage",
     *      tags={"material_upload"},
     *      description="Delete material_upload",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of material_upload",
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
        /** @var material_upload $materialUpload */
        $materialUpload = $this->materialUploadRepository->find($id);

        if (empty($materialUpload)) {
            return $this->sendError('Material Upload not found');
        }

        $materialUpload->delete();

        return $this->sendSuccess('Material Upload deleted successfully');
    }
}
