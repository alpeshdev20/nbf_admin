<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInBooksTable extends Migration
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
            $table->text('table_of_content')->nullable()->change();
            $table->text('author_detail')->nullable()->change();
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
            $table->string('table_of_content')->nullable()->change();
            $table->string('author_detail')->nullable()->change();
        });
    }
}
