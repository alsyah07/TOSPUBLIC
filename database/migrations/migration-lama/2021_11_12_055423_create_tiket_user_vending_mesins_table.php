<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketUserVendingMesinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket_user_vending_mesin', function (Blueprint $table) {
            $table->id();
            $table->string('nik',120)->nullable();
            $table->string('id_tiket',200)->nullable();
            $table->string('nama_penumpang',200)->nullable();
            $table->string('umur',50)->nullable();
            $table->string('jenis_kelamin',50)->nullable();
            $table->string('jam_tiket',50)->nullable();
            $table->string('tgl_tiket',50)->nullable();
            $table->string('asal_terminal',200)->nullable();
            $table->string('id_terminal',200)->nullable();
            $table->string('no_kursi',100)->nullable();
            $table->string('status_tiket',100)->nullable();
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
        Schema::dropIfExists('tiket_user_vending_mesin');
    }
}
