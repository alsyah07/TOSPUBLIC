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
                            <h2 class="content-header-title float-start mb-0">Report Terminal Penumpang</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
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
                            <a href="/report_terminal_kendaraan" class="nav-link active"  type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kendaraan</a>
                            <a href="/report_terminal_penumpang" class="nav-link"  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Penumpang</a>
                        </div>
                    </nav>
                    <form method="post" action="">
                        @csrf
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-3">
                                <input type="date" id="start" name="tgl_start" class="form-control datepicker">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="tgl_end" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                        </div>
                    </form>

                                    <table class="table-bordered table-responsive table-hover" width="100%">
                                    <tbody>
                                    <tr>
                                    <td colspan="8"><center>Tanggal</center></td>
                                    </tr>
                                    <tr>
                                    <td rowspan="2"><center>Terminal</center></td>
                                    <td rowspan="2"><center>Tanggal</center></td>
                                    <td colspan="2"><center>AKAP</center></td>
                                    <td colspan="2"><center>AKDP</center></td>
                                    <td colspan="2"><center>Total Penumpang</center></td>
                                    </tr>
                                    <tr>
                                    <td><center>Tiba</center></td>
                                    <td><center>Turun</center></td>
                                    <td><center>Tiba</center></td>
                                    <td><center>Turun</center></td>
                                    <td><center>Tiba</center></td>
                                    <td><center>Turun</center></td>
                                    </tr>
                                    @foreach($datapenumpang as $val)
                                    <tr>
                                    <td>{{ $val->nama_terminal }}</td>
                                    <td>{{ $val->tgl }}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
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