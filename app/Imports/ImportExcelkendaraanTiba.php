<?php

namespace App\Imports;

use App\models\kendaraan_tiba;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportExcelkendaraanTiba implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new kendaraan_tiba([
            'kode_terminal_asal' => $row[0], 
            'nip' => $row[1], 
            'nama_admin' => $row[2], 
            'no_kendaraan' => $row[3], 
            'terminal_tujuan' => $row[4], 
            'tgl'               => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
            'jam' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]), 
            'catatan' => $row[7], 
            'jumlah_penumpang_tiba' => $row[8], 
            'jumlah_penumpang_turun' => $row[9], 
            'jumlah_penumpang_naik' => $row[10], 
            'tgl_penumpang_naik' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])
        ]);
    }
}
