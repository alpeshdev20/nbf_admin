<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveInstituteNameFormTeacherToSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('pin')->nullable()->change();
   
        });

        $sourceData = DB::table('teacherdetail')->get();
        foreach ($sourceData as $data) {
            DB::table('schools')->updateOrInsert([
                'name' => $data->institute_name,
            ]);
        }
        Schema::table('teacherdetail', function (Blueprint $table) {
            $table->unsignedBigInteger('institute_id')->nullable();
        });
        $sourceInst = DB::table('schools')->get();
        foreach ($sourceInst as $inst) {
            DB::table('teacherdetail')
                ->where('institute_name', $inst->name)
                ->update(['institute_id' => $inst->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school', function (Blueprint $table) {
            //
        });
    }
}
