<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createapp_genre_highlightAPIRequest;
use App\Http\Requests\API\Updateapp_genre_highlightAPIRequest;
use App\Models\app_genre_highlight;
use App\Repositories\app_genre_highlightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class app_genre_highlightController
 * @package App\Http\Controllers\API
 */

class app_genre_highlightAPIController extends AppBaseController
{
    /** @var  app_genre_highlightRepository */
    private $appGenreHighlightRepository;

    public function __construct(app_genre_highlightRepository $appGenreHighlightRepo)
    {
        $this->appGenreHighlightRepository = $appGenreHighlightRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/appGenreHighlights",
     *      summary="Get a listing of the app_genre_highlights.",
     *      tags={"app_genre_highlight"},
     *      description="Get all app_genre_highlights",
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
     *                  @SWG\Items(ref="#/definitions/app_genre_highlight")
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
        $appGenreHighlights = $this->appGenreHighlightRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($appGenreHighlights->toArray(), 'App Genre Highlights retrieved successfully');
    }

    /**
     * @param Createapp_genre_highlightAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/appGenreHighlights",
     *      summary="Store a newly created app_genre_highlight in storage",
     *      tags={"app_genre_highlight"},
     *      description="Store app_genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_genre_highlight that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_genre_highlight")
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
     *                  ref="#/definitions/app_genre_highlight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createapp_genre_highlightAPIRequest $request)
    {
        $input = $request->all();

        $appGenreHighlight = $this->appGenreHighlightRepository->create($input);

        return $this->sendResponse($appGenreHighlight->toArray(), 'App Genre Highlight saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/appGenreHighlights/{id}",
     *      summary="Display the specified app_genre_highlight",
     *      tags={"app_genre_highlight"},
     *      description="Get app_genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_genre_highlight",
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
     *                  ref="#/definitions/app_genre_highlight"
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
        /** @var app_genre_highlight $appGenreHighlight */
        $appGenreHighlight = $this->appGenreHighlightRepository->find($id);

        if (empty($appGenreHighlight)) {
            return $this->sendError('App Genre Highlight not found');
        }

        return $this->sendResponse($appGenreHighlight->toArray(), 'App Genre Highlight retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updateapp_genre_highlightAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/appGenreHighlights/{id}",
     *      summary="Update the specified app_genre_highlight in storage",
     *      tags={"app_genre_highlight"},
     *      description="Update app_genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_genre_highlight",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="app_genre_highlight that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/app_genre_highlight")
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
     *                  ref="#/definitions/app_genre_highlight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updateapp_genre_highlightAPIRequest $request)
    {
        $input = $request->all();

        /** @var app_genre_highlight $appGenreHighlight */
        $appGenreHighlight = $this->appGenreHighlightRepository->find($id);

        if (empty($appGenreHighlight)) {
            return $this->sendError('App Genre Highlight not found');
        }

        $appGenreHighlight = $this->appGenreHighlightRepository->update($input, $id);

        return $this->sendResponse($appGenreHighlight->toArray(), 'app_genre_highlight updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/appGenreHighlights/{id}",
     *      summary="Remove the specified app_genre_highlight from storage",
     *      tags={"app_genre_highlight"},
     *      description="Delete app_genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of app_genre_highlight",
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
        /** @var app_genre_highlight $appGenreHighlight */
        $appGenreHighlight = $this->appGenreHighlightRepository->find($id);

        if (empty($appGenreHighlight)) {
            return $this->sendError('App Genre Highlight not found');
        }

        $appGenreHighlight->delete();

        return $this->sendSuccess('App Genre Highlight deleted successfully');
    }
}
