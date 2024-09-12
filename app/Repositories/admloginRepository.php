<?php

namespace App\Repositories;

use App\Models\admlogin;
use App\Models\app_user;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

/**
 * Class admloginRepository
 * @package App\Repositories
 * @version January 23, 2020, 6:23 am UTC
*/

class admloginRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'type',
        'parent_user',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return admlogin::class;
    }

    // Function to store data in both admlogin and app_user tables
    public function CreateAppUser($admloginData,$type ,$parent_user)
    {
        DB::beginTransaction();
        try {
            
            $admloginData['parent_user'] = $parent_user;
            $admloginData['type'] = $type;   
            // Store data in app_user table
            $appUser = app_user::create($admloginData);
          
            $UserId =$appUser->id;
            $plan = DB::table('subscription_plans')
            ->where('name', 'publishers-teachers')
            ->select('*') // or specify the columns you need
            ->first(); 
            // Accessing the plan details
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
            } else {
                // do nothing as of now
                
            }

            //assign plan to the publishers-teachers
           $subdvibet = DB::table('subscribers')->insert([
                'plan_name' => $planName,
                'plan_end_date' =>$endDate,
                'user_id' => $appUser->id,
                'subscription_id' =>$plan->id,
                'plan_category' =>$plan->plan_category,
                'configuration_type' =>$plan->configuration_type,
                'allowed_material' =>$plan->allowed_material,
                'created_at' => Carbon::now(),
            ]);
            
            DB::commit();
            return [ 'app_user' => $appUser];
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function UpdateAppUser($admloginData,$type,$Userid)
    {
        DB::beginTransaction();
    try {
            // Add the 'type' to the data
            $admloginData['type'] = $type;

            // Find the user by ID and update their details
            $appUser = app_user::find($Userid);
            if (!$appUser) {
                throw new \Exception('User not found');
            }

            $appUser->update($admloginData);

            // Access subscription plan details
            $plan = DB::table('subscription_plans')
                ->where('name', 'publishers-teachers')
                ->first();

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
                        ->first();
        
                    if ($subscription) {
                        // If subscription exists, update it
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
                            ]);
                    } else {
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

                DB::commit();
                return ['app_user' => $appUser];

    } catch (\Exception $e) {
        DB::rollback();
        throw $e;
    }
    }
}
