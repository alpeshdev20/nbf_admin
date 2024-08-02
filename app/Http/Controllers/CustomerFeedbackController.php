<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerFeedback;
use App\Repositories\CustomerFeedbackRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\DataTables\CustomerFeedbackDataTable;
use App\Http\Requests\CustomerFeedbackReqeust;
use Flash;


class CustomerFeedbackController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $feedbackRepository;

    public function __construct(CustomerFeedbackRepository $feedbackRepository)
    {        
        $this->feedbackRepository = $feedbackRepository;
    }

    public function index(CustomerFeedbackDataTable $customerfeedbackDataTable)
    {
        return $customerfeedbackDataTable->render('customerfeedback.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerFeedbackReqeust $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerFeedbackReqeust $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}