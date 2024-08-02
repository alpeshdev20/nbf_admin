<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                // Drop the subscription_plans table if it exists
        DB::statement('DROP TABLE IF EXISTS subscription_plans');

        // Path to your SQL file
       $path = database_path('subscription_plans_stage.sql');
        
        // Read the SQL file content
        $sql = File::get($path);
        
        // Execute the SQL content
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TABLE IF EXISTS subscription_plans');
    }
}
