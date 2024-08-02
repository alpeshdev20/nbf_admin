<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\app_material;
use App\Models\app_user;
use App\Models\registration_token;
use App\Models\book_publisher;
use App\Models\School;
use App\Models\token_batch_id;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
class RegistrationtokenController extends Controller
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
        if(isset(Auth::user()->access->access_role) &&  Auth::user()->access->access_role == 2) {
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
    public function schooluser()
    {
       $value=DB::table('schools')->get();
       return view('registration_token',compact('value'));
    }
	
    public function store(Request $request)
    {
		
		
        $school_id=$request->school_id;
        $status='1';
        $tok=$request->token;
       
	   for($i=1;$i<=$tok;$i++)
        {
            $token = self::token_create();
			 $arr=array(
                'school_id'=>$school_id,
                'status'=>$status,
                'token'=>$token,
			);
		DB::table('registration_tokens')->insert($arr);
        }
        
        return redirect('list')->with('success', 'Register Successfully!');;   
    }
	
	
	public function manageTokens(Request $request, $schoolid){
		$school = School::where('id', $schoolid)->first();
		if (!$school) {
            Flash::error('School not found');
            return redirect(route('schools.index'));
        }
		
		return view('registration_token.create')->with(['school'=>$school]);
	}
	
	public function createTokens(Request $request, $schoolid){
		
		try{
			$batch = new token_batch_id;
			$batch->batch_name = chr(rand(65,90)).chr(rand(65,90)).date_format(now(), 'Ym-dhis');
			$batch->school_id = $schoolid;
			
			if(!$batch->save()) throw new \Exception('Could not create token group.');
			
			$tokens = [];
			for($i=0; $i<$request->count; $i++){
				$t = new registration_token;
				$t->token = self::token_create();
				$t->batch_id = $batch->id;
				$t->school_id = $schoolid;
				$t->save();
				$tokens[] = $t->token;
			}
			return response()->json(['batch_id'=>$batch->id, 'batch_name'=>$batch->batch_name, 'batch_date'=>date_format(now(), 'd/m/Y h:i'), 'tokens'=>$tokens], 200);
		}catch(\Exception $ex){
			return response()->json($ex->getMessage(), 351);
		}
	}
	
	public function downloadTokenBatch(Request $request, $id){
		try{
			$tokens = registration_token::where('batch_id', $id)->get();
			if(empty($tokens))throw new \Exception('Could not find tokens for this batch.');
			$batch = token_batch_id::where('id', $id)->first();
			
			$batch = ($batch!=null)?($batch->batch_name):('tokens_'.$id);
			
			$headers = array(
				"Content-type" => "text/csv",
				"Content-Disposition" => "attachment; filename=$batch.csv",
				"Pragma" => "no-cache",
				"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
				"Expires" => "0"
			);
			
			$callback = function() use ($tokens){
				$file = fopen('php://output', 'w');
				fputcsv($file, ['Tokens']);

				foreach($tokens as $token) {
					fputcsv($file, array( $token->token ));
				}
				fclose($file);
			};
			
			return response()->stream($callback, 200, $headers);
			
		}catch(\Exception $ex){
			Flash::error($ex->getMessage());
			return response()->back();
		}
	}
	
	public static function token_create(){
		
		$token= chr(rand(65,90)).chr(rand(65,90)).rand(10000,999999);
		$check_uid = self::tokenUid($token);
		if($check_uid != 1){
			self::token_create();
		}
		return $token;
	}
	public static function tokenUid($u_id){    //////parameter of u_id////////
		$chk = 0;
		$s_datas = registration_token::where('token',$u_id)->first();
		if(empty($s_datas)){
			$chk = 1;
		}
		return $chk;
	}
	
    public function listtoken()
    {
        $book=DB::table('registration_tokens')->get();
        $school=DB::table('schools')->get();
      return view('registration_token.list',compact('book','school'));
    }
	
    public function schooledit(Request $request)
    {
		$search=$request['search'] ?? "";
		$edittoken=DB::table('registration_tokens');
		if($search !="")
		{
			$edittoken=$edittoken->where('token','LIKE',"%$search%");
			
		}
		$edittoken=$edittoken->paginate(10);
           
		return view('registration_token.edit',compact('edittoken','search'));
    }
	
    public function delete($id)
    {
        DB::delete('delete from registration_token where id = ?',[$id]);
        return redirect('list')->with('delete', 'Successfully! Delete');
    }
    public function update(Request $request)
    {
        $id = $request->hidden_id;
        $brr['school_id'] = $request->school_id; 
        DB::table('registration_tokens')->where('id',$id)->update($brr);
        return redirect('list')->with('update', 'Update Successfully!');
    }
    public function changeStatus(Request $request)
    {
        $school_id = $request->school_id;
        $registration_token = registration_token::find($school_id);
        $brr['status'] = $request->status; 
       $update = DB::table('registration_tokens')->where('school_id',$school_id)->whereIn('status',[0,1])->update($brr);
       if($update){
            return 1;
       }else{
            return 0;
       }
       // return response()->json(['success'=>'Registration token status updated successfully.']);
    }
	 public function changetoken(Request $request)
    {
	
		$id = $request->school_id;
		
		$registration_token = registration_token::find($id);
		$brr['status'] = $request->status; 
		
     $var=  DB::table('registration_tokens')->where('id',$id)->update($brr);
	if($var){
            return 1;
       }else{
            return 0;
       }
      
    }

}
