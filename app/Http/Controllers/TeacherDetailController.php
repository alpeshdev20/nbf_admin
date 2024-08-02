<?php

namespace App\Http\Controllers;

use App\DataTables\TeacherDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTeacherDetailRequest;
use App\Http\Requests\UpdateTeacherDetailRequest;
use App\Repositories\TeacherDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Imports\ImportAppTeachers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use DB;

class TeacherDetailController extends AppBaseController
{
    /** @var  TeacherDetailRepository */
    private $teacherDetailRepository;

    public function __construct(TeacherDetailRepository $teacherDetailRepo)
    {
        $this->teacherDetailRepository = $teacherDetailRepo;
    }

    public function uploadCsv(Request $request){
        $request->validate(['file'=>'required']);
        Excel::import(new ImportAppTeachers, $request->file('file'));
            
        return back();
    }

    /**
     * Display a listing of the TeacherDetail.
     *
     * @param TeacherDetailDataTable $teacherDetailDataTable
     * @return Response
     */
    public function index(TeacherDetailDataTable $teacherDetailDataTable)
    {
        return $teacherDetailDataTable->render('teacher_details.index');
    }

    /**
     * Show the form for creating a new TeacherDetail.
     *
     * @return Response
     */
    public function create()
    {
        $institutes = School::all();
        return view('teacher_details.create', compact('institutes'));
    }

    /**
     * Store a newly created TeacherDetail in storage.
     *
     * @param CreateTeacherDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateTeacherDetailRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'teacher_name' => 'required',
            'mobile_no' => 'required|unique:teacherdetail',
            'email' => 'required',
            'institute_id' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'subject_taught' => 'required',
            'resource_planning' => 'required',
            'teaching_resource' => 'required',
            'student_strength' => 'required',
            'number_of_token'  => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $input = $request->all();
        $Pass = $input['password'];
        $subject = 'Your NetbookFlix password';
        $message = '<p>Hello ' . $input['teacher_name']  . ', <br /><br /> Your account has been created successfully with the password.<br /><br />
        Password: ' . $Pass . '
        <br /><br />
        Regards, <br /> Netbookflix
        </p>';

        $insertedId = DB::table('admlogin')->insertGetId([
            'name' => $input['teacher_name'],
            'email' => $input['email'],
            'password' => Hash::make($Pass),
        ]);
        DB::table('admin_accesses')->insert([
            'access_role' => '3',
            'admin_id' => $insertedId,
            'active' => '1',
        ]);
        $frontID = DB::table('u_logins')->insertGetId([
            'name' => $input['teacher_name'],
            'email' =>  $input['email'],
            'password' =>  Hash::make($Pass),
            'mobile' =>  $input['mobile_no'],
            'registration_type' => '4',
            'school_id' => $input['institute_id'],
        ]);
        $teacher_plan = DB::table('subscription_plans')->where('validity',120)->first();
        $today = Carbon::today();
        $end_date = $today->addDays(120);
        DB::table('subscribers')->insert([
            'plan_name' => $teacher_plan->name,
            'plan_end_date' =>$end_date,
            'user_id' => $frontID,
            'subscription_id' =>$teacher_plan->id,
            'plan_category' =>$teacher_plan->plan_category,
            'configuration_type' =>$teacher_plan->configuration_type,
            'allowed_material' =>$teacher_plan->allowed_material,
        ]);
        $input['password'] = Hash::make($input['password']);
        $teacherDetail = $this->teacherDetailRepository->create($input);
        EmailHelper::sendEmail($input['email'], $subject, $message);
        Flash::success('Teacher Detail saved successfully and password sent to the registered email.');

        return redirect(route('teacherDetails.index'));
    }

    /**
     * Display the specified TeacherDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            Flash::error('Teacher Detail not found');

            return redirect(route('teacherDetails.index'));
        }

        return view('teacher_details.show')->with('teacherDetail', $teacherDetail);
    }

    /**
     * Show the form for editing the specified TeacherDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $institutes = School::all();
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            Flash::error('Teacher Detail not found');

            return redirect(route('teacherDetails.index'));
        }

        return view('teacher_details.edit', compact('institutes'))->with('teacherDetail', $teacherDetail);
    }

    /**
     * Update the specified TeacherDetail in storage.
     *
     * @param  int              $id
     * @param UpdateTeacherDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeacherDetailRequest $request)
    {
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            Flash::error('Teacher Detail not found');

            return redirect(route('teacherDetails.index'));
        }

        $teacherDetail = $this->teacherDetailRepository->update($request->all(), $id);

        Flash::success('Teacher Detail updated successfully.');

        return redirect(route('teacherDetails.index'));
    }

    /**
     * Remove the specified TeacherDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teacherDetail = $this->teacherDetailRepository->find($id);

        if (empty($teacherDetail)) {
            Flash::error('Teacher Detail not found');

            return redirect(route('teacherDetails.index'));
        }

        $this->teacherDetailRepository->delete($id);

        Flash::success('Teacher Detail deleted successfully.');

        return redirect(route('teacherDetails.index'));
    }

    public function downloadSampleCsv()
    {
        try {
            return response()->download(public_path('csv/teacher_details_sample.csv'), 'teacher_details_sample.csv');
        } catch(\Throwable $exception) {

        }
    }

    public function teacherReqApprove(Request $request) {
        $id = $request->id;
        $teacherDetail = $this->teacherDetailRepository->find($id);
        $inst_name = $teacherDetail->institute_name;
        $inst_name_normalized = preg_replace('/\s*/', '', strtolower($inst_name));
        
        $institutes = School::all()->pluck('name', 'id');
    
        $matchingInstituteId = null;
    
        foreach ($institutes as $i_id => $name) {
            $name_normalized = preg_replace('/\s*/', '', strtolower($name));
            if ($name_normalized === $inst_name_normalized) {
                $matchingInstituteId = $i_id;
                break; // Found a matching institute, no need to continue the loop
            }
        }

        if ($matchingInstituteId !== null) {
            // Update teacherdetail with the matching institute_id
            DB::table('teacherdetail')->where('id', $id)->update([
                'number_of_token' => $request->allowed_token,
                'institute_id' => $matchingInstituteId,
                'is_pending' => 0
            ]);
        } else {
            // Insert new school and get its ID
            $institute_id = DB::table('schools')->insertGetId([
                'name' => $inst_name
            ]);
    
            // Update teacherdetail with the new institute_id
            DB::table('teacherdetail')->where('id', $id)->update([
                'institute_id' => $institute_id,
                'number_of_token' => $request->allowed_token,
                'is_pending' => 0
            ]);
    
            $matchingInstituteId = $institute_id;
        }
    
        // Insert records for u_logins and admlogin
        $user_id = DB::table('u_logins')->insertGetId([
            'name' => $teacherDetail->teacher_name,
            'email' => $teacherDetail->email,
            'password' => $teacherDetail->password,
            'mobile' => $teacherDetail->mobile_no,
            'registration_type' => 4,
            'school_id' => $matchingInstituteId,
        ]);
        
        $adm_id = DB::table('admlogin')->insertGetId([
            'name' => $teacherDetail->teacher_name,
            'email' => $teacherDetail->email,
            'password' => $teacherDetail->password,
        ]);

        DB::table('admin_accesses')->insert([
            'access_role' => 3,
            'admin_id' => $adm_id,
            'active' => 1,
        ]);

        $teacher_plan = DB::table('subscription_plans')->where('validity',120)->first();
        $today = Carbon::today();
        $end_date = $today->addDays(120);
        DB::table('subscribers')->insert([
            'plan_name' => $teacher_plan->name,
            'plan_end_date' =>$end_date,
            'user_id' => $user_id,
            'subscription_id' =>$teacher_plan->id,
            'plan_category' =>$teacher_plan->plan_category,
            'configuration_type' =>$teacher_plan->configuration_type,
            'allowed_material' =>$teacher_plan->allowed_material,
        ]);
        $subject = 'Your Netbookflix account approved.';
        $message = '<p>Hello ' . $teacherDetail->teacher_name  . ', <br /><br /> Your Netbookflix account request has been approved and account created successfully.<br /><br />
        <br /><br />
        Regards, <br /> Netbookflix
        </p>';
        EmailHelper::sendEmail($teacherDetail->email,$subject,$message);

        return redirect(route('teacherDetails.index'));
    }

    public function getTokenModal($id)
    {
        return view('teacher_details.required_token',compact('id'));
    }
    
}
