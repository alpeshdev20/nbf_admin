<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Creategenre_highlightAPIRequest;
use App\Http\Requests\API\Updategenre_highlightAPIRequest;
use App\Models\genre_highlight;
use App\Repositories\genre_highlightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class genre_highlightController
 * @package App\Http\Controllers\API
 */

class genre_highlightAPIController extends AppBaseController
{
    /** @var  genre_highlightRepository */
    private $genreHighlightRepository;

    public function __construct(genre_highlightRepository $genreHighlightRepo)
    {
        $this->genreHighlightRepository = $genreHighlightRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/genreHighlights",
     *      summary="Get a listing of the genre_highlights.",
     *      tags={"genre_highlight"},
     *      description="Get all genre_highlights",
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
     *                  @SWG\Items(ref="#/definitions/genre_highlight")
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
        $genreHighlights = $this->genreHighlightRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($genreHighlights->toArray(), 'Genre Highlights retrieved successfully');
    }

    /**
     * @param Creategenre_highlightAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/genreHighlights",
     *      summary="Store a newly created genre_highlight in storage",
     *      tags={"genre_highlight"},
     *      description="Store genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="genre_highlight that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/genre_highlight")
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
     *                  ref="#/definitions/genre_highlight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Creategenre_highlightAPIRequest $request)
    {
        $input = $request->all();

        $genreHighlight = $this->genreHighlightRepository->create($input);

        return $this->sendResponse($genreHighlight->toArray(), 'Genre Highlight saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/genreHighlights/{id}",
     *      summary="Display the specified genre_highlight",
     *      tags={"genre_highlight"},
     *      description="Get genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of genre_highlight",
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
     *                  ref="#/definitions/genre_highlight"
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
        /** @var genre_highlight $genreHighlight */
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            return $this->sendError('Genre Highlight not found');
        }

        return $this->sendResponse($genreHighlight->toArray(), 'Genre Highlight retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updategenre_highlightAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/genreHighlights/{id}",
     *      summary="Update the specified genre_highlight in storage",
     *      tags={"genre_highlight"},
     *      description="Update genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of genre_highlight",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="genre_highlight that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/genre_highlight")
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
     *                  ref="#/definitions/genre_highlight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updategenre_highlightAPIRequest $request)
    {
        $input = $request->all();

        /** @var genre_highlight $genreHighlight */
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            return $this->sendError('Genre Highlight not found');
        }

        $genreHighlight = $this->genreHighlightRepository->update($input, $id);

        return $this->sendResponse($genreHighlight->toArray(), 'genre_highlight updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/genreHighlights/{id}",
     *      summary="Remove the specified genre_highlight from storage",
     *      tags={"genre_highlight"},
     *      description="Delete genre_highlight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of genre_highlight",
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
        /** @var genre_highlight $genreHighlight */
        $genreHighlight = $this->genreHighlightRepository->find($id);

        if (empty($genreHighlight)) {
            return $this->sendError('Genre Highlight not found');
        }

        $genreHighlight->delete();

        return $this->sendSuccess('Genre Highlight deleted successfully');
    }
}
