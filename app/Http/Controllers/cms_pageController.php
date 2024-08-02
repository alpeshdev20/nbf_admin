<?php

namespace App\Http\Controllers;

use App\DataTables\cms_pageDataTable;
use App\Http\Requests;
use App\Http\Requests\Createcms_pageRequest;
use App\Http\Requests\Updatecms_pageRequest;
use App\Repositories\cms_pageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class cms_pageController extends AppBaseController
{
    /** @var  cms_pageRepository */
    private $cmsPageRepository;

    public function __construct(cms_pageRepository $cmsPageRepo)
    {
        $this->cmsPageRepository = $cmsPageRepo;
    }

    /**
     * Display a listing of the cms_page.
     *
     * @param cms_pageDataTable $cmsPageDataTable
     * @return Response
     */
    public function index(cms_pageDataTable $cmsPageDataTable)
    {
        return $cmsPageDataTable->render('cms_pages.index');
    }

    /**
     * Show the form for creating a new cms_page.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_pages.create');
    }

    /**
     * Store a newly created cms_page in storage.
     *
     * @param Createcms_pageRequest $request
     *
     * @return Response
     */
    public function store(Createcms_pageRequest $request)
    {
        $input = $request->all();

        $cmsPage = $this->cmsPageRepository->create($input);

        Flash::success('Cms Page saved successfully.');

        return redirect(route('cmsPages.index'));
    }

    /**
     * Display the specified cms_page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            Flash::error('Cms Page not found');

            return redirect(route('cmsPages.index'));
        }

        return view('cms_pages.show')->with('cmsPage', $cmsPage);
    }

    /**
     * Show the form for editing the specified cms_page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            Flash::error('Cms Page not found');

            return redirect(route('cmsPages.index'));
        }

        return view('cms_pages.edit')->with('cmsPage', $cmsPage);
    }

    /**
     * Update the specified cms_page in storage.
     *
     * @param  int              $id
     * @param Updatecms_pageRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecms_pageRequest $request)
    {
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            Flash::error('Cms Page not found');

            return redirect(route('cmsPages.index'));
        }

        $cmsPage = $this->cmsPageRepository->update($request->all(), $id);

        Flash::success('Cms Page updated successfully.');

        return redirect(route('cmsPages.index'));
    }

    /**
     * Remove the specified cms_page from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsPage = $this->cmsPageRepository->find($id);

        if (empty($cmsPage)) {
            Flash::error('Cms Page not found');

            return redirect(route('cmsPages.index'));
        }

        $this->cmsPageRepository->delete($id);

        Flash::success('Cms Page deleted successfully.');

        return redirect(route('cmsPages.index'));
    }
}
