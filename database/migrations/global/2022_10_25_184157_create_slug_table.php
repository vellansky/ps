<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('slug', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('essence_id');
            $table->string('essence_type');
        });
    }
    public function down()
    {
        Schema::dropIfExists('slug');
    }
};
