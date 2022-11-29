<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('visitor_session', function (Blueprint $table) {
            $table->bigIncrements('session_id');
            $table->foreignId('visitor_id')->nullable()->constrained('visitors');
            $table->timestamps();
        });
    }

};
