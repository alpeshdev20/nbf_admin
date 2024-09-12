<?php

namespace App\Http\Controllers;

use DB;
use Flash;
use App\User;
use Response;
use App\Http\Requests;
use App\Models\access_role;
use App\Models\app_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\admloginDataTable;
use App\Repositories\admloginRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateadmloginRequest;
use App\Http\Requests\UpdateadmloginRequest;
use App\Models\admlogin;
use App\Repositories\admin_accessRepository;
use Illuminate\Validation\ValidationException;

class admloginController extends AppBaseController
{
    /** @var  admloginRepository */
    private $admloginRepository;

    /** @var  admin_accessRepository */
    private $adminAccessRepository;

    public function __construct(admloginRepository $admloginRepo, admin_accessRepository $adminAccessRepo)
    {
        $this->admloginRepository = $admloginRepo;
        $this->adminAccessRepository = $adminAccessRepo;
    }

    /**
     * Display a listing of the admlogin.
     *
     * @param admloginDataTable $admloginDataTable
     * @return Response
     */
    public function index(admloginDataTable $admloginDataTable)
    {
        return $admloginDataTable->render('admlogins.index');
    }

    /**
     * Show the form for creating a new admlogin.
     *
     * @return Response
     */
    public function create()
    {
        $mat = access_role::orderBy('id')->pluck('role', 'id');
        $mdata = $mat->toArray();
        return view('admlogins.create')->with(array('role' => $mdata));
    }

    /**
     * Store a newly created admlogin in storage.
     *
     * @param CreateadmloginRequest $request
     *
     * @return Response
     */
    public function store(CreateadmloginRequest $request)
    {
        $request->validate([
            'email' => [
            'required',
            'email',
            function ($attribute, $value, $fail) {
                $existsInUlogins = DB::table('u_logins')->where('email', $value)->exists();
                $existsInAdmlogin = DB::table('admlogin')->where('email', $value)->exists();

                if ($existsInUlogins || $existsInAdmlogin) {
                    $fail('The email has already been taken.');
                }
            },
        ],
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'access_role' => 'required|integer', 
            'active' => 'required|boolean',
            ]);

        $input = $request->all();
        
       
        $role = $input["access_role"];

        $active = $input["active"];

        unset($input["active"]);

        unset($input["role"]);

        $input["password"] =  Hash::make($input["password"]);

        $admlogin = $this->admloginRepository->create($input);
        $parent_user = $admlogin->id;
        $type = '';

        if ($request->access_role == 2) {
            $type = 'publisher';
            $appuserLogin = $this->admloginRepository->CreateAppUser($input ,$type ,$parent_user);
        } elseif ($request->access_role == 3) {
            $type = 'teacher';
            $appuserLogin = $this->admloginRepository->CreateAppUser($input ,$type, $parent_user);
        }  else {
            $type = ''; // Handle other cases if needed
        }
        
        $nData = array();
        $nData["admin_id"] = $admlogin["id"];
        $nData["access_role"] = $role;
        $nData["active"] = $active;
        $access = $this->adminAccessRepository->create($nData);

        Flash::success('Admlogin saved successfully.');

        return redirect(route('admlogins.index'));
    }

    /**
     * Display the specified admlogin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            Flash::error('Admlogin not found');

            return redirect(route('admlogins.index'));
        }

        return view('admlogins.show')->with('admlogin', $admlogin);
    }

    /**
     * Show the form for editing the specified admlogin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $admlogin = $this->admloginRepository->get()->where('id', $id)->with('access')->first();

        $admlogin["access_role"] = $admlogin["access"]["access_role"];
        $admlogin["active"] = $admlogin["access"]["active"];

        if (empty($admlogin)) {
            Flash::error('Admlogin not found');

            return redirect(route('admlogins.index'));
        }

        $mat = access_role::orderBy('id')->pluck('role', 'id');
        $mdata = $mat->toArray();

        $admlogin["password"] = "";
        return view('admlogins.edit')->with(array('admlogin' => $admlogin, 'role' => $mdata));
    }

    /**
     * Update the specified admlogin in storage.
     *
     * @param  int              $id
     * @param UpdateadmloginRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateadmloginRequest $request)
    {   
        $type = '';
        if ($request->access_role == 2) {
            $type = 'publisher';
            $appUser = app_user::where(['email' => $request->email , 'type' =>$type])->first();
            if($appUser)
            {
                if (is_null($appUser->parent_user) || empty($appUser->parent_user)) {
                    $appUser->parent_user = $id;
                    $appUser->save(); 
                }
            }
        } elseif ($request->access_role == 3) {
            $type = 'teacher';
            $appUser = app_user::where(['email' => $request->email , 'type' =>$type])->first();
            if($appUser)
            {
                if (is_null($appUser->parent_user) || empty($appUser->parent_user)) {
                    $appUser->parent_user = $id;
                    $appUser->save(); 
                }
            } 
        }

        $request->validate([
            'email' => [
                'required',
                'email:rfc,dns',
                function ($attribute, $value, $fail) use ($id, $appUser) {
                    // Check if $appUser is null, skip validation in u_logins if it is
                    if ($appUser) {
                        // Check email uniqueness in `u_logins`, excluding current user by ID
                        $existsInUlogins = DB::table('u_logins')
                            ->where('email', $value)
                            ->where('id', '!=', $appUser->id) // Exclude current user by ID
                            ->exists();
                        if ($existsInUlogins) {
                            $fail('The email has already been taken in App user.');
                        }

                        // Check email uniqueness in `admlogin` if app user exists
                        $existsInAdmlogin = DB::table('admlogin')
                            ->where('email', $value)
                            ->where('id', '!=', $id) // Exclude current admin user by ID
                            ->exists();

                        if ($existsInAdmlogin) {
                            $fail('The email has already been taken in admin logins.');
                        }
                    } else {
                        // If $appUser is null, only check email uniqueness in `admlogin`
                        $existsInAdmlogin = DB::table('admlogin')
                            ->where('email', $value)
                            ->where('id', '!=', $id) // Exclude current admin user by ID
                            ->exists();

                        if ($existsInAdmlogin) {
                            $fail('The email has already been taken in admin logins.');
                        }
                    }
                },
            ],
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'access_role' => 'required|integer',
            'active' => 'required|boolean',
        ]);
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            Flash::error('Admlogin not found');

            return redirect(route('admlogins.index'));
        }

        $input = $request->all();

        $role = $input["access_role"];

        $active = $input["active"];

        unset($input["active"]);

        unset($input["role"]);

        if($input["password"]) {
            $input["password"] =  Hash::make($input["password"]);
        } else {
            unset($input["password"]);
        }
        $admlogin = $this->admloginRepository->update($input, $id);
        $parent_user = $admlogin->id;
        $type = '';
        $Userid = '';
        $appUser = app_user::where('parent_user', $id)->first();
        if (!$appUser) { 
            if ($request->access_role == 2) {
                $type = 'publisher';
                $appuserLogin = $this->admloginRepository->CreateAppUser($input ,$type ,$parent_user);
            } elseif ($request->access_role == 3) {
                $type = 'teacher';
                $appuserLogin = $this->admloginRepository->CreateAppUser($input ,$type, $parent_user);
            }  else {
                $type = ''; // Handle other cases if needed
            }
        }
        else{
            $Userid = $appUser->id;
            if ($request->access_role == 2) {
                $type = 'publisher';
                    $Userid = $appUser->id;
                    $appuserLogin = $this->admloginRepository->UpdateAppUser($input ,$type ,$Userid);
            } elseif ($request->access_role == 3) {
                $type = 'teacher';
                $appuserLogin = $this->admloginRepository->UpdateAppUser($input ,$type ,$Userid);
            }  else {
                $type = ''; // Handle other cases if needed
            }
        }


        $nData = array();
        $nData["admin_id"] = $id;
        $nData["access_role"] = $role;
        $nData["active"] = $active;

        $accessData = $this->adminAccessRepository->get()->where('admin_id', $id)->first();

        $acsData = $this->adminAccessRepository->update($nData, $accessData["id"]);
        DB::table('teacherdetail')->where('email',$request->user_email)->update(['email' => $request->email, 'teacher_name' => $request->name]);
        DB::table('u_logins')->where('email',$request->user_email)->update(['email' => $request->email, 'name' => $request->name]);

        Flash::success('Admlogin updated successfully.');

        return redirect(route('admlogins.index'));
    }

    /**
     * Remove the specified admlogin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $admlogin = $this->admloginRepository->find($id);

        if (empty($admlogin)) {
            Flash::error('Admlogin not found');

            return redirect(route('admlogins.index'));
        }

        $this->admloginRepository->delete($id);

        Flash::success('Admlogin deleted successfully.');

        return redirect(route('admlogins.index'));
    }

     //show change password page
     public function changePasswod()
     {
         return view('admins.change-passwod');
     }
 
     // handle action of change password submit
     public function changePasswodAction(UpdateadmloginRequest $request)
     {   
         // Validate the input
         $validated = $request->validate([
             'current_password' => ['required'],
             'password_confirmation' => ['required','min:8'], // Adjust as needed
         ]);
         
         $user = Auth::user();
         
         // Check if the current password matches
         if (!Hash::check($validated['current_password'], $user->password)) {
             throw ValidationException::withMessages([
                 'current_password' => 'The provided password does not match our records.',
             ]);
         }
         $user->password = Hash::make($validated['password_confirmation']);
         $user->save();
 
         // Optionally log the user out after changing the password
         Auth::logout();
 
         // Redirect to login page with a success message
         return redirect('/login')->with('status', 'Password changed successfully. Please log in with your new password.');
   
     }
}
