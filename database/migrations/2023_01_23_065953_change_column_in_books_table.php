<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeColumnInBooksTable extends Migration
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
            $table->integer('age')->default(0)->change();
        });

        DB::table('books')->where('age',null)->update(['age'=>0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('age')->default(null)->change();
        });
    }
}
