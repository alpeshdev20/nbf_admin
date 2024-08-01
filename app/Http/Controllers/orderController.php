<?php

namespace App\Http\Controllers;
use App\DataTables\order_DataTable;
use App\Models\transaction;
use App\Models\Subscriber;
use DB;
use Flash;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index(order_DataTable $order_DataTable)
    {
        return $order_DataTable->render('order.index');
    }

    public function show($id)
    {
        $order_details = transaction::find($id);
        $user_details = DB::table('transactions')->where('transactions.id',$id)
        ->leftjoin('coupon_codes','coupon_codes.id','=','transactions.coupon_code_id')
        ->leftjoin('user_address','user_address.user_id','=','transactions.user_id')
        ->leftjoin('state','state.id','=','user_address.state_id')->first();
        return view('order.show',compact('order_details','id','user_details'));
    }
}
