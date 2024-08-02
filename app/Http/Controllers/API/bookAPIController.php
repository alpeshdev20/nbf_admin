<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebookAPIRequest;
use App\Http\Requests\API\UpdatebookAPIRequest;
use App\Models\book;
use App\Repositories\bookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class bookController
 * @package App\Http\Controllers\API
 */

class bookAPIController extends AppBaseController
{
    /** @var  bookRepository */
    private $bookRepository;

    public function __construct(bookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/books",
     *      summary="Get a listing of the books.",
     *      tags={"book"},
     *      description="Get all books",
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
     *                  @SWG\Items(ref="#/definitions/book")
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
        $books = $this->bookRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($books->toArray(), 'Books retrieved successfully');
    }

    /**
     * @param CreatebookAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/books",
     *      summary="Store a newly created book in storage",
     *      tags={"book"},
     *      description="Store book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="book that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/book")
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
     *                  ref="#/definitions/book"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatebookAPIRequest $request)
    {
        $input = $request->all();

        $book = $this->bookRepository->create($input);

        return $this->sendResponse($book->toArray(), 'Book saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/books/{id}",
     *      summary="Display the specified book",
     *      tags={"book"},
     *      description="Get book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book",
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
     *                  ref="#/definitions/book"
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
        /** @var book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        return $this->sendResponse($book->toArray(), 'Book retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatebookAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/books/{id}",
     *      summary="Update the specified book in storage",
     *      tags={"book"},
     *      description="Update book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="book that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/book")
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
     *                  ref="#/definitions/book"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatebookAPIRequest $request)
    {
        $input = $request->all();

        /** @var book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        $book = $this->bookRepository->update($input, $id);

        return $this->sendResponse($book->toArray(), 'book updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/books/{id}",
     *      summary="Remove the specified book from storage",
     *      tags={"book"},
     *      description="Delete book",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book",
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
        /** @var book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            return $this->sendError('Book not found');
        }

        $book->delete();

        return $this->sendSuccess('Book deleted successfully');
    }
}
