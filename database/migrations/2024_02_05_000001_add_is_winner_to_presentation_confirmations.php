<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('presentation_confirmations', function (Blueprint $table) {
            $table->boolean('is_winner')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('presentation_confirmations', function (Blueprint $table) {
            $table->dropColumn('is_winner');
        });
    }
};
