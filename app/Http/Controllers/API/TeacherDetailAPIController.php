<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTeacherDetailAPIRequest;
use App\Http\Requests\API\UpdateTeacherDetailAPIRequest;
use App\Models\TeacherDetail;
use App\Repositories\TeacherDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TeacherDetailResource;
use Response;

/**
 * Class TeacherDetailController
 * @package App\Http\Controllers\API
 */

class TeacherDetailAPIController extends AppBaseController
{
    /** @var  TeacherDetailRepository */
    private $teacherDetailRepository;

    public function __construct(TeacherDetailRepository $teacherDetailRepo)
    {
        $this->teacherDetailRepository = $teacherDetailRepo;
    }

    /**
     * Display a listing of the TeacherDetail.
     * GET|HEAD /teacherDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $teacherDetails = $this->teacherDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TeacherDetailResource::collection($teacherDetails), 'Teacher Details retrieved successfully');
    }

    /**
     * Store a newly created TeacherDetail in storage.
     * POST /teacherDetails
     *
     * @param CreateTeacherDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTeacherDetailAPIRequest $request)
    {
        $input = $request->all();

        $teacherDetail = $this->teacherDetailRepository->create($input);

        return $this->sendResponse(new TeacherDetailResource($teacherDetail), 'Teacher Detail saved successfully');
    }

    /**
     * Display the specified TeacherDetail.
     * GET|HEAD /teacherDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TeacherDetail $teacherDetail */
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            return $this->sendError('Teacher Detail not found');
        }

        return $this->sendResponse(new TeacherDetailResource($teacherDetail), 'Teacher Detail retrieved successfully');
    }

    /**
     * Update the specified TeacherDetail in storage.
     * PUT/PATCH /teacherDetails/{id}
     *
     * @param int $id
     * @param UpdateTeacherDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeacherDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var TeacherDetail $teacherDetail */
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            return $this->sendError('Teacher Detail not found');
        }

        $teacherDetail = $this->teacherDetailRepository->update($input, $id);

        return $this->sendResponse(new TeacherDetailResource($teacherDetail), 'TeacherDetail updated successfully');
    }

    /**
     * Remove the specified TeacherDetail from storage.
     * DELETE /teacherDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TeacherDetail $teacherDetail */
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            return $this->sendError('Teacher Detail not found');
        }

        $teacherDetail->delete();

        return $this->sendSuccess('Teacher Detail deleted successfully');
    }
}
