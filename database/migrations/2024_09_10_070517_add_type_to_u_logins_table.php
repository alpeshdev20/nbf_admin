<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToULoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_logins', function (Blueprint $table) {
            // Add the 'type' column
            $table->string('type')->nullable()->after('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_logins', function (Blueprint $table) {
            // Drop the 'type' column if the migration is rolled back
            $table->dropColumn('type');
        });
    }
}
