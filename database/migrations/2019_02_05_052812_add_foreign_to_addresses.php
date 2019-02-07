<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
          $table->foreign('province_id')
          ->references('id')->on('provinces')
          ->onDelete('cascade');

          $table->foreign('city_id')
          ->references('id')->on('cities')
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
        Schema::table('addresses', function (Blueprint $table) {
          $table->dropForeign('addresses_province_id_foreign');
          $table->dropForeign('addresses_city_id_foreign');
        });
    }
}
