<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogResponseGatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_response_gate', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kendaraan',50)->nullable();
            $table->integer('id_petugas')->nullable();
            $table->integer('id_terminal')->nullable();
            $table->string('tanggal',70)->nullable();
            $table->string('flag',50)->nullable();
            $table->text('url_foto')->nullable();
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
        Schema::dropIfExists('log_response_gate');
    }
}
