<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatevideoAPIRequest;
use App\Http\Requests\API\UpdatevideoAPIRequest;
use App\Models\video;
use App\Repositories\videoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class videoController
 * @package App\Http\Controllers\API
 */

class videoAPIController extends AppBaseController
{
    /** @var  videoRepository */
    private $videoRepository;

    public function __construct(videoRepository $videoRepo)
    {
        $this->videoRepository = $videoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/videos",
     *      summary="Get a listing of the videos.",
     *      tags={"video"},
     *      description="Get all videos",
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
     *                  @SWG\Items(ref="#/definitions/video")
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
        $videos = $this->videoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($videos->toArray(), 'Videos retrieved successfully');
    }

    /**
     * @param CreatevideoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/videos",
     *      summary="Store a newly created video in storage",
     *      tags={"video"},
     *      description="Store video",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="video that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/video")
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
     *                  ref="#/definitions/video"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatevideoAPIRequest $request)
    {
        $input = $request->all();

        $video = $this->videoRepository->create($input);

        return $this->sendResponse($video->toArray(), 'Video saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/videos/{id}",
     *      summary="Display the specified video",
     *      tags={"video"},
     *      description="Get video",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of video",
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
     *                  ref="#/definitions/video"
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
        /** @var video $video */
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        return $this->sendResponse($video->toArray(), 'Video retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatevideoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/videos/{id}",
     *      summary="Update the specified video in storage",
     *      tags={"video"},
     *      description="Update video",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of video",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="video that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/video")
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
     *                  ref="#/definitions/video"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatevideoAPIRequest $request)
    {
        $input = $request->all();

        /** @var video $video */
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        $video = $this->videoRepository->update($input, $id);

        return $this->sendResponse($video->toArray(), 'video updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/videos/{id}",
     *      summary="Remove the specified video from storage",
     *      tags={"video"},
     *      description="Delete video",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of video",
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
        /** @var video $video */
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            return $this->sendError('Video not found');
        }

        $video->delete();

        return $this->sendSuccess('Video deleted successfully');
    }
}
