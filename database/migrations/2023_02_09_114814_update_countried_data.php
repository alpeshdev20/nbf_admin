<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class UpdateCountriedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('countries')->where('id',46)->update(['name'=>'COCOS (KEELING) ISLANDS','nicename'=> 'Cocos (Keeling) Islands']);

        DB::table('countries')->where('id',69)->update(['name'=>'FALKLAND ISLANDS (MALVINAS)','nicename'=> 'Falkland Islands (Malvinas)']);

        DB::table('countries')->where('id',94)->update(['name'=>'HOLY SEE (VATICAN CITY STATE)','nicename'=> 'Holy See (Vatican City State)']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
