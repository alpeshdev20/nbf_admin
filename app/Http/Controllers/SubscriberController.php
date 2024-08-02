<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriberDataTable;
use App\Http\Requests\CreateSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Repositories\SubscriberRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use DB;

class SubscriberController extends AppBaseController
{
    /** @var  SubscriberRepository */
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepo)
    {
        $this->subscriberRepository = $subscriberRepo;
    }

    /**
     * Display a listing of the Subscriber.
     *
     * @param SubscriberDataTable $subscriberDataTable
     * @return Response
     */
    public function index(SubscriberDataTable $subscriberDataTable)
    {
        return $subscriberDataTable->render('subscribers.index');
    }

    /**
     * Show the form for creating a new Subscriber.
     *
     * @return Response
     */
    public function create()
    {

        return redirect(route('subscribers.index'));
    }

    /**
     * Store a newly created Subscriber in storage.
     *
     * @param CreateSubscriberRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriberRequest $request)
    {
        $input = $request->all();

        $subscriber = $this->subscriberRepository->create($input);

        Flash::success('Subscriber saved successfully.');

        return redirect(route('subscribers.index'));
    }

    /**
     * Display the specified Subscriber.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        $allowedMaterial = $allowedPublisher = $allowedGeners = $allowedDepartment =  $allowedSubjects = [];

        if ($subscriber->configuration_type == '0') {
            if(!empty($subscriber->allowed_material)) {
                $allowedMaterial = DB::table('material')->whereIn('id', explode(',', $subscriber->allowed_material))->get();
            }
        } else {
            if(!empty($subscriber->allowed_publisher)) {
                $allowedPublisher = DB::table('app_publishers')->whereIn('id', explode(',', $subscriber->allowed_publisher))->get();
            }
            if(!empty($subscriber->allowed_genres)) {
                $allowedGeners = DB::table('genres')->whereIn('id', explode(',', $subscriber->allowed_genres))->get();
            }
            if(!empty($subscriber->allowed_department)) {
                $allowedDepartment = DB::table('app_department')->whereIn('id', explode(',', $subscriber->allowed_department))->get();
            }
            if(!empty($subscriber->allowed_subject)) {
                $allowedSubjects = DB::table('app_subject')->whereIn('id', explode(',', $subscriber->allowed_subject))->get();
            }
        }


        return view('subscribers.show')->with([
            'subscriber' => $subscriber,
            'allowedMaterial' => $allowedMaterial,
            'allowedPublisher' => $allowedPublisher,
            'allowedGeners' => $allowedGeners,
            'allowedDepartment' => $allowedDepartment,
            'allowedSubjects' => $allowedSubjects
        ]);
    }

    /**
     * Show the form for editing the specified Subscriber.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        return view('subscribers.edit')->with('subscriber', $subscriber);
    }

    /**
     * Update the specified Subscriber in storage.
     *
     * @param  int              $id
     * @param UpdateSubscriberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriberRequest $request)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        $subscriber = $this->subscriberRepository->update($request->all(), $id);

        Flash::success('Subscriber updated successfully.');

        return redirect(route('subscribers.index'));
    }

    /**
     * Remove the specified Subscriber from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscriber = $this->subscriberRepository->find($id);

        if (empty($subscriber)) {
            Flash::error('Subscriber not found');

            return redirect(route('subscribers.index'));
        }

        $this->subscriberRepository->delete($id);

        Flash::success('Subscriber deleted successfully.');

        return redirect(route('subscribers.index'));
    }
}
