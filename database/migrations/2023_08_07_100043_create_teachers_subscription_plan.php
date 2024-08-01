<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersSubscriptionPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['name' => 'Teachers special plan', 'configuration_type' => '0', 'price' => '699', 'description' => 'Access to all material for 120 days', 'validity' => '120', 'status' => '1', 'plan_category' => '2', 'allowed_material' => '3,5,2,4', 'isFree' => '0'],
            
        ];

        DB::table('subscription_plans')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers_subscription_plan');
    }
}
