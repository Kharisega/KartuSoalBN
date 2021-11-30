<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKartuSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_soal', function (Blueprint $table) {
            $table->id('id_kartu');
            $table->integer('id_soal');
            $table->integer('kd_pengetahuan');
            $table->integer('kd_keterampilan');
            $table->string('materi');
            $table->string('nama_mapel');
            $table->string('indikator_soal');
            $table->string('jenis_soal');
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
        Schema::dropIfExists('table_kartu_soal');
    }
}
