<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrayeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayek', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->string('kode_trayek',100)->nullable();
            $table->string('nama_trayek',200)->nullable();
            $table->string('rute',200)->nullable();
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
        Schema::dropIfExists('trayek');
    }
}
