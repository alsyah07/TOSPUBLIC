<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenumpangTibasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penumpang_tiba', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_kendaraan')->nullable();
            $table->string('terminal_tujuan',200)->nullable();
            $table->string('tgl',50)->nullable();
            $table->string('jam',50)->nullable();
            $table->string('status_spinoam',100)->nullable();
            $table->string('status_eblue',100)->nullable();
            $table->text('catatan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('penumpang_tiba');
    }
}
