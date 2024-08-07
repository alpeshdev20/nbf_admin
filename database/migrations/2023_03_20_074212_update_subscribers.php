<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSubscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('plan_category')->nullable();
            $table->string('configuration_type')->nullable();
            $table->string('allowed_material')->nullable();
            $table->string('allowed_genres')->nullable();
            $table->string('allowed_department')->nullable();
            $table->string('allowed_subject')->nullable();
            $table->string('allowed_publisher')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('plan_category')->nullable();
            $table->dropColumn('configuration_type');
            $table->dropColumn('allowed_material');
            $table->dropColumn('allowed_genres');
            $table->dropColumn('allowed_department');
            $table->dropColumn('allowed_subject');
            $table->dropColumn('allowed_publisher');
        });
    }
}
