<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\app_material;
use App\Models\app_user;
use App\Models\ULogin;
use App\Models\book_publisher;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use DB;
use Hash;
class UserRegsitrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request)
    {
     return view('auth.register');  
    }
	public function submit(Request $request)
	{
		
		$request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'password'=>'required|min:5|max:12',
            
        ]);

		$ULogin= new ULogin();
		if($request->registration_type==1)
		{
			
			$token_details = DB::table('registration_token')->where('token',$request->registration_token)->where('status',1)->first();
			if(empty($token_details))
			{
				return redirect()->back()->with('fail','Invalid Token!!');
			}else{
				$token_details = DB::table('registration_token')->where('token',$request->registration_token)->update(['status'=>2,'updated_at'=>date("Y-m-d h:i:s")]);
			}
			$ULogin->registration_token=$request->registration_token; 
		}
        $ULogin->name=$request->name;
	
		$ULogin->email=$request->email; 
		$ULogin->mobile=$request->mobile; 
        $ULogin->password=Hash::make($request->password); 
		$ULogin->registration_type=$request->registration_type;
		$res=$ULogin->save();
		if($res)
        {
          return back()->with('success','you have successfully register');
        }else{
			return redirect()->back()->with('fail','Oops Something Went Wrong!!');
		}
	}

}
