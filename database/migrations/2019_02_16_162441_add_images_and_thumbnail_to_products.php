<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesAndThumbnailToProducts extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('products', function (Blueprint $table) {
      $table->string('images')->nullable()->after('weight');
      $table->string('thumbnail')->nullable()->after('images');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('products', function (Blueprint $table) {
      $table->dropColumn('images');
      $table->dropColumn('thumbnail');
    });
  }
}
