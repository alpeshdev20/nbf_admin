<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\app_material;
use App\Models\app_user;
use App\Models\book_publisher;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd("okk");
        // print_r(Auth::user()->access);
        // exit();
        if(isset(Auth::user()->access->access_role) &&  Auth::user()->access->access_role == 2 ) {
            $input=$request->all();
            
            $publisher = array();

            $publishers = \App\Models\book_publisher::where('user_id',Auth::user()->id)->get();
                foreach($publishers as $pub) {
                    $publisher[] = $pub->id;
                }
                // dd($publishers);
            $Publisherbooks=\App\Models\app_material::whereIn('publisher_id',$publisher)->get();
            $Publisherbookscount=\App\Models\app_material::whereIn('publisher_id',$publisher)->count();
            $user_statistic_det=array();
            $data_count=0;//164 books count
            if($Publisherbookscount>0){
            foreach($Publisherbooks as $book){    
                if($request->has('from_date')&&$request->has('from_date')){
                    $data=\App\Models\app_book_analytic::where('book_id',$book->id)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->with(['user','user.subscriber','user.subscriber.subscription','book'])->get();
                    $data_c=\App\Models\app_book_analytic::where('book_id',$book->id)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->with(['user','user.subscriber','user.subscriber.subscription','book'])->count();
                }
                else{

                    $data=\App\Models\app_book_analytic::where('book_id',$book->id)->with(['user','user.subscriber','user.subscriber.subscription','book'])->get();
                    $data_c=\App\Models\app_book_analytic::where('book_id',$book->id)->with(['user','user.subscriber','user.subscriber.subscription','book'])->count();
                }
                if($data_c>0){
                    $data_count+=$data_c;
                        $user_statistic_det[]=$data;
                    }
                }
            }
            return view('home')->with(['input'=>$input,'user_statistic_det'=>$user_statistic_det,'data_count'=>$data_count]);;
        }
        elseif(isset(Auth::user()->access->access_role) &&  Auth::user()->access->access_role == 3 ) {
            $input=$request->all();
            $data_count=0;
            $books = \App\Models\app_material::where('teacher_id', Auth::user()->id)->get();
            
            $user_statistic_det = array();
            foreach($books as $book) {
               
                if($request->has('from_date')&&$request->has('from_date')){
                    $data=\App\Models\app_book_analytic::where('book_id',$book->id)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->with(['user','user.subscriber','user.subscriber.subscription','book'])->get();
                    $data_c=\App\Models\app_book_analytic::where('book_id',$book->id)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->with(['user','user.subscriber','user.subscriber.subscription','book'])->count();
                }
                else{
                    $data=\App\Models\app_book_analytic::where('book_id',$book->id)->with(['user','user.subscriber','user.subscriber.subscription','book'])->get();
                    $data_c=\App\Models\app_book_analytic::where('book_id',$book->id)->with(['user','user.subscriber','user.subscriber.subscription','book'])->count();
                }

                if($data_c>0){
                    $data_count+=$data_c;
                        $user_statistic_det[]=$data;
                    }
            };
            return view('home')->with(['input'=>$input,'user_statistic_det'=>$user_statistic_det,'data_count'=>$data_count]);

        }
        else{
            $input=$request->all();
            
            $data_count=0;
            $user_statistic_det=array();
            $publisher = array();
            $appPublisher=array();
            $publishers = book_publisher::where('user_id', Auth::user()->id)->get();
            foreach($publishers as $pub) {
                $publisher[] = $pub->id;
            }
            $books=app_material::whereIn('publisher_id', $publisher)->pluck('id');
            $User_rec_count=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books) {
                $query->whereIn('book_id',$books);
            },'analytics.book','analytics.user']);
            $User_rec=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books) {
                $query->whereIn('book_id',$books);
            },'analytics.book','analytics.user']);
            if($request->has('from_date')&&$request->has('to_date')){
                $User_rec_count=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books,$input) {
                    $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
                },'analytics.book','analytics.user']);
                $User_rec=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books,$input) {
                    $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
                },'analytics.book','analytics.user']);
                $User_rec_count=$User_rec_count->whereHas('analytics', function (Builder $query) use ($books,$input) {
                    $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
                })
                ->count();
                $User_rec=$User_rec->has('analytics')->orderBy('id','desc')->get();
                return view('home')->with(['input'=>$input,'user_statistic_det'=>$User_rec,'data_count'=>$User_rec_count]);
            }
            $User_rec_count=$User_rec_count->has('analytics')->count();
            $User_rec=$User_rec->has('analytics')->orderBy('id','desc')->get();
            // dd($User_rec);
            $dataTable=DataTables::of($User_rec)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/home" class="btn btn-default btn-xs">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a> <a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

            return view('home')->with(['user_statistic_det'=>$User_rec,'data_count'=>$User_rec_count,'dataTable'=>$dataTable,'books'=>$books]);

            return view('home');

        }
    }

    public function dashTableRecord(Request $request)
    {
        if ($request->ajax()) {
        // $input=$request->all();
        $data_count=0;
        $user_statistic_det=array();
        $publisher = array();
        $appPublisher=array();
        $publishers = book_publisher::where('user_id', Auth::user()->id)->get();
        foreach($publishers as $pub) {
            $publisher[] = $pub->id;
        }
        $books=app_material::whereIn('publisher_id', $publisher)->pluck('id');
        $User_rec_count=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books) {
            $query->whereIn('book_id',$books);
        },'analytics.book','analytics.user']);
        $User_rec=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books) {
            $query->whereIn('book_id',$books);
        },'analytics.book','analytics.user']);
        // if($request->has('from_date')&&$request->has('from_date')){
        //     $User_rec_count=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books,$input) {
        //         $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
        //     },'analytics.book','analytics.user']);
        //     $User_rec=app_user::with(['subscriber','subscriber.subscription','analytics'=>function ( $query) use ($books,$input) {
        //         $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
        //     },'analytics.book','analytics.user']);
        //     $User_rec_count=$User_rec_count->whereHas('analytics', function (Builder $query) use ($books,$input) {
        //         $query->whereIn('book_id',$books)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date']);
        //     })
        //     ->count();
        //     $User_rec=$User_rec->has('analytics')->get();
        //     return view('home')->with(['input'=>$input,'user_statistic_det'=>$User_rec,'data_count'=>$User_rec_count]);
        // }
        $User_rec_count=$User_rec_count->has('analytics')->count();
        $User_rec=$User_rec->has('analytics')->get();
        // dd($User_rec);
        return DataTables::of($User_rec)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="/home" class="btn btn-default btn-xs">
                <i class="glyphicon glyphicon-eye-open"></i>
            </a> <a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
   

}
