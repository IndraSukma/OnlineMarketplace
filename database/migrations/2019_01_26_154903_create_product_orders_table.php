<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('product_orders', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedBigInteger('order_id');
      $table->unsignedInteger('product_id');
      $table->unsignedInteger('quantity');
      $table->unsignedInteger('single_price');
      $table->timestamps();

      $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');

      $table->foreign('product_id')
            ->references('id')->on('products')
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
    Schema::dropIfExists('product_orders');
  }
}
