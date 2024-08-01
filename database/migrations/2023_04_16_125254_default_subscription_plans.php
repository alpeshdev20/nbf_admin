<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DefaultSubscriptionPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('subscription_plans')->truncate();

        $data = [
            ['name' => 'FREE PLAN', 'configuration_type' => '0', 'price' => '0', 'description' => 'Access to free material', 'validity' => '7', 'status' => '1', 'plan_category' => '0', 'allowed_material' => '3,5', 'isFree' => '1'],
            ['name' => 'SPECIAL PLAN (English Dept)', 'configuration_type' => '1',  'price' => '199', 'description' => 'Access to Macmillan Anthologies along with entire collection of English Literature & Linguistics Books & Audios', 'validity' => '365', 'status' => '1', 'plan_category' => '', 'allowed_material' => '', 'isFree' => '0'],
            ['name' => 'BOOK PLUS Annual Package', 'configuration_type' => '0', 'price' => '5999', 'description' => 'Access to Unlimited Videos & Audio along with Books & Class Notes', 'validity' => '365', 'status' => '1', 'isFree' => '0', 'plan_category' => '2', 'allowed_material' => '2,3,4,5', 'isFree' => '0'],
            ['name' => 'BOOK PLUS Monthly Package', 'configuration_type' => '0', 'price' => '699', 'description' => 'Access to Unlimited Videos & Audio along with Books & Class Notes', 'validity' => '30', 'status' => '1', 'isFree' => '0', 'plan_category' => '2', 'allowed_material' => '2,3,4,5', 'isFree' => '0'],
            ['name' => 'BOOK ONLY Yearly Plan', 'configuration_type' => '0', 'price' => '2500', 'description' => 'Access to Unlimited E-books and Class Notes for a duration of 365 days.', 'validity' => '365', 'status' => '1', 'isFree' => '0', 'plan_category' => '1', 'allowed_material' => '3,5', 'isFree' => '0'],
            ['name' => 'BOOK ONLY Monthly Plan', 'configuration_type' => '0', 'price' => '399', 'description' => 'Access to Unlimited E-books and Class Notes', 'validity' => '30', 'status' => '1', 'isFree' => '0', 'plan_category' => '1', 'allowed_material' => '3,5', 'isFree' => '0']

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
        //
    }
}
