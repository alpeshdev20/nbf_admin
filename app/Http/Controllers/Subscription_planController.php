<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\genre;
use App\Models\material;
use App\Models\app_subject;
use Illuminate\Support\Str;
use App\Models\app_material;
use App\Models\app_department;
use App\Models\book_publisher;
use App\Models\Subscription_plan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Subscription_planDataTable;
use App\Repositories\Subscription_planRepository;
use App\Http\Requests\CreateSubscription_planRequest;
use App\Http\Requests\UpdateSubscription_planRequest;

error_reporting(E_ERROR);

class Subscription_planController extends AppBaseController
{
    /** @var  Subscription_planRepository */
    public function __construct(Subscription_planRepository $subscriptionPlanRepo)
    {
        $this->subscriptionPlanRepository = $subscriptionPlanRepo;
    }

    /**
     * Display a listing of the Subscription_plan.
     *
     * @param Subscription_planDataTable $subscriptionPlanDataTable
     * @return Response
     */
    public function index(Subscription_planDataTable $subscriptionPlanDataTable)
    {
        return $subscriptionPlanDataTable->render('subscription_plans.index');
    }

    /**
     * Show the form for creating a new Subscription_plan.
     *
     * @return Response
     */
    public function create()
    {
    
        $category = app_material::getMaterialCategories();        
        $configuration = Subscription_plan::getConfigurationType();
        $mdata = material::all();
        $genre = genre::all();
        $pubdata = book_publisher::all();
        $plan_paren_categories = DB::table('plan_parent_category')
        ->select('id', 'name') // Assuming you have 'id' and 'name' columns
        ->pluck('name', 'id'); 
        $subscriptionPlan = [];
        $selectedmdata = [];
        $selectedgenre = [];
        $selecteddept = [];
        $getsub = [];
        $getdept = [];
        $selectedpublisher = [];
        $validity = '';
        $isFree = '';
        //  foreach (array_values($category) as $i => $value) {
        //     echo "$i";
        //   }
        return view('subscription_plans.create',compact('category','isFree','validity','getsub','selectedpublisher','getdept','selecteddept','selectedmdata','selectedgenre','configuration','mdata','genre','pubdata','subscriptionPlan' ,'plan_paren_categories'));
    }

    /**
     * Store a newly created Subscription_plan in storage.
     *
     * @param CreateSubscription_planRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscription_planRequest $request)
    {
        $validator = $this->validate($request,[
            'price' => 'required',
            'allowed_material' => 'required_if:configuration_type,==,0',
            'allowed_genres' => 'required_if:configuration_type,==,1',
            'allowed_department' => 'required_if:configuration_type,==,1',
            'allowed_subject' => 'required_if:configuration_type,==,1',
            'allowed_publisher' => 'required_if:configuration_type,==,1',
            'validity' => 'required',
        ],
        [
          'allowed_material.required_if' => 'Allowed material is required', 
          'allowed_genres.required_if' => "Genre is required", 
          'allowed_department.required_if' => "Department is required", 
          'allowed_subject.required_if' => "Subject is required", 
          'allowed_publisher.required_if' => "Publisher is required",
        ]
    );
        // Get the description from the request
    $description = $request->input('description');

    // Split the description into individual options by commas
    $options = explode(',', $description);

    // Trim and ensure each option ends with a comma
    $updatedOptions = array_map(function($option, $key) use ($options) {
        // Append ',,' to every option except the last one
        return trim($option) . ($key === array_key_last($options) ? '' : ',,');
    }, $options, array_keys($options));

    // Join the updated options back into a single string
    $updatedDescription = implode(' ', $updatedOptions);
    

    // Now you can store the updated description in your database or use it as needed
    $request->merge(['description' => $updatedDescription]);
        $input = $request->all();
        $input['content_key']  = strtoupper(Str::random(6));
        if($input['configuration_type'] == 0)
        {
            $input['allowed_material'] = implode(',',$request['allowed_material']);
        }
        else {
            
            $input['allowed_publisher'] = implode(',',$request['allowed_publisher']);
            $input['allowed_genres'] = implode(',',$request['allowed_genres']);
            $input['allowed_department'] = implode(',',$request['allowed_department']);
            $input['allowed_subject'] = implode(',',$request['allowed_subject']);
        }
        // $input['plan_parent_category_id'] = $request->input('plan_paren_categories', 0); 

        $subscriptionPlan = $this->subscriptionPlanRepository->create($input);

        Flash::success('Subscription Plan saved successfully.');

        return redirect(route('subscriptionPlans.index'));
    }

    /**
     * Display the specified Subscription_plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);
        if (empty($subscriptionPlan)) {
            Flash::error('Subscription Plan not found');

            return redirect(route('subscriptionPlans.index'));
        }

        return view('subscription_plans.show',compact('subscriptionPlan'));
    }

    /**
     * Show the form for editing the specified Subscription_plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $category = app_material::getMaterialCategories($id == '1');
        $configuration = Subscription_plan::getConfigurationType();
        $mdata = material::all();
        $genre = genre::all();
        $gdata = $genre->toArray();
        $pubdata = book_publisher::all();
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);
        $isFree = $subscriptionPlan->isFree;
        $selectedmdata = explode(',',$subscriptionPlan->allowed_material);
        $selectedgenre = explode(',',$subscriptionPlan->allowed_genres);
        $selecteddept = explode(',',$subscriptionPlan->allowed_department);
        $selectedsub = explode(',',$subscriptionPlan->allowed_subject);
        $selectedpublisher = explode(',',$subscriptionPlan->allowed_publisher);
        $validity = $subscriptionPlan->validity;
        $getdept = app_department::whereIn('genre_id',$selectedgenre)->get();
        $getsub = app_subject::whereIn('department_id',$selecteddept)->get();
        $selected_parent_plan_category = $subscriptionPlan->plan_parent_category_id;
        $plan_paren_categories = DB::table('plan_parent_category')
        ->select('id', 'name') // Assuming you have 'id' and 'name' columns
        ->pluck('name', 'id');
        if (empty($subscriptionPlan)) {
            Flash::error('Subscription Plan not found');

            return redirect(route('subscriptionPlans.index'));
        }
        return view('subscription_plans.edit',compact('subscriptionPlan','isFree','validity','selectedpublisher','getsub','getdept','selecteddept','selectedsub','category','mdata','configuration','selectedgenre','selectedmdata','genre','pubdata' , 'plan_paren_categories' ,'selected_parent_plan_category','description'));
    }

    /**
     * Update the specified Subscription_plan in storage.
     *
     * @param  int              $id
     * @param UpdateSubscription_planRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscription_planRequest $request)
    {
        if($request->plan_category != 0) {
                $validator = $this->validate($request,[
                    'price' => 'required',
                    'allowed_material' => 'required_if:configuration_type,==,0',
                    'allowed_genres' => 'required_if:configuration_type,==,1',
                    'allowed_department' => 'required_if:configuration_type,==,1',
                    'allowed_subject' => 'required_if:configuration_type,==,1',
                    'allowed_publisher' => 'required_if:configuration_type,==,1',
                    'validity' => 'required',
                ],
                [
                'allowed_material.required_if' => 'Allowed material is required', 
                'allowed_genres.required_if' => "Genre is required", 
                'allowed_department.required_if' => "Department is required", 
                'allowed_subject.required_if' => "Subject is required", 
                'allowed_publisher.required_if' => "Publisher is required",
                ]
            );
        }

        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);

        if (empty($subscriptionPlan)) {
            Flash::error('Subscription Plan not found');

            return redirect(route('subscriptionPlans.index'));
        }
        // Get the description from the request
        $description = $request->input('description');

        // Split the description into individual options by commas
        $options = explode(',', $description);

        // Trim and ensure each option ends with a comma
        $updatedOptions = array_map(function($option, $key) use ($options) {
             // Append ',,' to every option except the last one
             return trim($option) . ($key === array_key_last($options) ? '' : ',,');
        }, $options, array_keys($options));
     
        // Join the updated options back into a single string
        $updatedDescription = implode(' ', $updatedOptions);   
        // Now you can store the updated description in your database or use it as needed
        $request->merge(['description' => $updatedDescription]);
        $input = $request->all();
        if($input['configuration_type'] == 0)
        {
            $input['allowed_material'] ? $input['allowed_material'] = implode(',',$request['allowed_material']) : '';
        }
        else 
        {
            $input['allowed_publisher'] = implode(',',$request['allowed_publisher']);
            $input['allowed_genres'] = implode(',',$request['allowed_genres']);
            $input['allowed_department'] = implode(',',$request['allowed_department']);
            $input['allowed_subject'] = implode(',',$request['allowed_subject']);
        }      
        $subscriptionPlan = $this->subscriptionPlanRepository->update($input, $id);

        Flash::success('Subscription Plan updated successfully.');

        return redirect(route('subscriptionPlans.index'));
    }

    /**
     * Remove the specified Subscription_plan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscriptionPlan = $this->subscriptionPlanRepository->find($id);

        if (empty($subscriptionPlan)) {
            Flash::error('Subscription Plan not found');

            return redirect(route('subscriptionPlans.index'));
        }

        $this->subscriptionPlanRepository->delete($id);

        Flash::success('Subscription Plan deleted successfully.');

        return redirect(route('subscriptionPlans.index'));
    }

    public function add_subscriptionPlans()
    {
        // one time store a records using this function.
        $data = DB::table('subscription_plans')->where('name','Free Plan')->first();

        if($data)
        {
            return "Data is already added.";
        }else{

            DB::table('subscription_plans')->insert(
                array(
                    'name' => 'Free Plan',
                    'price' => 0,
                    'description' => 'Access to Unlimited Videos & Audio along with Books & Class Notes for 7 day',
                    'validity' => 7,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            );
            return "Data Added sucessfully";
        }
    }
}
