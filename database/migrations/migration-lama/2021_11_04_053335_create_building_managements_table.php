<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_management', function (Blueprint $table) {
            $table->id();
            $table->string('kode_terminal',150)->nullable();
            $table->string('kode_aset',150)->nullable();
            $table->string('nama_aset',220)->nullable();
            $table->string('tahun_pembelian',20)->nullable();
            $table->text('gambar_barang')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('building_management');
    }
}
