<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained('visitors');
            $table->foreignId('visitorSession_id')->constrained('visitor_session', 'session_id');


            $table->integer('quantity')->nullable();
            $table->foreignId('status')->constrained('order_status_data');

            $table->foreignId('product_id')->constrained('cities_shops_items_quantity_price');
            $table->foreignId('price_id')->constrained('product_price');

            $table->softDeletes();
            $table->timestamps();
        });
    }

};
