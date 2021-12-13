<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kendaraan_tiba extends Model
{
    protected $table="kendaraan_tiba";
    protected $primaryKey = 'id_kendaraan_tiba';
    protected $fillable = [
    	'id_kendaraan',
    	'kode_terminal_asal',
    	'nip',
    	'wilayah_terminal_asal',
    	'nama_admin',
    	'no_kendaraan',
    	'terminal_tujuan',
    	'tgl',
    	'jam',
    	'status_spinoam',
    	'status_eblue',
    	'catatan',
    	'jumlah_penumpang_tiba',
    	'jumlah_penumpang_turun',
    	'jumlah_penumpang_naik',
    	'tgl_penumpang_naik',
    	'status'
    ];
}
