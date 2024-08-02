<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->text('materialupload_id');
            $table->text('cover');
            $table->text('file');
            $table->text('title');
            $table->text('author_name');
            $table->text('publisher_name');
            $table->text('publication_year');
            $table->text('genre');
            $table->text('subgenre');
            $table->text('language');
            $table->text('length');
            $table->text('isbn_code');
            $table->text('summary');
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
        Schema::drop('book');
    }
}
