<?php

namespace App\Imports;

use App\models\kendaraan_keluar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportExcelkendaraanKeluar implements ToModel,WithStartRow
{
    /**
    * @param Collection $collection
    */
   public function startRow(): int
    {
        return 2;
    }

   public function model(array $row)
    {
        return new kendaraan_keluar([
            'kode_terminal_asal' => $row[0],
            'nip' => $row[1], 
            'nama_admin' => $row[2], 
            'no_kendaraan' => $row[3], 
            'terminal_tujuan' => $row[4], 
            'tgl'               => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
            'jam' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]), 
            'catatan' => $row[7], 
        ]);
    }
}
