<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkAndSoftDeletesToAppAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_ads', function (Blueprint $table) {
             // Add a new column for the link
             $table->string('link')->nullable();

             // Add soft delete column
             $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_ads', function (Blueprint $table) {
            // Remove the link column
            $table->dropColumn('link');

            // Remove soft delete column
            $table->dropSoftDeletes();
        });
    }
}
