<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kendaraan_keluar extends Model
{
    protected $table="kendaraan_keluar";
    protected $primaryKey = 'id_kendaraan_keluar';
    protected $fillable = [
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
    	'catatan'
    ];
}
