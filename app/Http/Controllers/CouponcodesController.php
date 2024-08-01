<?php

namespace App\Http\Controllers;
use App\DataTables\coupon_codesDataTable;
use App\Models\couponcodes;
use App\Repositories\coupon_codeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flash;

class CouponcodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(coupon_codeRepository $couponRepo)
    {
        $this->coupon_codeRepository = $couponRepo;
    }



    public function index(coupon_codesDataTable $coupon_codesDataTable)
    {
        return $coupon_codesDataTable->render('coupon_codes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupon_codes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request,[
            'code' => 'required|max:10|unique:coupon_codes',
            'discount_percentage' => 'required',
            'expiry_date' => 'required',
        ],
        [
          'discount_percentage.required' => 'Discount percentage is required', 
          'expiry_date.required' => "Date is required", 
        ]
        );

        $input = $request->all();
        $input['code'] = Str::upper($input['code']);
        $coupon_codeRepository = $this->coupon_codeRepository->create($input);
        Flash::success(' Coupon code saved successfully.');
        return redirect(route('coupon_codes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\couponcodes  $couponcodes
     * @return \Illuminate\Http\Response
     */
    public function show(couponcodes $couponcodes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\couponcodes  $couponcodes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon_codes = $this->coupon_codeRepository->find($id);
        return view('coupon_codes.edit',compact('coupon_codes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\couponcodes  $couponcodes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate($request,[
            'code' => 'required|max:10',
            'discount_percentage' => 'required',
            'expiry_date' => 'required',
        ],
        [
          'discount_percentage.required' => 'Discount percentage is required', 
          'expiry_date.required' => "Date is required", 
        ]
        );
        $coupon_codes = $this->coupon_codeRepository->find($id);
        $input = $request->all();
        $input['code'] = Str::upper($input['code']);
        $coupon_codes = $this->coupon_codeRepository->update($input,$id);
        Flash::success('Coupon code updated successfully.');
        return redirect(route('coupon_codes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\couponcodes  $couponcodes
     * @return \Illuminate\Http\Response
     */
    public function destroy(couponcodes $couponcodes)
    {
        //
    }
}
