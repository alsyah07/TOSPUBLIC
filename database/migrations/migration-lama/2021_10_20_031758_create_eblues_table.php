<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eblue', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik',150)->nullable();
            $table->text('alamat_pemilik')->nullable();
            $table->string('no_registrasi_kendaraan',150)->nullable();
            $table->string('no_rangka',150)->nullable();
            $table->string('no_mesin',150)->nullable();
            $table->string('jenis_kendaraan',150)->nullable();
            $table->string('merk',150)->nullable();
            $table->string('tipe',100)->nullable();
            $table->text('keterangan_hasil_uji')->nullable();
            $table->string('masa_berlaku',100)->nullable();
            $table->string('petugas_penguji',150)->nullable();
            $table->string('nrp_petugas_penguji',100)->nullable();
            $table->string('unit_pelaksana_teknis',100)->nullable();
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
        Schema::dropIfExists('eblue');
    }
}
