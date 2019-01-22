<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('carts', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('user_id');
      $table->unsignedInteger('product_id');
      $table->unsignedInteger('amount_of_item')->default(1);
      $table->timestamps();

      $table->foreign('user_id')
            ->references('id')->on('users')
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
    // $table->dropForeign('wishlists_user_id_foreign');
    // $table->dropForeign('wishlists_product_id_foreign');
    Schema::dropIfExists('carts');
  }
}
