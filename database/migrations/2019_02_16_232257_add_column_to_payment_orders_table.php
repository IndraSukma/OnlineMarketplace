<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPaymentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_orders', function (Blueprint $table) {
          $table->foreign('order_id')
          ->references('id')->on('orders')
          ->onDelete('cascade');

          $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('payment_orders', function (Blueprint $table) {
            $table->dropForeign('payment_orders_order_id_foreign');
            $table->dropForeign('payment_orders_user_id_foreign');
        });
    }
}
