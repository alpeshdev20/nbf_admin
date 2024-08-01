<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('tin')->nullable()->unique();
            $table->integer('country_id')->nullable();
            $table->string('state_code')->nullable();
        });

        $data = [
            [
                'name' => 'Andhra Pradesh',
                'tin'=>'37',
                'state_code' => 'AD',
                'country_id' => '99'
            ],[
                'name' => 'Arunachal Pradesh',
                'tin'=>'12',
                'state_code' => 'AR',
                'country_id' => '99'
            ],[
                'name' => 'Assam',
                'tin'=>'18',
                'state_code' => 'AS',
                'country_id' => '99'
            ],[
                'name' => 'Bihar',
                'tin'=>'10',
                'state_code' => 'BR',
                'country_id' => '99'
            ],[
                'name' => 'Chattisgarh',
                'tin'=>'22',
                'state_code' => 'CG',
                'country_id' => '99'
            ],[
                'name' => 'Delhi',
                'tin'=>'07',
                'state_code' => 'DL',
                'country_id' => '99'
            ],[
                'name' => 'Goa',
                'tin'=>'30',
                'state_code' => 'GA',
                'country_id' => '99'
            ],[
                'name' => 'Gujarat',
                'tin'=>'24',
                'state_code' => 'GJ',
                'country_id' => '99'
            ],[
                'name' => 'Haryana',
                'tin'=>'06',
                'state_code' => 'HR',
                'country_id' => '99'
            ],[
                'name' => 'Himachal Pradesh',
                'tin'=>'02',
                'state_code' => 'HP',
                'country_id' => '99'
            ],[
                'name' => 'Jammu and Kashmir',
                'tin'=>'01',
                'state_code' => 'JK',
                'country_id' => '99'
            ],[
                'name' => 'Jharkhand',
                'tin'=>'20',
                'state_code' => 'JH',
                'country_id' => '99'
            ],[
                'name' => 'Karnataka',
                'tin'=>'29',
                'state_code' => 'KA',
                'country_id' => '99'
            ],[
                'name' => 'Kerala',
                'tin'=>'32',
                'state_code' => 'KL',
                'country_id' => '99'
            ],[
                'name' => 'Lakshadweep Islands',
                'tin'=>'31',
                'state_code' => 'LD',
                'country_id' => '99'
            ],[
                'name' => 'Madhya Pradesh',
                'tin'=>'23',
                'state_code' => 'MP',
                'country_id' => '99'
            ],[
                'name' => 'Maharashtra',
                'tin'=>'27',
                'state_code' => 'MH',
                'country_id' => '99'
            ],[
                'name' => 'Manipur',
                'tin'=>'14',
                'state_code' => 'MN',
                'country_id' => '99'
            ],[
                'name' => 'Meghalaya',
                'tin'=>'17',
                'state_code' => 'ML',
                'country_id' => '99'
            ],[
                'name' => 'Mizoram',
                'tin'=>'15',
                'state_code' => 'MZ',
                'country_id' => '99'
            ],[
                'name' => 'Nagaland',
                'tin'=>'13',
                'state_code' => 'NL',
                'country_id' => '99'
            ],[
                'name' => 'Odisha',
                'tin'=>'21',
                'state_code' => 'OD',
                'country_id' => '99'
            ],[
                'name' => 'Pondicherry',
                'tin'=>'34',
                'state_code' => 'PY',
                'country_id' => '99'
            ],[
                'name' => 'Punjab',
                'tin'=>'03',
                'state_code' => 'PB',
                'country_id' => '99'
            ],[
                'name' => 'Rajasthan',
                'tin'=>'08',
                'state_code' => 'RJ',
                'country_id' => '99'
            ],[
                'name' => 'Sikkim',
                'tin'=>'11',
                'state_code' => 'SK',
                'country_id' => '99'
            ],[
                'name' => 'Tamil Nadu',
                'tin'=>'33',
                'state_code' => 'TN',
                'country_id' => '99'
            ],[
                'name' => 'Telangana',
                'tin'=>'36',
                'state_code' => 'TS',
                'country_id' => '99'
            ],[
                'name' => 'Tripura',
                'tin'=>'16',
                'state_code' => 'TR',
                'country_id' => '99'
            ],[
                'name' => 'Uttar Pradesh',
                'tin'=>'09',
                'state_code' => 'UP',
                'country_id' => '99'
            ],[
                'name' => 'Uttarakhand',
                'tin'=>'05',
                'state_code' => 'UK',
                'country_id' => '99'
            ],[
                'name' => 'West Bengal',
                'tin'=>'19',
                'state_code' => 'WB',
                'country_id' => '99'
            ],[
                'name' => 'Andaman and Nicobar Islands',
                'tin'=>'35',
                'state_code' => 'AN',
                'country_id' => '99'
            ],[
                'name' => 'Chandigarh',
                'tin'=>'04',
                'state_code' => 'CH',
                'country_id' => '99'
            ],[
                'name' => 'Dadra & Nagar Haveli and Daman & Diu',
                'tin'=>'26',
                'state_code' => 'DNHDD',
                'country_id' => '99'
            ],[
                'name' => 'Ladakh',
                'tin'=>'38',
                'state_code' => 'LA',
                'country_id' => '99'
            ],[
                'name' => 'Other Territory',
                'tin'=>'97',
                'state_code' => 'OT',
                'country_id' => '99'
            ]
        ];

        DB::table('state')->insert($data);
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