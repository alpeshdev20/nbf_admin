<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createaudio_bookAPIRequest;
use App\Http\Requests\API\Updateaudio_bookAPIRequest;
use App\Models\audio_book;
use App\Repositories\audio_bookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class audio_bookController
 * @package App\Http\Controllers\API
 */

class audio_bookAPIController extends AppBaseController
{
    /** @var  audio_bookRepository */
    private $audioBookRepository;

    public function __construct(audio_bookRepository $audioBookRepo)
    {
        $this->audioBookRepository = $audioBookRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/audioBooks",
     *      summary="Get a listing of the audio_books.",
     *      tags={"audio_book"},
     *      description="Get all audio_books",
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
     *                  @SWG\Items(ref="#/definitions/audio_book")
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
        $audioBooks = $this->audioBookRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($audioBooks->toArray(), 'Audio Books retrieved successfully');
    }

    /**
     * @param Createaudio_bookAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/audioBooks",
     *      summary="Store a newly created audio_book in storage",
     *      tags={"audio_book"},
     *      description="Store audio_book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="audio_book that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/audio_book")
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
     *                  ref="#/definitions/audio_book"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createaudio_bookAPIRequest $request)
    {
        $input = $request->all();

        $audioBook = $this->audioBookRepository->create($input);

        return $this->sendResponse($audioBook->toArray(), 'Audio Book saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/audioBooks/{id}",
     *      summary="Display the specified audio_book",
     *      tags={"audio_book"},
     *      description="Get audio_book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio_book",
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
     *                  ref="#/definitions/audio_book"
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
        /** @var audio_book $audioBook */
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            return $this->sendError('Audio Book not found');
        }

        return $this->sendResponse($audioBook->toArray(), 'Audio Book retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updateaudio_bookAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/audioBooks/{id}",
     *      summary="Update the specified audio_book in storage",
     *      tags={"audio_book"},
     *      description="Update audio_book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio_book",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="audio_book that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/audio_book")
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
     *                  ref="#/definitions/audio_book"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updateaudio_bookAPIRequest $request)
    {
        $input = $request->all();

        /** @var audio_book $audioBook */
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            return $this->sendError('Audio Book not found');
        }

        $audioBook = $this->audioBookRepository->update($input, $id);

        return $this->sendResponse($audioBook->toArray(), 'audio_book updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/audioBooks/{id}",
     *      summary="Remove the specified audio_book from storage",
     *      tags={"audio_book"},
     *      description="Delete audio_book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of audio_book",
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
        /** @var audio_book $audioBook */
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            return $this->sendError('Audio Book not found');
        }

        $audioBook->delete();

        return $this->sendSuccess('Audio Book deleted successfully');
    }
}
