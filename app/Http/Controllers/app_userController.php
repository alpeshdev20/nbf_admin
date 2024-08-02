<?php

namespace App\Http\Controllers;

use App\DataTables\app_userDataTable;
use App\Http\Requests;
use App\Http\Requests\Createapp_userRequest;
use App\Http\Requests\Updateapp_userRequest;
use App\Repositories\app_userRepository;
use Illuminate\Http\Request;
use Flash;
use DB;
use App\Http\Controllers\AppBaseController;
use Response;

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
        return view('app_users.create');
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
        $input = $request->all();

        $appUser = $this->appUserRepository->create($input);

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

        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }

        return view('app_users.edit')->with('appUser', $appUser);
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
        $appUser = $this->appUserRepository->find($id);

        if (empty($appUser)) {
            Flash::error('App User not found');

            return redirect(route('appUsers.index'));
        }

        $appUser = $this->appUserRepository->update($request->all(), $id);
        DB::table('teacherdetail')->where('email',$request->user_email)->update(['email' => $request->email, 'mobile_no' => $request->mobile, 'teacher_name' => $request->name]);
        DB::table('admlogin')->where('email',$request->user_email)->update(['email' => $request->email, 'name' => $request->name]);

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
