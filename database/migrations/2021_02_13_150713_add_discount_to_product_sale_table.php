<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            $table->boolean('is_percentage');
            $table->float('discount_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            $table->dropColumn('is_percentage');
            $table->dropColumn('discount_value');
        });
    }
}
