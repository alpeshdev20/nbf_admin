<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createclass_noteAPIRequest;
use App\Http\Requests\API\Updateclass_noteAPIRequest;
use App\Models\class_note;
use App\Repositories\class_noteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class class_noteController
 * @package App\Http\Controllers\API
 */

class class_noteAPIController extends AppBaseController
{
    /** @var  class_noteRepository */
    private $classNoteRepository;

    public function __construct(class_noteRepository $classNoteRepo)
    {
        $this->classNoteRepository = $classNoteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classNotes",
     *      summary="Get a listing of the class_notes.",
     *      tags={"class_note"},
     *      description="Get all class_notes",
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
     *                  @SWG\Items(ref="#/definitions/class_note")
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
        $classNotes = $this->classNoteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classNotes->toArray(), 'Class Notes retrieved successfully');
    }

    /**
     * @param Createclass_noteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classNotes",
     *      summary="Store a newly created class_note in storage",
     *      tags={"class_note"},
     *      description="Store class_note",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="class_note that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/class_note")
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
     *                  ref="#/definitions/class_note"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createclass_noteAPIRequest $request)
    {
        $input = $request->all();

        $classNote = $this->classNoteRepository->create($input);

        return $this->sendResponse($classNote->toArray(), 'Class Note saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classNotes/{id}",
     *      summary="Display the specified class_note",
     *      tags={"class_note"},
     *      description="Get class_note",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of class_note",
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
     *                  ref="#/definitions/class_note"
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
        /** @var class_note $classNote */
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            return $this->sendError('Class Note not found');
        }

        return $this->sendResponse($classNote->toArray(), 'Class Note retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updateclass_noteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classNotes/{id}",
     *      summary="Update the specified class_note in storage",
     *      tags={"class_note"},
     *      description="Update class_note",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of class_note",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="class_note that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/class_note")
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
     *                  ref="#/definitions/class_note"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updateclass_noteAPIRequest $request)
    {
        $input = $request->all();

        /** @var class_note $classNote */
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            return $this->sendError('Class Note not found');
        }

        $classNote = $this->classNoteRepository->update($input, $id);

        return $this->sendResponse($classNote->toArray(), 'class_note updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classNotes/{id}",
     *      summary="Remove the specified class_note from storage",
     *      tags={"class_note"},
     *      description="Delete class_note",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of class_note",
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
        /** @var class_note $classNote */
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            return $this->sendError('Class Note not found');
        }

        $classNote->delete();

        return $this->sendSuccess('Class Note deleted successfully');
    }
}
