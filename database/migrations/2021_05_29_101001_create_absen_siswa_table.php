<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('absen_id')->unsigned();
            $table->bigInteger('siswa_id')->unsigned();
            $table->enum('status', ['hadir', 'alpa', 'izin', 'sakit']);
            $table->timestamps();

            $table->foreign('absen_id')
                    ->references('id')
                    ->on('absen')
                    ->onDelete('cascade');

            $table->foreign('siswa_id')
                    ->references('id')
                    ->on('siswa')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_siswa');
    }
}
