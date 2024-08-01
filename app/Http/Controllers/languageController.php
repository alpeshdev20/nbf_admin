<?php

namespace App\Http\Controllers;

use App\DataTables\languageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatelanguageRequest;
use App\Http\Requests\UpdatelanguageRequest;
use App\Repositories\languageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class languageController extends AppBaseController
{
    /** @var  languageRepository */
    private $languageRepository;

    public function __construct(languageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the language.
     *
     * @param languageDataTable $languageDataTable
     * @return Response
     */
    public function index(languageDataTable $languageDataTable)
    {
        return $languageDataTable->render('languages.index');
    }

    /**
     * Show the form for creating a new language.
     *
     * @return Response
     */
    public function create()
    {
        return view('languages.create');
    }

    /**
     * Store a newly created language in storage.
     *
     * @param CreatelanguageRequest $request
     *
     * @return Response
     */
    public function store(CreatelanguageRequest $request)
    {
        $input = $request->all();

        

        $language = $this->languageRepository->create($input);

        Flash::success('Language saved successfully.');

        return redirect(route('languages.index'));
    }

    /**
     * Display the specified language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        return view('languages.show')->with('language', $language);
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        return view('languages.edit')->with('language', $language);
    }

    /**
     * Update the specified language in storage.
     *
     * @param  int              $id
     * @param UpdatelanguageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelanguageRequest $request)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        $language = $this->languageRepository->update($request->all(), $id);

        Flash::success('Language updated successfully.');

        return redirect(route('languages.index'));
    }

    /**
     * Remove the specified language from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $language = $this->languageRepository->find($id);

        if (empty($language)) {
            Flash::error('Language not found');

            return redirect(route('languages.index'));
        }

        $this->languageRepository->delete($id);

        Flash::success('Language deleted successfully.');

        return redirect(route('languages.index'));
    }
}
