<?php

namespace App\Http\Controllers;

use App\DataTables\app_publisherDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_publisherRequest;
use App\Http\Requests\Updateapp_publisherRequest;
use App\Repositories\app_publisherRepository;
use Flash;
use App\Models\app_material;
use App\Http\Controllers\AppBaseController;
use Response;

class app_publisherController extends AppBaseController
{
    /** @var  app_publisherRepository */
    private $appPublisherRepository;

    public function __construct(app_publisherRepository $appPublisherRepo)
    {
        $this->appPublisherRepository = $appPublisherRepo;
    }

    /**
     * Display a listing of the app_publisher.
     *
     * @param app_publisherDataTable $appPublisherDataTable
     * @return Response
     */
    public function index(app_publisherDataTable $appPublisherDataTable)
    {
        return $appPublisherDataTable->render('app_publishers.index');
    }

    /**
     * Show the form for creating a new app_publisher.
     *
     * @return Response
     */
    public function create()
    {
        return view('app_publishers.create');
    }

    /**
     * Store a newly created app_publisher in storage.
     *
     * @param Createapp_publisherRequest $request
     *
     * @return Response
     */
    public function store(Createapp_publisherRequest $request)
    {
        $input = $request->all();

        $appPublisher = $this->appPublisherRepository->create($input);

        Flash::success('App Publisher saved successfully.');

        return redirect(route('appPublishers.index'));
    }

    /**
     * Display the specified app_publisher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            Flash::error('App Publisher not found');

            return redirect(route('appPublishers.index'));
        }

        return view('app_publishers.show')->with('appPublisher', $appPublisher);
    }

    /**
     * Show the form for editing the specified app_publisher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            Flash::error('App Publisher not found');

            return redirect(route('appPublishers.index'));
        }

        return view('app_publishers.edit')->with('appPublisher', $appPublisher);
    }

    /**
     * Update the specified app_publisher in storage.
     *
     * @param  int              $id
     * @param Updateapp_publisherRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_publisherRequest $request)
    {
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            Flash::error('App Publisher not found');

            return redirect(route('appPublishers.index'));
        }

        $appPublisher = $this->appPublisherRepository->update($request->all(), $id);

        Flash::success('App Publisher updated successfully.');

        return redirect(route('appPublishers.index'));
    }

    /**
     * Remove the specified app_publisher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appPublisher = $this->appPublisherRepository->find($id);

        if (empty($appPublisher)) {
            Flash::error('App Publisher not found');

            return redirect(route('appPublishers.index'));
        }

        $data = app_material::where('publisher', $id)->get();

        if(count($data) > 0) {
            Flash::error('Material related to this publisher Exists, please delete them first.');

            return redirect(route('appPublishers.index'));            
        }

        $this->appPublisherRepository->delete($id);

        Flash::success('App Publisher deleted successfully.');

        return redirect(route('appPublishers.index'));
    }
}
