<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addresses', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('user_id');
      $table->string('full_name');
      $table->string('address_name');
      $table->string('complete_address');
      $table->string('provence');
      $table->string('city');
      $table->string('sub_district');
      $table->string('additional_info')->nullable();
      $table->string('phone');
      $table->timestamps();

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
    // $table->dropForeign('adresses_user_id_foreign');
    Schema::dropIfExists('addresses');
  }
}
