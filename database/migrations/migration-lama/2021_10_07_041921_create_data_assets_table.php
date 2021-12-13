<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_asset', function (Blueprint $table) {
            $table->id();
            $table->integer('id_terminal')->nullable();
            $table->text('file_penempatan_lokasi')->nullable();
            $table->text('file_bast_p3d')->nullable();
            $table->text('sertifikat_tanah')->nullable();
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
        Schema::dropIfExists('data_asset');
    }
}
