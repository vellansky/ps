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
        Schema::create('visitor_data_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_session')->nullable()->constrained('visitor_session', 'session_id');
            $table->string('previous_url', 100)->nullable();
            $table->string('next_url', 100)->nullable();
            $table->ipAddress('ip_address')->nullable();
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
        Schema::dropIfExists('visitor_data_session');
    }
};
