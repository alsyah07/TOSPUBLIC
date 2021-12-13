<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdm', function (Blueprint $table) {
            $table->id();
            $table->integer('id_wilayah')->nullable();
            $table->integer('id_kota')->nullable();
            $table->integer('id_terminal')->nullable();
            $table->string('nip',150)->nullable();
            $table->string('nama_sdm',150)->nullable();
            $table->string('jabatan',150)->nullable();
            $table->string('tipe',150)->nullable();
            $table->string('no_telp',150)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos',100)->nullable();
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
        Schema::dropIfExists('sdm');
    }
}
