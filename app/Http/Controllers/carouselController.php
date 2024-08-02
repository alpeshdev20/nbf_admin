<?php

namespace App\Http\Controllers;

use App\DataTables\carouselDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecarouselRequest;
use App\Http\Requests\UpdatecarouselRequest;
use App\Repositories\carouselRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class carouselController extends AppBaseController
{
    /** @var  carouselRepository */
    private $carouselRepository;

    public function __construct(carouselRepository $carouselRepo)
    {
        $this->carouselRepository = $carouselRepo;
    }

    /**
     * Display a listing of the carousel.
     *
     * @param carouselDataTable $carouselDataTable
     * @return Response
     */
    public function index(carouselDataTable $carouselDataTable)
    {
        return $carouselDataTable->render('carousels.index');
    }

    /**
     * Show the form for creating a new carousel.
     *
     * @return Response
     */
    public function create()
    {
        return view('carousels.create');
    }

    /**
     * Store a newly created carousel in storage.
     *
     * @param CreatecarouselRequest $request
     *
     * @return Response
     */
    public function store(CreatecarouselRequest $request)
    {
        $input = $request->all();


        $file = $request->file('banner_image');
        $fileName= $file->getClientOriginalName();
        $fileName=str_replace(" ","_",$fileName);
        $file->move(public_path('uploads/file'),$fileName);
        $input['banner_image']=$fileName;

        $carousel = $this->carouselRepository->create($input);

        Flash::success('Carousel saved successfully.');

        return redirect(route('carousels.index'));
    }

    /**
     * Display the specified carousel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            Flash::error('Carousel not found');

            return redirect(route('carousels.index'));
        }

        return view('carousels.show')->with('carousel', $carousel);
    }

    /**
     * Show the form for editing the specified carousel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            Flash::error('Carousel not found');

            return redirect(route('carousels.index'));
        }

        return view('carousels.edit')->with('carousel', $carousel);
    }

    /**
     * Update the specified carousel in storage.
     *
     * @param  int              $id
     * @param UpdatecarouselRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecarouselRequest $request)
    {
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            Flash::error('Carousel not found');

            return redirect(route('carousels.index'));
        }

        $input = $request->all();

        $file=$request->file('banner_image');
        if($file) {
            $filename= $file->getClientOriginalName();
            $filename = str_replace(" ","_", $filename);
            $file->move(public_path('uploads/file'), $filename);
            $input['banner_image'] = $filename;    
        }


        $carousel = $this->carouselRepository->update($input, $id);

        Flash::success('Carousel updated successfully.');

        return redirect(route('carousels.index'));
    }

    /**
     * Remove the specified carousel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $carousel = $this->carouselRepository->find($id);

        if (empty($carousel)) {
            Flash::error('Carousel not found');

            return redirect(route('carousels.index'));
        }

        $this->carouselRepository->delete($id);

        Flash::success('Carousel deleted successfully.');

        return redirect(route('carousels.index'));
    }
}
