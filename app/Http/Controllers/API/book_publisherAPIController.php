<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createbook_publisherAPIRequest;
use App\Http\Requests\API\Updatebook_publisherAPIRequest;
use App\Models\book_publisher;
use App\Repositories\book_publisherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class book_publisherController
 * @package App\Http\Controllers\API
 */

class book_publisherAPIController extends AppBaseController
{
    /** @var  book_publisherRepository */
    private $bookPublisherRepository;

    public function __construct(book_publisherRepository $bookPublisherRepo)
    {
        $this->bookPublisherRepository = $bookPublisherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookPublishers",
     *      summary="Get a listing of the book_publishers.",
     *      tags={"book_publisher"},
     *      description="Get all book_publishers",
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
     *                  @SWG\Items(ref="#/definitions/book_publisher")
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
        $bookPublishers = $this->bookPublisherRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bookPublishers->toArray(), 'Book Publishers retrieved successfully');
    }

    /**
     * @param Createbook_publisherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bookPublishers",
     *      summary="Store a newly created book_publisher in storage",
     *      tags={"book_publisher"},
     *      description="Store book_publisher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="book_publisher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/book_publisher")
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
     *                  ref="#/definitions/book_publisher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createbook_publisherAPIRequest $request)
    {
        $input = $request->all();

        $bookPublisher = $this->bookPublisherRepository->create($input);

        return $this->sendResponse($bookPublisher->toArray(), 'Book Publisher saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bookPublishers/{id}",
     *      summary="Display the specified book_publisher",
     *      tags={"book_publisher"},
     *      description="Get book_publisher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book_publisher",
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
     *                  ref="#/definitions/book_publisher"
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
        /** @var book_publisher $bookPublisher */
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            return $this->sendError('Book Publisher not found');
        }

        return $this->sendResponse($bookPublisher->toArray(), 'Book Publisher retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatebook_publisherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bookPublishers/{id}",
     *      summary="Update the specified book_publisher in storage",
     *      tags={"book_publisher"},
     *      description="Update book_publisher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book_publisher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="book_publisher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/book_publisher")
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
     *                  ref="#/definitions/book_publisher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatebook_publisherAPIRequest $request)
    {
        $input = $request->all();

        /** @var book_publisher $bookPublisher */
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            return $this->sendError('Book Publisher not found');
        }

        $bookPublisher = $this->bookPublisherRepository->update($input, $id);

        return $this->sendResponse($bookPublisher->toArray(), 'book_publisher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/bookPublishers/{id}",
     *      summary="Remove the specified book_publisher from storage",
     *      tags={"book_publisher"},
     *      description="Delete book_publisher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of book_publisher",
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
        /** @var book_publisher $bookPublisher */
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            return $this->sendError('Book Publisher not found');
        }

        $bookPublisher->delete();

        return $this->sendSuccess('Book Publisher deleted successfully');
    }
}
