<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeachersDataIntoAdminlogin extends Migration
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
            $insertedId = DB::table('admlogin')->insertGetId([
                'name' => $data->teacher_name,
                'email' => $data->email,
                'password' => Hash::make($customPass),
            ]);
            DB::table('admin_accesses')->insert([
                'access_role' => '3',
                'admin_id' => $insertedId,
                'active' => '1',
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
        //
    }
}
