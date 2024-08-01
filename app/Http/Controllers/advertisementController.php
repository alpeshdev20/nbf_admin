<?php

namespace App\Http\Controllers;

use App\DataTables\advertisementDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateadvertisementRequest;
use App\Http\Requests\UpdateadvertisementRequest;
use App\Repositories\advertisementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class advertisementController extends AppBaseController
{
    /** @var  advertisementRepository */
    private $advertisementRepository;

    public function __construct(advertisementRepository $advertisementRepo)
    {
        $this->advertisementRepository = $advertisementRepo;
    }

    /**
     * Display a listing of the advertisement.
     *
     * @param advertisementDataTable $advertisementDataTable
     * @return Response
     */
    public function index(advertisementDataTable $advertisementDataTable)
    {
        return $advertisementDataTable->render('advertisements.index');
    }

    /**
     * Show the form for creating a new advertisement.
     *
     * @return Response
     */
    public function create()
    {
        return view('advertisements.create');
    }

    /**
     * Store a newly created advertisement in storage.
     *
     * @param CreateadvertisementRequest $request
     *
     * @return Response
     */
    public function store(CreateadvertisementRequest $request)
    {
        $input = $request->all();

        
        $file = $request->file('image');
        $fileName= $file->getClientOriginalName();
        $fileName=str_replace(" ","_",$fileName);
        $file->move(public_path('uploads/file'),$fileName);
        $input['image']=$fileName;        


        $advertisement = $this->advertisementRepository->create($input);

        Flash::success('Advertisement saved successfully.');

        return redirect(route('advertisements.index'));
    }

    /**
     * Display the specified advertisement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            Flash::error('Advertisement not found');

            return redirect(route('advertisements.index'));
        }

        return view('advertisements.show')->with('advertisement', $advertisement);
    }

    /**
     * Show the form for editing the specified advertisement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            Flash::error('Advertisement not found');

            return redirect(route('advertisements.index'));
        }

        return view('advertisements.edit')->with('advertisement', $advertisement);
    }

    /**
     * Update the specified advertisement in storage.
     *
     * @param  int              $id
     * @param UpdateadvertisementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateadvertisementRequest $request)
    {
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            Flash::error('Advertisement not found');

            return redirect(route('advertisements.index'));
        }


        $input = $request->all();

        $file=$request->file('image');
        if($file) {
            $filename= $file->getClientOriginalName();
            $filename = str_replace(" ","_", $filename);
            $file->move(public_path('uploads/file'), $filename);
            $input['image'] = $filename;    
        }
        
        $advertisement = $this->advertisementRepository->update($input, $id);

        Flash::success('Advertisement updated successfully.');

        return redirect(route('advertisements.index'));
    }

    /**
     * Remove the specified advertisement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            Flash::error('Advertisement not found');

            return redirect(route('advertisements.index'));
        }

        $this->advertisementRepository->delete($id);

        Flash::success('Advertisement deleted successfully.');

        return redirect(route('advertisements.index'));
    }
}
