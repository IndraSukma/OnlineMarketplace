<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->increments('id');            
            $table->unsignedBigInteger('order_id');
            $table->string('bank');
            $table->string('paid_by');
            $table->unsignedBigInteger('total_payment');
            $table->string('day_of_pay')->nullable();
            $table->string('month_of_pay')->nullable();
            $table->string('year_of_pay')->nullable();
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_orders');
    }
}
