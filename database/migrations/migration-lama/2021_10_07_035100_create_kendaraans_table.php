<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_perusahaan_otobus')->nullable();
            $table->integer('id_trayek')->nullable();
            $table->string('no_kendaraan',150)->nullable();
            $table->string('no_rangka',150)->nullable();
            $table->string('no_mesin',200)->nullable();
            $table->string('merek',170)->nullable();
            $table->string('jenis_kendaraan',200)->nullable();
            $table->string('tahun',50)->nullable();
            $table->string('kapasitas',100)->nullable();
            $table->string('tipe_kendaraan',100)->nullable();
            $table->string('no_uji',100)->nullable();
            $table->string('tgl_kadaluarsa',50)->nullable();
            $table->string('no_kps',100)->nullable();
            $table->string('tgl_kadaluarsa_kps',50)->nullable();
            $table->string('no_urut',100)->nullable();
            $table->string('masa_berlaku_kendaraan',50)->nullable();
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
        Schema::dropIfExists('kendaraan');
    }
}
