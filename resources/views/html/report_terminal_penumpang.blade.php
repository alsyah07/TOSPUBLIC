@extends('html.index')
@section('content')
<!-- BEGIN: Content-->

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Report Terminal</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/report_terminal_penumpang">Dashboard Report</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Datatable</a>
                                    </li>
                                    <li class="breadcrumb-item active">Basic
                                    </li> --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="content-body">
                <!-- Row grouping -->
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card container-fluid">
                                {{-- <div class="card-header border-bottom">
                                    <h4 class="card-title">Row Grouping</h4>
                                </div> --}}
                    <div style="padding: 10px; font-size: 12px;">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                           {{--  <a href="/report_terminal_kendaraan" class="nav-link"  type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kendaraan</a>
                            <a href="/report_terminal_penumpang" class="nav-link active"  role="tab" aria-controls="nav-profile" aria-selected="false">Penumpang</a> --}}
                        </div>
                    </nav>
                    </nav>
                    <form method="post" action="/filterreport">
                        @csrf
                        <div class="row" style="margin-bottom: 15px;">
                            @if($datauserid->id_bptb==null && $datauserid->kode_terminal==null)
                            <div class="col-md-2">
                                <label class="control-label">Pilih BPTD</label>
                                <select name="id_bptb" class="form-control">
                                    <option value="ALL">Semua BPTD</option>
                                    @foreach($databptdall as $val)
                                    <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-md-2">
                                <label class="control-label">Pilih Terminal</label>
                                <select name="kode_terminal" class="form-control">
                                    <option value="ALL">Semua Terminal</option>
                                    @foreach($dataterminal as $val)
                                    <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @elseif($datauserid->id_bptb !=null && $datauserid->kode_terminal==null)
                                <div class="col-md-2">
                                    <label class="control-label">Pilih Terminal</label>
                                    <select name="kode_terminal" class="form-control">
                                        <option value="ALL">Semua Terminal</option>
                                        @foreach($dataterminal as $val)
                                        <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else 
                                <input type="hidden" name="kode_terminal" value="{{ $datauserid->kode_terminal }}">
                            @endif
                             {{-- <div class="col-md-2">
                                <select name="id_bptb" class="form-control">
                                    <option value="">Pilih BPTD</option>
                                    @foreach($databptd as $val)
                                    <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="col-md-3">
                                 <label class="control-label">Tanggal dari</label>
                                <input type="text" name="tglawal" value="{{ $tglreportdari }}" required="" class="form-control">
                            </div>
                             <div class="col-md-3">
                                <label class="control-label">Tanggal Sampai</label>
                                <input type="text" name="tglakhir" value="{{ $tglreportsampai }}" required="" class="form-control">
                            </div>
                             <div class="col-md-2">
                                <label class="control-label">Pilih Jenis</label>
                               <select name="tipe" class="form-control" style="width: 120%;">
                                <option value="AKAP">Semua Jenis</option>
                                 <option value="AKAP">Pilih</option>
                                   <option value="AKAP">AKAP</option>
                                    <option value="AKDP">AKDP</option>
                                     <option value="NOTALL">Belum Terdaftar</option>
                                </select>
                            </div>
                            
                        </div>
                       <div class="row">
                            <div class="col-md-2">
                                <label class="control-label"></label>
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                             <div class="col-md-2" style="margin-left: -80px;">
                                <label class="control-label"></label>
                                <a href="/report_terminal_penumpang" class="btn btn-warning">Refresh</a>
                            </div>
                            @if($filter=="")
                            <div class="col-md-2" style="margin-left: -60px;">
                                <label class="control-label"></label>
                                <a href="/report_terminal_penumpang/export" class="btn btn-info">Export</a>
                            </div>
                            @else
                            <form method="post" action="filterreport/export">
                            <div class="col-md-2" style="margin-left: -60px;">
                                <label class="control-label"></label>
                                <input type="hidden" name="export" value="export">
                                <button type="submit" class="btn btn-info">Export</button>
                            </div>
                            </form>
                            @endif
                        </div>
                    </form>

                    
                                   {{--  <table class="table-bordered table-responsive table-hover" width="100%">
                                    <tbody>
                                    <tr>
                                    <td colspan="22"><center>Tanggal {{ $tgl }}</center></td>
                                    </tr>
                                    <tr>
                                    <td rowspan="2"><center>Terminal</center></td>
                                    <td rowspan="2"><center>Tanggal</center></td>
                                    <td colspan="4"><center>{{ $tipe }}</center></td>
                                    </tr>
                                    <tr>
                                    <td><center>Naik</center></td>
                                    <td><center>Tiba</center></td>
                                    <td><center>Turun</center></td>
                                    <td><center>Berangkat</center></td>
                                    
                                    </tr>
                                    @foreach($datapenumpangkendaraanditerminaltiba as $val)
                                    <tr>
                                    @if($val->nama_terminal==null)
                                    <td>-</td>
                                    @else
                                    <td>{{ $terminalasal->nama_terminal }} - {{ $val->nama_terminal }}</td>
                                    @endif
                                    <td>{{ $val->tgl }}</td>
                                    @if($val->tipe_kendaraan=="AKAP")
                                    <td>{{ $val->jumlah_penumpang_naik }}</td>
                                    <td>{{ $val->jumlah_penumpang_tiba }}</td>
                                    <td>{{ $val->jumlah_penumpang_turun }}</td>
                                    <?php
                                        $jumakap = (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik;
                                     ?>
                                    <td>{{ (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik }}</td>
                                    @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @endif
                                   
                                    @endforeach
                                    </tbody>
                                    </table>        --}}
                                    <hr>
                                    <div>
                                        <center><h4>{{ $kdterminal }}</h4></center>
                                    </div>
                                    <hr>
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


                    </div>
    
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Row grouping -->

                

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- Modal add -->

    

    
    
@endsection
