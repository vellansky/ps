<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor', 100)->nullable();
            $table->foreignId('shop_id')->nullable()->constrained('shops');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->timestamps();
        });
    }

};
