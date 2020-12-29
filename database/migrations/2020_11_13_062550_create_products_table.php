<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->text('title');
      $table->text('slug')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->foreignId('category_id')->constrained()->onDelete('cascade');
      $table->tinyInteger('show_in_main')->default(0);
      $table->text('manufacturer')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('products');
  }
}
