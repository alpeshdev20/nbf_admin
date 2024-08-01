<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcms_pageAPIRequest;
use App\Http\Requests\API\Updatecms_pageAPIRequest;
use App\Models\cms_page;
use App\Repositories\cms_pageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cms_pageController
 * @package App\Http\Controllers\API
 */

class cms_pageAPIController extends AppBaseController
{
    /** @var  cms_pageRepository */
    private $cmsPageRepository;

    public function __construct(cms_pageRepository $cmsPageRepo)
    {
        $this->cmsPageRepository = $cmsPageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cmsPages",
     *      summary="Get a listing of the cms_pages.",
     *      tags={"cms_page"},
     *      description="Get all cms_pages",
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
     *                  @SWG\Items(ref="#/definitions/cms_page")
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
        $cmsPages = $this->cmsPageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cmsPages->toArray(), 'Cms Pages retrieved successfully');
    }

    /**
     * @param Createcms_pageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cmsPages",
     *      summary="Store a newly created cms_page in storage",
     *      tags={"cms_page"},
     *      description="Store cms_page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="cms_page that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/cms_page")
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
     *                  ref="#/definitions/cms_page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createcms_pageAPIRequest $request)
    {
        $input = $request->all();

        $cmsPage = $this->cmsPageRepository->create($input);

        return $this->sendResponse($cmsPage->toArray(), 'Cms Page saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cmsPages/{id}",
     *      summary="Display the specified cms_page",
     *      tags={"cms_page"},
     *      description="Get cms_page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cms_page",
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
     *                  ref="#/definitions/cms_page"
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
        /** @var cms_page $cmsPage */
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            return $this->sendError('Cms Page not found');
        }

        return $this->sendResponse($cmsPage->toArray(), 'Cms Page retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatecms_pageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cmsPages/{id}",
     *      summary="Update the specified cms_page in storage",
     *      tags={"cms_page"},
     *      description="Update cms_page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cms_page",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="cms_page that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/cms_page")
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
     *                  ref="#/definitions/cms_page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatecms_pageAPIRequest $request)
    {
        $input = $request->all();

        /** @var cms_page $cmsPage */
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            return $this->sendError('Cms Page not found');
        }

        $cmsPage = $this->cmsPageRepository->update($input, $id);

        return $this->sendResponse($cmsPage->toArray(), 'cms_page updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cmsPages/{id}",
     *      summary="Remove the specified cms_page from storage",
     *      tags={"cms_page"},
     *      description="Delete cms_page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of cms_page",
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
        /** @var cms_page $cmsPage */
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            return $this->sendError('Cms Page not found');
        }

        $cmsPage->delete();

        return $this->sendSuccess('Cms Page deleted successfully');
    }
}
