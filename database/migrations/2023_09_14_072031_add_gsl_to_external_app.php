<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGslToExternalApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [   'name' => 'GSL', 
                'url' => 'https://www.getsetlearn.info/',
                'public_key' => 'IHytJREdivop6hhXtc2N3EElb7UlIkU5DeaJgmmij2P8MXhLyi6AnP0OcfAXovzY',
                'private_key' => '01792f74-a3a8-4557-b264-c46b1196f04d'
            ]
        ];

        DB::table('external_apps')->insert($data);
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
