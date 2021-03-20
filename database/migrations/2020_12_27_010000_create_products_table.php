<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('short_description');
            $table->text('long_description');
            $table->float('price');
            // $table->string('thumbnail');
            $table->json('image');
            $table->json('spec')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
            // $table->foreignId('stock_id')->constrained();
            // $table->unsignedBigInteger('id_category');
            // $table->unsignedBigInteger('id_brand');
            // $table->unsignedBigInteger('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
