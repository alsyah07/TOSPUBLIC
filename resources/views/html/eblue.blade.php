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
                            <h2 class="content-header-title float-start mb-0">Data Eblue</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Operasional Terminal</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Data Perizinan</a>
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
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                   {{--  <button type="button" class="btn btn-primary registerusers" >+ Tambah Penumpang Tiba</button> --}}
                </div>
                 @if(session('notif'))
                <div class="demo-spacing-0">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ session('notif') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if(session('notifdelete'))
                <div class="demo-spacing-0">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ session('notifdelete') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <br>
                
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

<table id="example" class="table table-responsive table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat Pemilik</th>
                <th>No. Registrasi Kendaraan</th>
                <th>No. Rangka</th>
                <th>No. Mesin</th>
                <th>Jenis Kendaraan</th>
                <th>Merek</th>
                <th>Tipe</th>
                <th>Kendaraan Hasil Uji</th>
                <th>Masa Berlaku</th>
                <th>Petugas Penguji</th>
                <th>Nrp Petugas Penguji</th>
                <th>Unit Pelaksana Teknis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataeblue as $val)
            <tr>
                <td>{{ $val->nama_pemilik }}</td>
                <td>{{ $val->alamat_pemilik }}</td>
                <td>{{ $val->no_registrasi_kendaraan }}</td>
                <td>{{ $val->no_rangka }}</td>
                <td>{{ $val->no_mesin }}</td>
                <td>{{ $val->jenis_kendaraan }}</td>
                <td>{{ $val->merk }}</td>
                <td>{{ $val->tipe }}</td>
                <td>{{ $val->keterangan_hasil_uji }}</td>
                <td>{{ $val->masa_berlaku }}</td>
                <td>{{ $val->petugas_penguji }}</td>
                <td>{{ $val->nrp_petugas_penguji }}</td>
                <td>{{ $val->unit_pelaksana_teknis }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat Pemilik</th>
                <th>No. Registrasi Kendaraan</th>
                <th>No. Rangka</th>
                <th>No. Mesin</th>
                <th>Jenis Kendaraan</th>
                <th>Merek</th>
                <th>Tipe</th>
                <th>Kendaraan Hasil Uji</th>
                <th>Masa Berlaku</th>
                <th>Petugas Penguji</th>
                <th>Nrp Petugas Penguji</th>
                <th>Unit Pelaksana Teknis</th>
            </tr>
        </tfoot>
    </table>
    
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