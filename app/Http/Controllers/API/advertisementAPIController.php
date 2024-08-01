<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateadvertisementAPIRequest;
use App\Http\Requests\API\UpdateadvertisementAPIRequest;
use App\Models\advertisement;
use App\Repositories\advertisementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class advertisementController
 * @package App\Http\Controllers\API
 */

class advertisementAPIController extends AppBaseController
{
    /** @var  advertisementRepository */
    private $advertisementRepository;

    public function __construct(advertisementRepository $advertisementRepo)
    {
        $this->advertisementRepository = $advertisementRepo;
    }

    /**
     * Display a listing of the advertisement.
     * GET|HEAD /advertisements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $advertisements = $this->advertisementRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($advertisements->toArray(), 'Advertisements retrieved successfully');
    }

    /**
     * Store a newly created advertisement in storage.
     * POST /advertisements
     *
     * @param CreateadvertisementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateadvertisementAPIRequest $request)
    {
        $input = $request->all();

        
        $file = $request->file('image');
        $fileName= $file->getClientOriginalName();
        $fileName=str_replace(" ","_",$fileName);
        $file->move(public_path('uploads/file'),$fileName);
        $input['image']=$fileName;

        $advertisement = $this->advertisementRepository->create($input);

        return $this->sendResponse($advertisement->toArray(), 'Advertisement saved successfully');
    }

    /**
     * Display the specified advertisement.
     * GET|HEAD /advertisements/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
        }

        return $this->sendResponse($advertisement->toArray(), 'Advertisement retrieved successfully');
    }

    /**
     * Update the specified advertisement in storage.
     * PUT/PATCH /advertisements/{id}
     *
     * @param int $id
     * @param UpdateadvertisementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateadvertisementAPIRequest $request)
    {
        $input = $request->all();

        /** @var advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
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

        return $this->sendResponse($advertisement->toArray(), 'advertisement updated successfully');
    }

    /**
     * Remove the specified advertisement from storage.
     * DELETE /advertisements/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var advertisement $advertisement */
        $advertisement = $this->advertisementRepository->find($id);

        if (empty($advertisement)) {
            return $this->sendError('Advertisement not found');
        }

        $advertisement->delete();

        return $this->sendSuccess('Advertisement deleted successfully');
    }
}
