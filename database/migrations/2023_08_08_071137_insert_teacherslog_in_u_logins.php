<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertTeacherslogInULogins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sourceData = DB::table('teacherdetail')->get();
        $customPass = 'admin123';
        foreach ($sourceData as $data) {
            $insertedId = DB::table('u_logins')->insertGetId([
                'name' => $data->teacher_name,
                'email' => $data->email,
                'password' => Hash::make($customPass),
                'mobile' => $data->mobile_no,
                'registration_type' => '4',
                'school_id' => $data->institute_id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_logins', function (Blueprint $table) {
        });
    }
}
