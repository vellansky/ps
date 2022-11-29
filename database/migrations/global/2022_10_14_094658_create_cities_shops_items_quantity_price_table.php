<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_shops_items_quantity_price', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('shop_id')->constrained('shops');
            $table->foreignId('product_id')->constrained('products');
            $table->Integer('quantity')->nullable();
            $table->foreignId('price_id')->nullable()->constrained('product_price');
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
        Schema::dropIfExists('cities_shops_items_quantity_price');
    }
};
