<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDipassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dipass', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->string('kode_terminal',100)->nullable();
            $table->string('kode_booking',100)->nullable();
            $table->string('nama_penumpang',100)->nullable();
            $table->string('nomor_identitas',100)->nullable();
            $table->string('waktu_pembelian',100)->nullable();
            $table->string('terminal_asal',150)->nullable();
            $table->string('terminal_tujuan',150)->nullable();
            $table->string('jam_berangkat',50)->nullable();
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
        Schema::dropIfExists('dipass');
    }
}
