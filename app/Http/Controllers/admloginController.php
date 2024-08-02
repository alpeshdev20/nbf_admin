<?php

namespace App\Http\Controllers;

use App\DataTables\admloginDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateadmloginRequest;
use App\Http\Requests\UpdateadmloginRequest;
use App\Repositories\admloginRepository;
use App\Repositories\admin_accessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\access_role;
use Response;
use Hash;
use Auth;
use DB;
use App\User;

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
        $input = $request->all();

        $role = $input["access_role"];

        $active = $input["active"];

        unset($input["active"]);

        unset($input["role"]);

        $input["password"] =  Hash::make($input["password"]);

        $admlogin = $this->admloginRepository->create($input);

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
}
