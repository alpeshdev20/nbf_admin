<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInBookgenereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookgenres', function (Blueprint $table) {
            if(!Schema::hasColumn('bookgenres', 'department_id')) {
                $table->string('department_id')->nullable()->after('genre_id');
            }
            if(!Schema::hasColumn('bookgenres', 'subject_id')) {
                $table->string('subject_id')->nullable()->after('department_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookgenres', function (Blueprint $table) {
            $table->dropColumn('subject_id');
            $table->dropColumn('department_id');
        });
    }
}
