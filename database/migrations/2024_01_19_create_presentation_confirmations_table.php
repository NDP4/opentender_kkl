<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('presentation_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('announcement_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['confirmed', 'declined']);
            $table->timestamps();

            $table->unique(['user_id', 'announcement_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('presentation_confirmations');
    }
};
