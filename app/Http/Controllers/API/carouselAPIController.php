<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecarouselAPIRequest;
use App\Http\Requests\API\UpdatecarouselAPIRequest;
use App\Models\carousel;
use App\Repositories\carouselRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class carouselController
 * @package App\Http\Controllers\API
 */

class carouselAPIController extends AppBaseController
{
    /** @var  carouselRepository */
    private $carouselRepository;

    public function __construct(carouselRepository $carouselRepo)
    {
        $this->carouselRepository = $carouselRepo;
    }

    /**
     * Display a listing of the carousel.
     * GET|HEAD /carousels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $carousels = $this->carouselRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($carousels->toArray(), 'Carousels retrieved successfully');
    }

    /**
     * Store a newly created carousel in storage.
     * POST /carousels
     *
     * @param CreatecarouselAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecarouselAPIRequest $request)
    {
        $input = $request->all();

        
        $file = $request->file('banner_image');
        $fileName= $file->getClientOriginalName();
      
        $fileName=str_replace(" ","_",$fileName);
       // return $fileName;
        $file->move(public_path('uploads/file'),$fileName);
        $input['banner_image']=$fileName;

        $carousel = $this->carouselRepository->create($input);

        return $this->sendResponse($carousel->toArray(), 'Carousel saved successfully');
    }

    /**
     * Display the specified carousel.
     * GET|HEAD /carousels/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var carousel $carousel */
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            return $this->sendError('Carousel not found');
        }

        return $this->sendResponse($carousel->toArray(), 'Carousel retrieved successfully');
    }

    /**
     * Update the specified carousel in storage.
     * PUT/PATCH /carousels/{id}
     *
     * @param int $id
     * @param UpdatecarouselAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecarouselAPIRequest $request)
    {
        $input = $request->all();

        /** @var carousel $carousel */
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            return $this->sendError('Carousel not found');
        }

        $carousel = $this->carouselRepository->update($input, $id);

        return $this->sendResponse($carousel->toArray(), 'carousel updated successfully');
    }

    /**
     * Remove the specified carousel from storage.
     * DELETE /carousels/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var carousel $carousel */
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            return $this->sendError('Carousel not found');
        }

        $carousel->delete();

        return $this->sendSuccess('Carousel deleted successfully');
    }
}
