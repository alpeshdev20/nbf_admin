<?php

namespace App\Http\Controllers;

use App\DataTables\book_publisherDataTable;
use App\Http\Requests;
use App\Http\Requests\Createbook_publisherRequest;
use App\Http\Requests\Updatebook_publisherRequest;
use App\Repositories\book_publisherRepository;
use Illuminate\Http\Request;
use App\Models\admlogin;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class book_publisherController extends AppBaseController
{
    /** @var  book_publisherRepository */
    private $bookPublisherRepository;

    public function __construct(book_publisherRepository $bookPublisherRepo)
    {
        $this->bookPublisherRepository = $bookPublisherRepo;
    }

    /**
     * Display a listing of the book_publisher.
     *
     * @param book_publisherDataTable $bookPublisherDataTable
     * @return Response
     */
    public function index(book_publisherDataTable $bookPublisherDataTable)
    {
        return $bookPublisherDataTable->render('book_publishers.index');
    }

    /**
     * Show the form for creating a new book_publisher.
     *
     * @return Response
     */
    public function create()
    {
        $admins = admlogin::orderBy('id')->pluck('name', 'id');
        $gdata = $admins->toArray();
        return view('book_publishers.create')->with(array('admins' => $gdata));
    }

    /**
     * Store a newly created book_publisher in storage.
     *
     * @param Createbook_publisherRequest $request
     *
     * @return Response
     */
    public function store(Createbook_publisherRequest $request)
    {
        $input = $request->all();

        $bookPublisher = $this->bookPublisherRepository->create($input);

        Flash::success('Book Publisher saved successfully.');

        return redirect(route('bookPublishers.index'));
    }

    /**
     * Display the specified book_publisher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $input = $request->all();
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            Flash::error('Book Publisher not found');
            return redirect(route('bookPublishers.index'));
        }

        $publisher = \App\Models\book_publisher::where('user_id', $bookPublisher->user_id)->first();

        if (!$publisher) {
            Flash::error('Publisher not found');
            return redirect(route('bookPublishers.index'));
        }

        $Publisherbooks = \App\Models\app_material::where('publisher_id', $publisher->id)->get();
        $Publisherbookscount = $Publisherbooks->count();

        $user_statistic_det = [];
        $data_count = 0; // 164 books count

        if ($Publisherbookscount > 0) {
            foreach ($Publisherbooks as $book) {
                if ($request->has('from_date') && $request->has('to_date')) {
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->whereDate('created_at', '>', $input['from_date'])
                        ->whereDate('created_at', '<', $input['to_date'])
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->orderBy('id', 'desc')
                        ->get();

                    $data_c = $data->count();
                } else {
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->orderBy('id', 'desc')
                        ->get();

                    $data_c = $data->count();
                }

                if ($data_c > 0) {
                    $data_count += $data_c;
                    $user_statistic_det[] = $data;
                }
            }
        }

        // dd($user_statistic_det); // Uncomment for debugging

        return view('book_publishers.show')->with([
            'input' => $input,
            'bookPublisher' => $bookPublisher,
            'user_statistic_det' => $user_statistic_det,
            'data_count' => $data_count,
        ]);
    }


    /**
     * Show the form for editing the specified book_publisher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            Flash::error('Book Publisher not found');

            return redirect(route('bookPublishers.index'));
        }

        $admins = admlogin::orderBy('id')->pluck('name', 'id');
        $gdata = $admins->toArray();

        return view('book_publishers.edit')->with(['bookPublisher' => $bookPublisher, 'admins' => $gdata]);
    }

    /**
     * Update the specified book_publisher in storage.
     *
     * @param  int              $id
     * @param Updatebook_publisherRequest $request
     *
     * @return Response
     */
    public function update($id, Updatebook_publisherRequest $request)
    {
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            Flash::error('Book Publisher not found');

            return redirect(route('bookPublishers.index'));
        }

        $bookPublisher = $this->bookPublisherRepository->update($request->all(), $id);

        Flash::success('Book Publisher updated successfully.');

        return redirect(route('bookPublishers.index'));
    }

    /**
     * Remove the specified book_publisher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bookPublisher = $this->bookPublisherRepository->find($id);

        if (empty($bookPublisher)) {
            Flash::error('Book Publisher not found');

            return redirect(route('bookPublishers.index'));
        }

        $this->bookPublisherRepository->delete($id);

        Flash::success('Book Publisher deleted successfully.');

        return redirect(route('bookPublishers.index'));
    }
}
