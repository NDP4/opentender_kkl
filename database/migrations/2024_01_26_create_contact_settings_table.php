<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });

        // Insert default values
        DB::table('contact_settings')->insert([
            'email' => 'kkl@dinus.ac.id',
            'phone' => '(024) 3517261',
            'address' => 'Jl. Imam Bonjol No.207, Semarang',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('contact_settings');
    }
};
