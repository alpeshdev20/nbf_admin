<?php

namespace App\Http\Controllers;

use App\DataTables\app_subjectDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_subjectRequest;
use App\Http\Requests\Updateapp_subjectRequest;
use App\Repositories\app_subjectRepository;
use Flash;
use App\Models\genre;
use App\Models\material;
use App\Models\language;
use App\Models\app_subject;
use App\Models\app_department;
use App\Models\app_material;
use App\Http\Controllers\AppBaseController;
use Response;

class app_subjectController extends AppBaseController
{
    /** @var  app_subjectRepository */
    private $appSubjectRepository;

    public function __construct(app_subjectRepository $appSubjectRepo)
    {
        $this->appSubjectRepository = $appSubjectRepo;
    }

    /**
     * Display a listing of the app_subject.
     *
     * @param app_subjectDataTable $appSubjectDataTable
     * @return Response
     */
    public function index(app_subjectDataTable $appSubjectDataTable)
    {
        return $appSubjectDataTable->render('app_subjects.index');
    }

    /**
     * Show the form for creating a new app_subject.
     *
     * @return Response
     */
    public function create()
    {
        $genre = app_department::orderBy('id')->pluck('department_name', 'id');
        $gdata = $genre->toArray();
        return view('app_subjects.create')->with(array('dept' => $gdata));
    }

    /**
     * Store a newly created app_subject in storage.
     *
     * @param Createapp_subjectRequest $request
     *
     * @return Response
     */
    public function store(Createapp_subjectRequest $request)
    {
        $input = $request->all();

        $appSubject = $this->appSubjectRepository->create($input);

        Flash::success('App Subject saved successfully.');

        return redirect(route('appSubjects.index'));
    }

    /**
     * Display the specified app_subject.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            Flash::error('App Subject not found');

            return redirect(route('appSubjects.index'));
        }

        return view('app_subjects.show')->with('appSubject', $appSubject);
    }

    /**
     * Show the form for editing the specified app_subject.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            Flash::error('App Subject not found');

            return redirect(route('appSubjects.index'));
        }

        $genre = app_department::orderBy('id')->pluck('department_name', 'id');
        $gdata = $genre->toArray();
        return view('app_subjects.edit')->with(array('appSubject'=> $appSubject,'dept' => $gdata));


//        return view('app_subjects.edit')->with('appSubject', $appSubject);
    }

    /**
     * Update the specified app_subject in storage.
     *
     * @param  int              $id
     * @param Updateapp_subjectRequest $request
     *
     * @return Response
     */
    public function update($id, Updateapp_subjectRequest $request)
    {
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            Flash::error('App Subject not found');

            return redirect(route('appSubjects.index'));
        }

        $appSubject = $this->appSubjectRepository->update($request->all(), $id);

        Flash::success('App Subject updated successfully.');

        return redirect(route('appSubjects.index'));
    }

    /**
     * Remove the specified app_subject from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appSubject = $this->appSubjectRepository->find($id);

        if (empty($appSubject)) {
            Flash::error('App Subject not found');

            return redirect(route('appSubjects.index'));
        }

        $data = app_material::where('subject_id', $id)->get();

        if(count($data) > 0) {
            Flash::error('Material related to this subject Exists, please delete them first.');

            return redirect(route('appSubjects.index'));            
        }

        $this->appSubjectRepository->delete($id);

        Flash::success('App Subject deleted successfully.');

        return redirect(route('appSubjects.index'));
    }
}
