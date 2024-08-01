<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPrescribedReadingLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescribed_reading_lists', function (Blueprint $table) {
            $table->string('publisher_id')->nullable();
            $table->string('teacher_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescribed_reading_lists', function (Blueprint $table) {
            //
        });
    }
}
