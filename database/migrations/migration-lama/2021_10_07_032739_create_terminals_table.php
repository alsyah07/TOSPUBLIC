<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal', function (Blueprint $table) {
            $table->id();
            $table->integer('id_permission')->nullable();
            $table->integer('id_kota')->nullable();
            $table->integer('id_bptd')->nullable();
            $table->string('nama_terminal',150)->nullable();
            $table->string('no_telp',15)->nullable();
            $table->text('titik_koordinat')->nullable();
            $table->text('alamat')->nullable();
            $table->text('gambar_terminal')->nullable();
            $table->string('tipe',150)->nullable();
            $table->integer('status_p3d')->nullable();
            $table->integer('luas_lahan')->nullable();
            $table->integer('luas_bangunan')->nullable();
            $table->integer('luas_area_pembangunan')->nullable();
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
        Schema::dropIfExists('terminal');
    }
}
