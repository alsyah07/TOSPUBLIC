<?php

namespace App\Imports;

use App\Models\kendaraan_tiba;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// use Maatwebsite\Excel\Concerns\WithStartRow;

class KendaraantibaImport implements ToModel
{

     use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        // $cekdata = ([
         return new kendaraan_tiba([
             
            'nip'                       => $row[0],
            'wilayah_terminal_asal'     => $row[1],
            'nama_admin'                => $row[2],
            'no_kendaraan'              => $row[3],
            'terminal_tujuan'           => $row[4],
            'tgl'                       => $row[5], 
            'jam'                       => $row[6],
            'status_spinoam'            => $row[7], 
            'status_eblue'              => $row[8], 
            'catatan'                   => $row[9], 
            'jumlah'                    => $row[10], 
            'jumlah_penumpang_tiba'     => $row[11], 
            'jumlah_penumpang_turun'    => $row[12], 
            'jumlah_penumpang_naik'     => $row[13], 
            'tgl_penumpang_naik'        => $row[14], 
            'status'                    => $row[15], 
                
            ]);
        }

    // public function batchSize(): int
    // {
    //     return 1000;
    // }

    // public function headingRow(): int
    // {
    //     return 0;
    // }

    // public function startRow(): int
    // {
    //     return 0;
    // }
}
