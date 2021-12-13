<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaanOtobusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan_otobus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->integer('id_kota')->nullable();
            $table->integer('id_kendaraan')->nullable();
            $table->string('kode_po',100)->nullable();
            $table->string('nama_po',150)->nullable();
            $table->string('no_izin',170)->nullable();
            $table->string('tgl_kadaluarsa',50)->nullable();
            $table->string('tipe',100)->nullable();
            $table->string('no_telp',15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos',50)->nullable();
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
        Schema::dropIfExists('perusahaan_otobus');
    }
}
