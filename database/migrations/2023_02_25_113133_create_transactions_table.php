<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->string('subscription_name')->nullable();
            $table->integer('subscription_validity')->nullable();
            $table->string('status')->nullable();
            $table->text('response_body')->nullable();
            $table->integer('refund_amount')->nullable();
            $table->string('refund_status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
