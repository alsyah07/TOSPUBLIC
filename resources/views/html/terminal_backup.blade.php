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
                            <h2 class="content-header-title float-start mb-0">Data Terminal</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Sistem Informasi</a>
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
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah Terminal</button>
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

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Kode Terminal</th>
                <th>Nama Terminal</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataterminal as $val)
            <tr>
                <td>{{ $val->kode_terminal }}</td>
                <td>{{ $val->nama_terminal }}</td>
                <td>{{ $val->tipe }}</td>
                <td>{{ $val->alamat }}</td>
                <td>
                   {{--  <button  class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id_terminal }}"><i class="fas fa-edit"></i></button>  --}} 
                    <a href="/editterminal/{{ $val->id_terminal }}" class="btn btn-sm btn-success edit_data" style="width:10px;"><i class="fas fa-edit"></i></a>
                    <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_terminal }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Kode Terminal</th>
                <th>Nama Terminal</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Opsi</th>
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
    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpanterminal" enctype="multipart/form-data" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Terminal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Terminal</label>
                                            <input type="text" class="form-control" name="kode_terminal" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Terminal</label>
                                            <input type="text" class="form-control" name="nama_terminal"  required="" oninvalid="this.setCustomValidity('Nama terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="text" class="form-control" name="no_telp" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Latitude</label>
                                                    <input type="text" class="form-control" name="lat" required="" oninvalid="this.setCustomValidity('Latitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Longtitude</label>
                                                    <input type="text" class="form-control" name="long" required="" oninvalid="this.setCustomValidity('Longtitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Gambar Terminal</label>
                                            <input type="file" class="form-control" name="gambar_terminal" required="" oninvalid="this.setCustomValidity('Gambar harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">BPTD</label>
                                            <select class="form-select"  name="id_bptd" required="" oninvalid="this.setCustomValidity('Silahkan pilih BPTD')" oninput="setCustomValidity('')">
                                                <option value="">Pilih BPTD</option>
                                                @foreach($databptd as $val)
                                                <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Status P3D</label>
                                            <input type="text" class="form-control" name="status_p3d" required="" oninvalid="this.setCustomValidity('Status P3D harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Lahan</label>
                                                    <input type="text" class="form-control" name="luas_lahan" required="" placeholder="m³" oninvalid="this.setCustomValidity('Luas lahan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Bangunan</label>
                                                    <input type="text" class="form-control" name="luas_bangunan"required="" placeholder="m³" oninvalid="this.setCustomValidity('Luas bangunan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Luas Area Pengembangan</label>
                                            <input type="text" class="form-control" name="luas_area_pengembangan" placeholder="m³" required="" oninvalid="this.setCustomValidity('Luas area pengembangan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Peringatan Gate</label>
                                            <select class="form-select" onchange="funcgate()"  id="notifgate"  oninvalid="this.setCustomValidity('Silahkan pilih gate')" oninput="setCustomValidity('')">
                                                <option value="2">Non Maksimal Gate</option>
                                                <option value="1">Maksimal Gate</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1" style="display: none" id="getgate" >
                                            <label class="control-label">Jumlah Peringatan</label>
                                            <input type="number" class="form-control" name="jumlah_peringatan" placeholder="Masukan batas maksimal gate">
                                        </div>
                                        {{-- <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div> --}}
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



    <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostterminal"  enctype="multipart/form-data"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Terminal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Terminal</label>
                                            <input type="text" class="form-control" name="kode_terminal" id="kode_terminal" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Terminal</label>
                                            <input type="text" class="form-control" name="nama_terminal" id="nama_terminal"  required="" oninvalid="this.setCustomValidity('Nama terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="text" class="form-control" name="no_telp" id="no_telp" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Latitude</label>
                                                    <input type="text" class="form-control" name="lat" id="lat" required="" oninvalid="this.setCustomValidity('Latitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Longtitude</label>
                                                    <input type="text" class="form-control" name="long" id="long" required="" oninvalid="this.setCustomValidity('Longtitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required="" id="alamat"  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" id="id_kota" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Gambar Terminal</label>
                                            <input type="file" class="form-control" name="gambar_terminal" id="gambar_terminal">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">BPTD</label>
                                            <select class="form-select"  name="id_bptd" id="id_bptd" required="" oninvalid="this.setCustomValidity('Silahkan pilih BPTD')" oninput="setCustomValidity('')">
                                                <option value="">Pilih BPTD</option>
                                                @foreach($databptd as $val)
                                                <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" id="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Status P3D</label>
                                            <input type="text" class="form-control" name="status_p3d" id="status_p3d" required="" oninvalid="this.setCustomValidity('Status P3D harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Lahan</label>
                                                    <input type="text" class="form-control" name="luas_lahan" id="luas_lahan" required="" placeholder="m³" oninvalid="this.setCustomValidity('Luas lahan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Bangunan</label>
                                                    <input type="text" class="form-control" name="luas_bangunan" id="luas_bangunan" required="" placeholder="m³" oninvalid="this.setCustomValidity('Luas bangunan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Luas Area Pengembangan</label>
                                            <input type="text" class="form-control" name="luas_area_pengembangan" id="luas_area_pengembangan" placeholder="m³" required="" oninvalid="this.setCustomValidity('Luas area pengembangan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Peringatan Gate</label>
                                            <select class="form-select" onchange="funcgateup()"  id="notifgateup">
                                                <option value="2">Non Maksimal Gate</option>
                                                <option value="1">Maksimal Gate</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1" style="display: none" id="getgateup" >
                                            <label class="control-label">Jumlah Peringatan</label>
                                            <input type="number" class="form-control" name="jumlah_peringatan" id="max_open_gate" placeholder="Masukan batas maksimal gate" >
                                        </div>
                                        {{-- <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div> --}}
                                    </div>
                                </div>
                                
                            </div>
                             <hr>
                            <div class="container-fluid">
                             <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-trayek" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Trayek</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-fasilitas" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Fasilitas</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-sdm" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">SDM</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-po" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Perusahaan Otobus</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-dataasset" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Data Asset</button>
                                  </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="nav-trayek" role="tabpanel" aria-labelledby="nav-home-tab">
                                      <table id="example1" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Trayek</th>
                                                    <th>Rute</th>
                                                    <th>No. Kendaraan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datatryek as $val)
                                                <tr>
                                                    <td>{{ $val->kode_trayek }}</td>
                                                    <td>{{ $val->nama_trayek }}</td>
                                                    <td>{{ $val->rute }}</td>
                                                    <td>{{ $val->no_kendaraan }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Trayek</th>
                                                    <th>Rute</th>
                                                    <th>No. Kendaraan</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-fasilitas" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formfasilitas" >+ Tambah Fasilitas</button>
                                    </div>
                                      <table id="example3" class="table table-striped list_table_json " style="width:100%" >
                                        <thead>
                                            <tr>
                                                <th>Gambar</th>
                                                <th>Kategori</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datafas as $val)
                                            <tr>
                                                <td>{{ $val->gambar_fasilitas }}</td>
                                                <td>{{ $val->kategori }}</td>
                                                <td>{{ $val->nama_fasilitas }}</td>
                                                <td>{{ $val->deskripsi }}</td>        
                                                <td><button  class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>                                              
                                                <th>Gambar</th>
                                                <th>Kategori</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                        
                                        
                                    </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-sdm" role="tabpanel" aria-labelledby="nav-contact-tab">
                                       <table id="example2" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Tipe</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                {{-- <th>Opsi</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datasdm as $val)
                                            <tr>
                                                <td>{{ $val->nip }}</td>
                                                <td>{{ $val->nama_sdm }}</td>
                                                <td>{{ $val->jabatan }}</td>
                                                <td>{{ $val->tipe }}</td>
                                                <td>{{ $val->no_telp }}</td> 
                                                <td>{{ $val->alamat }}</td>           
                                                {{-- <td><button  class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                </td> --}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Tipe</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                {{-- <th>Opsi</th> --}}
                                            </tr>
                                        </tfoot>
                                    </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-po" role="tabpanel" aria-labelledby="nav-contact-tab">
                                      <table id="example3" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datapo as $val)
                                            <tr>
                                                <td>{{ $val->nama_po }}</td>
                                                <td>{{ $val->alamat }}</td>
                                                <td><button  class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id_perusahaan_otobus  }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_perusahaan_otobus }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
    
                                  </div>
                                  <div class="tab-pane fade" id="nav-dataasset" role="tabpanel" aria-labelledby="nav-contact-tab">
                                      <div class="row">
                                          <div class="col-md-10">
                                              <div class="col-md-5">
                                                  SK Penetapan Lokasi
                                              </div>
                                              <div class="col-md-5">
                                                  <input type="file" class="form-control" name="gambar_terminal" id="gambar_terminal">
                                              </div>
                                          </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                          <div class="col-md-10">
                                              <div class="col-md-5">
                                                  SK Penetapan Lokasi
                                              </div>
                                              <div class="col-md-5">
                                                  <input type="file" class="form-control" name="gambar_terminal" id="gambar_terminal">
                                              </div>
                                          </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                          <div class="col-md-10">
                                              <div class="col-md-5">
                                                  SK Penetapan Lokasi
                                              </div>
                                              <div class="col-md-5">
                                                  <input type="file" class="form-control" name="gambar_terminal" id="gambar_terminal">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <br>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>


    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deleteterminal">
                                    @csrf
                                    <div class="col-12">
                                       <center><h5>Apakah anda yakin menghapus data ini ?</h5></center>
                                       <input type="hidden" name="id" id="iduser">
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger me-1 mt-1"><i class="fa fa-trash"> </i>Hapus</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
    <div class="modal fade text-start" id="myModalAddfasilitas" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form id="ajaxform" method="post" action="/simpanfasilitas"  enctype="multipart/form-data" >
    @csrf 
        <input type="hidden" name="idterminal" id="idterminal" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="border-width: 150px;">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Fasilitas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Gambar</label>
                                            <input type="file" class="form-control" name="gambar_fasilitas" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Fasilitas</label>
                                            <input type="text" class="form-control" name="nama_fasilitas"  required="" oninvalid="this.setCustomValidity('Nama terminal harus diisi')" oninput="setCustomValidity('')">
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kategori</label>
                                            <select class="form-select"  name="kategori">
                                                <option value="">Pilih Kategori</option>
                                                <option>OK</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button class="btn btn-primary save-data"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form> 
    </div>


    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });
        $(document).on('click','.formfasilitas',function(){
             $('#myModalAddfasilitas').modal('show');
        });
        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedataterminal/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                    console.log('dataje',data);
                    var titik_koordinat = JSON.parse(data.data.titik_koordinat);
                    console.log('cektitik',titik_koordinat[0].lat);
                       document.getElementById('idterminal').value = data.data.id_terminal;
                      $('#id').val(data.data.id_terminal);
                      $('#kode_terminal').val(data.data.kode_terminal);
                      $('#nama_terminal').val(data.data.nama_terminal);
                      $('#no_telp').val(data.data.no_telp);
                      $('#lat').val(titik_koordinat[0].lat);
                      $('#long').val(titik_koordinat[0].long);
                      $('#alamat').val(data.data.alamat);
                      $('#id_kota').val(data.data.id_kota);
                   //   $('#gambar_terminal').val(data.data.gambar_terminal);
                      $('#id_bptd').val(data.data.id_bptb);
                      $('#tipe').val(data.data.tipe);
                      $('#status_p3d').val(data.data.status_p3d);
                      $('#luas_lahan').val(data.data.luas_lahan);
                      $('#luas_bangunan').val(data.data.luas_bangunan);
                      $('#luas_area_pengembangan').val(data.data.luas_area_pengembangan);
                      $('#max_open_gate').val(data.data.max_open_gate);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });

       //    //  $("#display").click(function() {                
       //        $.ajax({    //create an ajax request to display.php
       //          type: "GET",
       //          url: "/api/fasilitas",             
       //          dataType: "json",   //expect html to be returned                
       //          success: function(response){   
       //              console.log('datamenwak',response);
       //              var event_data = '';
       //              $.each(response.data, function(index, value){
       //                  /*console.log(value);*/
       //                  event_data += '<tr>';
       //                  event_data += '<td>'+value.gambar_fasilitas+'</td>';
       //                  event_data += '<td>'+value.kategori+'</td>';
       //                  event_data += '<td>'+value.nama_fasilitas+'</td>';
       //                  event_data += '<td>'+value.deskripsi+'</td>';
       //                  event_data += '<td>'+'opsi'+'</td>';
       //                  event_data += '<tr>';
       //              });
       //              $(".list_table_json").append(event_data);                            
       //          }

       //      });
       // // });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
    }
    function funcgate(){
       var gt = document.getElementById('notifgate').value;
       if(gt=="1"){
            document.getElementById('getgate').style.display = "inline";
       } else {
            document.getElementById('getgate').style.display = "none";
       }
    }
    function funcgateup(){
       var gt = document.getElementById('notifgateup').value;
       if(gt=="1"){
            document.getElementById('getgateup').style.display = "inline";
       } else {
            document.getElementById('getgateup').style.display = "none";
       }
    }

    $(".save-data").click(function(event){
         $('#myModalUpdate').modal('show');
      // event.preventDefault();
      // let idterminal        = $("input[name=idterminal]").val();
      // let nama_fasilitas    = $("input[name=nama_fasilitas]").val();
      // let kategoris          = $("select[name=kategori]").val();
      // let gambar_fasilitas  = $("input[name=gambar_fasilitas]").val();
      // let deskripsis         = $("textarea[name=deskripsi]").val();
      // let _token            = $('meta[name="csrf-token"]').attr('content');

      // $.ajax({
      //   url: "/api/simpanfasilitas",
      //   type:"POST",
      //   data:{
      //     id_terminal       : idterminal,
      //     nama_fasilitas    : nama_fasilitas,
      //     kategori          : kategoris,
      //     gambar_fasilitas  : gambar_fasilitas,
      //     deskripsi         : deskripsis,
      //     _token            : _token
      //   },
      //   success:function(response){
      //     console.log(response);
      //     if(response) {
      //       $('.success').text(response.success);
      //       $("#ajaxform")[0].reset();
      //     }
      //   },
      //  });
  });

  </script>
    
@endsection