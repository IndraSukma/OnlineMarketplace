<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddZipCodeToAddresses extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('addresses', function (Blueprint $table) {
      $table->string('zip_code')->after('sub_district');
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
      $table->dropColumn('zip_code');
    });
  }
}