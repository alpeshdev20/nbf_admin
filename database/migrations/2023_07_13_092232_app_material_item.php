<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppMaterialItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_material_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appmaterial_id');
            $table->string('sequence')->nullable();
            $table->string('title')->nullable();
            $table->string('summary')->nullable();
            $table->string('length')->nullable();
            $table->string('image_file');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_material_item');
    }
}
