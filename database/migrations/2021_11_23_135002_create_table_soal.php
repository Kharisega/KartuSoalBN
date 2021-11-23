<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->id('id_soal');
            $table->integer('no_soal');
            $table->string('soal');
            $table->string('pilgan_a');
            $table->string('pilgan_b');
            $table->string('pilgan_c');
            $table->string('pilgan_d');
            $table->string('pilgan_e');
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
        Schema::dropIfExists('table_soal');
    }
}
