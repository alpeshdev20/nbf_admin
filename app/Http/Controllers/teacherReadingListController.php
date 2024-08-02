<?php

namespace App\Http\Controllers;
use App\DataTables\pa_token_usedDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\prescribed_reading_list;
use App\Models\readingListToken;
use App\Models\TeacherDetail;
use App\Models\admlogin;
use App\Models\pa_token_batch_ids;
use App\Models\pa_token;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Flash;
use DB;
use Illuminate\Http\Request;

class teacherReadingListController extends Controller
{
    public function create(Request $request)
    {
          
    }

    public function manageTokens(Request $request, $reading_list_id){
		$email = Auth::user()->email;
		$teacher = DB::table('teacherdetail')->where('email',$email)->first();
		$allowed_token = $teacher->number_of_token;
		$used_token = DB::table('pa_token')->where('teacher_id',$teacher->id)->count();
		$available_token = $allowed_token - $used_token;
		$token_count = DB::table('pa_token')->where('teacher_id',$teacher->id)->count();
		$list = prescribed_reading_list::where('id', $reading_list_id)->first();
		if (!$list) {
            Flash::error('Reading List not found');
            return redirect(route('prescribedReadingLists.index'));
        }
		return view('PA_token.create')->with(['list'=> $list, 'teacher'=> $teacher, 'allowed_token'=> $allowed_token, 'available_token'=> $available_token, 'used_token'=> $used_token]);
	}

    public function createToken(Request $request, $reading_list_id){
		
		try{
			$currentDate = Carbon::now()->format('Y-m-d');
            $user_email = Auth::user()->email;
            $teacher = DB::table('teacherdetail')->where('email', $user_email)->first();
			$count = DB::table('pa_token')->where('teacher_id', $teacher->id)->count();
			$remaining_token = $teacher->number_of_token - $count;
            if ($request->count > $remaining_token) {
                return response()->json(['success' => false, 'message' => 'Your have only '. $remaining_token . ' token left.']);
            }
			$batch = new pa_token_batch_ids;
			$batch->batch_name = chr(rand(65,90)).chr(rand(65,90)).date_format(now(), 'Ym-dhis');
			$batch->reading_list_id = $reading_list_id;

			
			if(!$batch->save()) throw new \Exception('Could not create token group.');
			
			$tokens = [];
			for($i=0; $i<$request->count; $i++){
				$t = new pa_token;
				$t->token = self::token_create();
				$t->batch_id = $batch->id;
				$t->reading_list_id = $reading_list_id;
                $t->teacher_id = $teacher->id;
				$t->save();
				$tokens[] = $t->token;
			}
			return response()->json(['success' => true, 'batch_id'=>$batch->id, 'batch_name'=>$batch->batch_name, 'date'=>$currentDate, 'tokens'=>$tokens], 200);
		}catch(\Exception $ex){
			return response()->json($ex->getMessage(), 351);
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
	public static function tokenUid($u_id){    
		$chk = 0;
		$s_datas = pa_token::where('token',$u_id)->first();
		if(empty($s_datas)){
			$chk = 1;
		}
		return $chk;
	}

    public function downloadTokenBatch(Request $request, $id){
		try{
			$tokens = pa_token::where('batch_id', $id)->get();
			if(empty($tokens))throw new \Exception('Could not find tokens for this batch.');
			$batch = pa_token_batch_ids::where('id', $id)->first();
			
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


    public function getusesby(pa_token_usedDataTable $pa_token_usedDataTable)
    {
		return $pa_token_usedDataTable->render('pa_token_used.index');
    }

}
