<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpionamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spionam', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan',100)->nullable();
            $table->string('nama_perusahaan',150)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_sk',100)->nullable();
            $table->string('tgl_exp_sk',50)->nullable();
            $table->string('jenis_pelayanan',150)->nullable();
            $table->string('no_uji',100)->nullable();
            $table->string('tgl_exp_uji',50)->nullable();
            $table->string('no_kps',100)->nullable();
            $table->string('tgl_exp_kps',50)->nullable();
            $table->string('no_rangka',100)->nullable();
            $table->string('no_mesin',100)->nullable();
            $table->string('merek',150)->nullable();
            $table->string('tahun',50)->nullable();
            $table->string('noken',100)->nullable();
            $table->string('kode_trayek',100)->nullable();
            $table->string('nama_trayek',150)->nullable();
            $table->text('rute')->nullable();
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
        Schema::dropIfExists('spionam');
    }
}
