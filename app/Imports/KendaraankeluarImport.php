<?php

namespace App\Imports;

use App\Models\kendaraan_keluar;
use Maatwebsite\Excel\Concerns\ToModel;

class KendaraankeluarImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new kendaraan_keluar([
            // 'id_kendaraan_keluar'       => $row[1],
            // 'id_terminal'               => $row[2],
            // 'id_sdm'                    => $row[5],
            'nip'                       => $row[0],
            'nama_admin'                => $row[1],
            'no_kendaraan'              => $row[2],
            'terminal_tujuan'           => $row[3],
            'tgl'                       => $row[4], 
            'jam'                       => $row[5],
            'status_spinoam'            => $row[6], 
            'status_eblue'              => $row[7], 
            'catatan'                   => $row[8], 
            'jumlah'                    => $row[9],  
            'status'                    => $row[10], 
        ]);
    }
}
