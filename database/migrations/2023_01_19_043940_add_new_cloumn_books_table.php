<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCloumnBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->string('allow_country')->default("1");
            $table->string('table_of_content')->nullable();
            $table->string('author_detail')->nullable();
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
            $table->dropColumn('age');
            $table->dropColumn('allow_country');
            $table->dropColumn('table_of_content');
            $table->dropColumn('author_detail');
        });
    }
}
