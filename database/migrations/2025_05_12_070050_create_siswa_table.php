<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique(); // Nomor Induk Siswa
            $table->string('kelas');
            $table->string('jurusan');
            $table->unsignedBigInteger('id_ortu')->nullable(); // relasi ke tabel ortu
            $table->timestamps();

            $table->foreign('id_ortu')->references('id')->on('ortu')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
