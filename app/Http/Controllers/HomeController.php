<?php

namespace App\Http\Controllers;
use App\UserResources;
use DB;
use DataTables;
use App\Models\app_user;
use App\Models\app_material;
use Illuminate\Http\Request;
use App\Models\book_publisher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
                if ($request->has('from_date') && $request->has('to_date')) {
                    // Fetch data where created_at or updated_at falls within the date range
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->where(function ($query) use ($input) {
                            $query->whereDate('created_at', '>', $input['from_date'])
                                  ->whereDate('created_at', '<', $input['to_date']);
                        })
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->get();
                    
                    // Count data where created_at or updated_at falls within the date range
                    $data_c = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->where(function ($query) use ($input) {
                            $query->whereDate('created_at', '>', $input['from_date'])
                                  ->whereDate('created_at', '<', $input['to_date']);
                        })
                        ->count();
                } else {
                    // Fetch all data if no date range is provided
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->get();
                
                    // Count all data if no date range is provided
                    $data_c = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->count();
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
               
                if ($request->has('from_date') && $request->has('to_date')) {
                    // Fetch data with both created_at and updated_at date range filters
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->where(function ($query) use ($input) {
                            $query->whereDate('created_at', '>', $input['from_date'])
                                  ->whereDate('created_at', '<', $input['to_date']);
                        })
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->get();
                
                    // Count data with both created_at and updated_at date range filters
                    $data_c = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->where(function ($query) use ($input) {
                            $query->whereDate('created_at', '>', $input['from_date'])
                                  ->whereDate('created_at', '<', $input['to_date']);
                        })
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->count();
                } else {
                    // Fetch all data if no date range is specified
                    $data = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->get();
                
                    // Count all data if no date range is specified
                    $data_c = \App\Models\app_book_analytic::where('book_id', $book->id)
                        ->with(['user', 'user.subscriber', 'user.subscriber.subscription', 'book'])
                        ->count();
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
            $publishers = book_publisher::get();
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
            if ($request->filled('from_date') && $request->filled('to_date')) {
                // Query for user analytics with created_at and updated_at date range filters
                $User_rec_count = app_user::with(['subscriber', 'subscriber.subscription', 'analytics' => function ($query) use ($books, $input) {
                    $query->whereIn('book_id', $books)
                          ->where(function ($query) use ($input) {
                              // Filter by both created_at and updated_at
                              $query->whereDate('created_at', '>=', $input['from_date'])
                                    ->whereDate('created_at', '<=', $input['to_date']);
                          });
                }, 'analytics.book', 'analytics.user']);
            
                $User_rec = app_user::with(['subscriber', 'subscriber.subscription', 'analytics' => function ($query) use ($books, $input) {
                    $query->whereIn('book_id', $books)
                          ->where(function ($query) use ($input) {
                              // Filter by both created_at and updated_at
                              $query->whereDate('created_at', '>=', $input['from_date'])
                                    ->whereDate('created_at', '<=', $input['to_date']);
                          });
                }, 'analytics.book', 'analytics.user']);
            
                // Filter analytics using both created_at and updated_at date range
                $User_rec_count = $User_rec_count->whereHas('analytics', function (Builder $query) use ($books, $input) {
                    $query->whereIn('book_id', $books)
                          ->where(function ($query) use ($input) {
                              $query->whereDate('created_at', '>=', $input['from_date'])
                                    ->whereDate('created_at', '<=', $input['to_date']);
                          });
                })->count();
            
                // Retrieve filtered records
                $User_rec = $User_rec->has('analytics')->orderBy('id', 'desc')->get();

                // Prepare data table
                $dataTable = DataTables::of($User_rec)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="/home" class="btn btn-default btn-xs">
                                      <i class="glyphicon glyphicon-eye-open"></i></a> 
                                      <a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                                      <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            
                // Return the view with the data
                return view('home')->with([
                    'user_statistic_det' => $User_rec,
                    'data_count' => $User_rec_count,
                    'dataTable' => $dataTable,
                    'books' => $books
                ]);
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

    public function UserDataOverview(Request $request)
    {
        if(isset(Auth::user()->access->access_role) &&  Auth::user()->access->access_role == 1 ){
            if ($request->ajax()) {
                $userRecords = UserResources::select('id', 'resource_type', 'name', 'email_address', 'mobile_number', 'birth_date', 'gender', 'personal_address', 'institution_address', 'resource_catalogue' ,'class' ,'summary', 'student_enrollment' ,'school_college_university_name' ,'preferred_segment') // Make sure to select the required fields
                    ->get();
                // Manually fetch the class_name for each record
                foreach ($userRecords as $record) {
                    $record->class = DB::table('class_master')
                        ->where('id', $record->class)
                        ->value('class_name'); // Get the class_name from class_master
                    }
                // Return DataTables instance
                return DataTables::of($userRecords)
                    ->addIndexColumn() // Add an index column for row numbers
                    ->editColumn('resource_catalogue', function ($row) {
                        // Check if resource_catalogue is not null or empty
                        if (empty($row->resource_catalogue)) {
                            return '-'; // Display a message or leave it blank
                        }
                    // Generate the URL for the file
                    $filePath = env('API_URL')  . '/uploads/NBF_Publishers_Authors_Resource_Catalogue/' . $row->resource_catalogue;
                    // Return a link to the file
                    return '<a href="' . $filePath . '" target="_blank">View File</a>';
            
                    })
                    
                    ->rawColumns(['resource_catalogue']) // Allow raw HTML in the resource_catalogue and action columns
                    ->make(true); // Return the JSON response
            }
            return view('userdataoverview');
        }
}

   

}
