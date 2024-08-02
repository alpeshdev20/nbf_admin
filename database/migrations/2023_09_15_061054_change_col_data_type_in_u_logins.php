<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColDataTypeInULogins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

public function __construct()
{
    DB::getDoctrineConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
}

    public function up()
    {
        Schema::table('u_logins', function (Blueprint $table) {
            $table->text('request_payload')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_logins', function (Blueprint $table) {
            //
        });
    }
}
