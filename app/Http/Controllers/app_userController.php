<?php

namespace App\Http\Controllers;

use app;
use Flash;
use Response;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\admlogin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Subscription_plan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\DataTables\app_userDataTable;
use App\Models\UsersActiveSubscriptions;
use App\Repositories\app_userRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Createapp_userRequest;
use App\Http\Requests\Updateapp_userRequest;
use App\Models\app_user;


class app_userController extends AppBaseController
{
    /** @var  app_userRepository */
    private $appUserRepository;

    public function __construct(app_userRepository $appUserRepo)
    {
        $this->appUserRepository = $appUserRepo;
    }

    /**
     * Display a listing of the app_user.
     *
     * @param app_userDataTable $appUserDataTable
     * @return Response
     */
    public function index(app_userDataTable $appUserDataTable)
    {
        return $appUserDataTable->render('app_users.index');
    }

    /**
     * Show the form for creating a new app_user.
     *
     * @return Response
     */
    public function create()
    {
        // Retrieve all data from class_master
        $classes = DB::table('class_master')->get();
        
        // Format data for select field
        $classesData = $classes->pluck('class_name', 'id')->toArray(); 
        $subscriptions = Subscription_plan::select('id','name', 'price', 'plan_category', 'validity')->get();

        return view('app_users.create', compact('classesData' ,'subscriptions'));
    }

    /**
     * Store a newly created app_user in storage.
     *
     * @param Createapp_userRequest $request
     *
     * @return Response
     */
    public function store(Createapp_userRequest $request)
    {  
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|between:3,255',
            'email' => [
                'required',
                'email:rfc,dns',
                function ($attribute, $value, $fail) {
                    $existsInUlogins = DB::table('u_logins')->where('email', $value)->exists();
                    $existsInAdmlogin = DB::table('admlogin')->where('email', $value)->exists();

                    if ($existsInUlogins || $existsInAdmlogin) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
            'mobile' => 'required|numeric|digits:10|unique:u_logins,mobile',
            'password' => 'required|string|min:8',
            // 'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female,Others',
            'preferred_segment' => 'required|in:K12/School,Higher Education',
            'class' => 'required_if:preferred_segment,K12/School|nullable|numeric|exists:class_master,id',
            'personal_address' => 'required|string',
            'institute_address' => 'required|string',
            'registration_type' => 'required|in:0,3',
            'registration_token' => 'required_if:registration_type,3',
        ], [
            'registration_type.required' => 'User type is required.',
            'registration_type.in' => 'Please select a valid user type.',
            'registration_token.required_if' => 'Enrollment number is required when the user type is selected as Institutional.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return with errors
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
       
        //* updating Password
        // Create the user with hashed password
        $input['password'] = Hash::make(trim($request->input('password')));
        $input['type']= 'App User';
        $appUser = $this->appUserRepository->create($input);
        // $userId = 1000;
        $planId = $request->subscription_plan;
        //* Getting Plan Info
        $plan = Subscription_plan::where('id' ,$planId)->first();    
        //* Activating User Free Plan
        if ($plan) {
            $planName = $plan->name;
            $planPrice = $plan->price;
            $planDescription = $plan->description;
            $planValidity = $plan->validity;
            $validity = $plan->validity;
            $validity = $plan->validity; // This is 365 from your plan data

            // Get today's date
            $today = Carbon::now();

            // Calculate the end date by adding the validity (365 days) to today's date
            $endDate = $today->addDays($validity)->toDateString(); // This will return just the date in 'YYYY-MM-DD'
             
            //assign plan to the Users
            $subdvibet = DB::table('subscribers')->insert([
                'plan_name' => $planName,
                'plan_end_date' =>$endDate,
                'user_id' => $appUser->id,
                'subscription_id' =>$plan->id,
                'plan_category' =>$plan->plan_category,
                'configuration_type' =>$plan->configuration_type,
                'allowed_material' =>$plan->allowed_material,
                'created_at' => Carbon::now(),
                'auto_renew' => 0,
                'status' => 1
            ]);
        } else {
            // do nothing as of now
            
        }

        Flash::success('App User saved successfully.');

        return redirect(route('appUsers.index'));
    }

    /**
     * Display the specified app_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }

        return view('app_users.show')->with('appUser', $appUser);
    }

    /**
     * Show the form for editing the specified app_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appUser = $this->appUserRepository->find($id);
         // Retrieve all data from class_master
         $classes = DB::table('class_master')->get();
        
         //get user active subscription 
         $subscription = DB::table('subscribers')
         ->where('user_id', $appUser->id)
         ->where('status', 1)
         ->first();
        //  dd($subscription);
         $user_subscription = $subscription ? $subscription->subscription_id : null;
         // Format data for select field
         $classesData = $classes->pluck('class_name', 'id')->toArray(); 
         $subscriptions = Subscription_plan::select('id','name', 'price', 'plan_category', 'validity')->get();
 
        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }

        return view('app_users.edit')->with(['appUser'=> $appUser, 'classesData' =>$classesData, 'subscriptions' =>$subscriptions ,'user_subscription' =>$user_subscription] ) ;
    }

    /**
     * Update the specified app_user in storage.
     *
     * @param  int              $id
     * @param Updateapp_userRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $adminuser = app_user::where('id', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,255',
            
            'email' => [
                'required',
                'email:rfc,dns',
                function ($attribute, $value, $fail) use ($id, $adminuser) {
                    // Check email uniqueness in `u_logins`
                    $existsInUlogins = DB::table('u_logins')
                        ->where('email', $value)
                        ->where('id', '!=', $id) // Exclude current user by ID
                        ->exists();

                    if ($existsInUlogins) {
                        $fail('The email has already been taken in user logins.');
                    }

                    // If admin user is found, also check in `admlogin`
                    if ($adminuser) {
                        $existsInAdmlogin = DB::table('admlogin')
                            ->where('email', $value)
                            ->where('id', '!=', $adminuser->parent_user) // Exclude current admin user by ID
                            ->exists();

                        if ($existsInAdmlogin) {
                            $fail('The email has already been taken in admin logins.');
                        }
                    }
                },
            ],

            'mobile' => [
                'required',
                'numeric',
                'digits:10',
                function ($attribute, $value, $fail) use ($id) {
                    // Check mobile uniqueness, ignoring the current user's ID
                    $existsInUlogins = DB::table('u_logins')
                        ->where('mobile', $value)
                        ->where('id', '!=', $id) // Exclude current user by ID
                        ->exists();

                    if ($existsInUlogins) {
                        $fail('The mobile number has already been taken.');
                    }
                },
            ],

            // 'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female,Others',
            'preferred_segment' => 'required|in:K12/School,Higher Education',
            'class' => 'required_if:preferred_segment,K12/School|nullable|numeric|exists:class_master,id',
            'personal_address' => 'required|string',
            'institute_address' => 'required|string',
            'registration_type' => 'required|in:0,3',
            'registration_token' => 'required_if:registration_type,3',
        ],
        [
            'registration_type.required' => 'User type is required.',
            'registration_type.in' => 'Please select a valid user type.',
            'registration_token.required_if' => 'Enrollment number is required when the user type is selected as Institutional.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return with errors
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }
        
        $input = $request->all(); // Get all request inputs
        //* updating Password
        // Initialize input array with request data
        $input = $request->except('password'); // Get all input except password
        // Check if password exists and is not empty in the request
        if ($request->filled('password')) {
            // Hash the password and add it to the $input array if it's present
            $input['password'] = Hash::make(trim($request->input('password')));
        } else {
            // Do nothing if the password field is not present or empty
        }
        $appUser = $this->appUserRepository->update($input, $id);
        // DB::table('teacherdetail')->where('email',$request->user_email)->update(['email' => $request->email, 'mobile_no' => $request->mobile, 'teacher_name' => $request->name]);
        // DB::table('admlogin')->where('email',$request->user_email)->update(['email' => $request->email, 'name' => $request->name]);

        // Access subscription plan details
        $planId = $request->subscription_plan;
        //* Getting Plan Info
        $plan = Subscription_plan::where('id' ,$planId)->first();   
        if ($plan) {
            // Plan details
            $planName = $plan->name;
            $planPrice = $plan->price;
            $planDescription = $plan->description;
            $planValidity = $plan->validity; // 365 days from the plan

            // Get today's date and calculate end date
            $today = Carbon::now();
            $endDate = $today->addDays($planValidity)->toDateString(); // 'YYYY-MM-DD'

            // Check if subscription already exists for the user
            $subscription = DB::table('subscribers')
                ->where('user_id', $appUser->id)
                ->where('subscription_id', $plan->id)
                ->where('status', 1)
                ->first();    
            if ($subscription) {
                DB::table('subscribers')
                    ->where('user_id', $appUser->id)
                    ->where('subscription_id', $plan->id)
                    ->update([
                        'plan_name' => 'testuser',
                        'plan_end_date' => $endDate,
                        'plan_category' => $plan->plan_category,
                        'configuration_type' => $plan->configuration_type,
                        'allowed_material' => $plan->allowed_material,
                        'updated_at' => Carbon::now(),
                        'status' =>1,
                    ]);
            } else {
                //deactive all others subscription
                $subscription_all = DB::table('subscribers')
                ->where('user_id', $appUser->id)
                ->get();
                //deactive all others subscription
                if ($subscription_all->isNotEmpty()) {
                    DB::table('subscribers')
                        ->where('user_id', $appUser->id)
                        ->update(['status' => 0]);
                }

                // If subscription doesn't exist, create a new one
                DB::table('subscribers')->insert([
                    'plan_name' => $planName,
                    'plan_end_date' => $endDate,
                    'user_id' => $appUser->id,
                    'subscription_id' => $plan->id,
                    'plan_category' => $plan->plan_category,
                    'configuration_type' => $plan->configuration_type,
                    'allowed_material' => $plan->allowed_material,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        Flash::success('App User updated successfully.');

        return redirect(route('appUsers.index'));
    }

    /**
     * Remove the specified app_user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }

        $this->appUserRepository->delete($id);

        Flash::success('App User deleted successfully.');

        return redirect(route('appUsers.index'));
    }
}
