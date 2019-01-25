<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseCategoryToProductCategories extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('product_categories', function (Blueprint $table) {
      $table->string('base_category')->after('name');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('product_categories', function (Blueprint $table) {
      $table->dropColumn('base_category');
    });
  }
}
