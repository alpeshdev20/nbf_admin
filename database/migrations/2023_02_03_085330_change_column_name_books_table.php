<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnNameBooksTable extends Migration
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
        Schema::table('books', function (Blueprint $table) {
            $table->renameColumn('allow_country','allow_region');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->renameColumn('allow_region','allow_country');
        });
    }
}
