<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Report Data Produksi Terminal.xls");
?>
<table class="table-bordered table-responsive table-striped" width="100%">
                                        <tbody>
                                        <tr>
                                        <td rowspan="2"><center>Terminal</center></td>
                                        <td rowspan="2"><center>Tanggal</center></td>
                                        <td colspan="6"><center>{{ $tipe }}</center></td>
                                        </tr>
                                        <tr>
                                        <td><center>Kendaraan Tiba</center></td>
                                        <td><center>Kendaraan Keluar</center></td>
                                        <td><center>Penumpang Tiba</center></td>
                                        <td><center>Penumpang Turun</center></td>
                                        <td><center>Penumpang Naik</center></td>
                                        <td><center>Penumpang Berangkat</center></td>
                                        </tr>
                                        @foreach($datapenumpangkendaraanditerminaltiba as $val)
                                        <tr>
                                        <td>{{ $val->nama_terminal }}</td>
                                        <td><center>{{ $val->tgl }}</center></td>
                                        <td><center>{{ $val->kendaraan_tiba }}</center></td>
                                        <td><center>{{ $val->kendaraan_keluar }}</center></td>
                                        <td><center>{{ $val->penumpang_tiba }}</center></td>
                                        <td><center>{{ $val->penumpang_turun }}</center></td>
                                        <td><center>{{ $val->penumpang_naik }}</center></td>
                                        <td><center>{{ $val->penumpang_berangkat }}</center></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        </table>

