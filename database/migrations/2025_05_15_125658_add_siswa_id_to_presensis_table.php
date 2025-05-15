<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiswaIdToPresensisTable extends Migration
{
    public function up()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id')->after('id');

            // Tambahkan foreign key constraint agar lebih aman
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });
    }
}
