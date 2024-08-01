<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserRegsitrationAPIControllerRequest;
use App\Http\Requests\API\UpdateUserRegsitrationAPIControllerRequest;
use App\Models\ULogin;
use App\Repositories\userfavRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\UserRegsitrationController;
use Response;
use Hash;
use DB;

/**
 * Class userfavController
 * @package App\Http\Controllers\API
 */

class UserRegsitrationAPIController extends UserRegsitrationController
{
    /** @var  userfavRepository */
    private $userfavRepository;

    public function __construct(userfavRepository $userfavRepo)
    {
        $this->userfavRepository = $userfavRepo;
    }

    /**
     * Display a listing of the userfav.
     * GET|HEAD /userfavs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created userfav in storage.
     * POST /userfavs
     *
     * @param CreateuserfavAPIRequest $request
     *
     * @return Response
     */
    public function registrationapi(Request $request)
    {
     
		
		$ULogin= new ULogin();
		if($request->registration_type==1)
		{
			
			$token_details = DB::table('registration_token')->where('token',$request->registration_token)->where('status',1)->first();
			
			if(empty($token_details))
			{
				return response()->json(['status' =>'true', 'message'=>'Invalid token']);
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
          return response()->json(['status' =>'true', 'message'=>'You have successfully register']);
        }else{
			return response()->json(['status' =>'true', 'message'=>'Oops Something went wrong']);
		}
	}

    /**
     * Display the specified userfav.
     * GET|HEAD /userfavs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified userfav in storage.
     * PUT/PATCH /userfavs/{id}
     *
     * @param int $id
     * @param UpdateuserfavAPIRequest $request
     *
     * @return Response
     */
    public function update()
    {
    }

    /**
     * Remove the specified userfav from storage.
     * DELETE /userfavs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy()
    {
        /** @var userfav $userfav */
        
    }
}
