<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->text('title');
      $table->text('slug');
      $table->timestamps();
      $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('image_id')->constrained()->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('categories');
  }
}
