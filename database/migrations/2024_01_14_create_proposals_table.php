<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_biro');
            $table->string('email_biro');
            $table->string('nomor_telepon');
            $table->text('alamat_kantor');
            $table->string('nomor_npwp');
            $table->enum('informasi_kkl', ['sosial_media', 'rekanan', 'mahasiswa', 'lainnya']);
            $table->string('detail_informasi');
            $table->enum('status', ['draft', 'submitted', 'reviewing', 'accepted', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposals');
    }
};