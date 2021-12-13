<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasPenunjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_penunjang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->string('nama_fasilitas_penunjang',200)->nullable();
            $table->string('status_barang_penunjang',50)->nullable();
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
        Schema::dropIfExists('fasilitas_penunjang');
    }
}
