<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_wilayah',50)->nullable();
            $table->string('nama_wilayah',150)->nullable();
            $table->string('induk_wilayah',150)->nullable();
            $table->string('level',70)->nullable();
            $table->string('no_telp',15)->nullable();
            $table->text('alamat')->nullable();
            $table->text('titik_koordinat')->nullable();
            $table->integer('status')->nullable()->default(1);
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
        Schema::dropIfExists('wilayah');
    }
}
