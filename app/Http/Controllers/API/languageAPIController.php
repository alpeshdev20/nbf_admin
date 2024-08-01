<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatelanguageAPIRequest;
use App\Http\Requests\API\UpdatelanguageAPIRequest;
use App\Models\language;
use App\Repositories\languageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class languageController
 * @package App\Http\Controllers\API
 */

class languageAPIController extends AppBaseController
{
    /** @var  languageRepository */
    private $languageRepository;

    public function __construct(languageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/languages",
     *      summary="Get a listing of the languages.",
     *      tags={"language"},
     *      description="Get all languages",
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
     *                  @SWG\Items(ref="#/definitions/language")
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
        $languages = $this->languageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($languages->toArray(), 'Languages retrieved successfully');
    }

    /**
     * @param CreatelanguageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/languages",
     *      summary="Store a newly created language in storage",
     *      tags={"language"},
     *      description="Store language",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="language that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/language")
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
     *                  ref="#/definitions/language"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatelanguageAPIRequest $request)
    {
        $input = $request->all();

        $language = $this->languageRepository->create($input);

        return $this->sendResponse($language->toArray(), 'Language saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/languages/{id}",
     *      summary="Display the specified language",
     *      tags={"language"},
     *      description="Get language",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of language",
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
     *                  ref="#/definitions/language"
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
        /** @var language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        return $this->sendResponse($language->toArray(), 'Language retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatelanguageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/languages/{id}",
     *      summary="Update the specified language in storage",
     *      tags={"language"},
     *      description="Update language",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of language",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="language that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/language")
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
     *                  ref="#/definitions/language"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatelanguageAPIRequest $request)
    {
        $input = $request->all();

        /** @var language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        $language = $this->languageRepository->update($input, $id);

        return $this->sendResponse($language->toArray(), 'language updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/languages/{id}",
     *      summary="Remove the specified language from storage",
     *      tags={"language"},
     *      description="Delete language",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of language",
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
        /** @var language $language */
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            return $this->sendError('Language not found');
        }

        $language->delete();

        return $this->sendSuccess('Language deleted successfully');
    }
}
