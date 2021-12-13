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
                            <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/terminal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2> 
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
               
            </div>
            <div class="content-body">
                <!-- Row grouping -->
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header border-bottom">
                                    <h4 class="card-title">Row Grouping</h4>
                                </div> --}}
                                    <div class="modals fades text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostterminal"  enctype="multipart/form-data"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form edit Terminal</h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
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
                                            <input type="number" class="form-control" name="no_telp" id="no_telp"  oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Latitude</label>
                                                    <input type="text" class="form-control" name="lat" id="lat">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Longtitude</label>
                                                    <input type="text" class="form-control" name="long" id="long">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" id="alamat"  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" id="id_kota" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
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
                                            <select class="form-select"  name="id_bptd" id="id_bptd" oninvalid="this.setCustomValidity('Silahkan pilih BPTD')" oninput="setCustomValidity('')">
                                                <option value="">Pilih BPTD</option>
                                                @foreach($databptd as $val)
                                                <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" id="tipe" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Status P3D</label>
                                            <input type="text" class="form-control" name="status_p3d" id="status_p3d" oninvalid="this.setCustomValidity('Status P3D harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Lahan</label>
                                                    <input type="text" class="form-control" name="luas_lahan" id="luas_lahan" placeholder="m³">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Bangunan</label>
                                                    <input type="text" class="form-control" name="luas_bangunan" id="luas_bangunan" placeholder="m³">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Luas Area Pengembangan</label>
                                            <input type="text" class="form-control" name="luas_area_pengembangan" id="luas_area_pengembangan" placeholder="m³">
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
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>
    <hr>

                    <div class="container">
                             <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    {{-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-trayek" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Trayek</button> --}}
                                    {{-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-fasilitas" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Fasilitas</button> --}}
                                    <button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-sdm" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">HRM</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-po" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Perusahaan Otobus</button>
                                   {{--  <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-dataasset" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Data Asset</button> --}}
                                  </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade " id="nav-trayek" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formTrayek" >+ Tambah Trayek</button>
                                    </div>
                                      <table id="example1" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Trayek</th>
                                                    <th>Rute</th>
                                                    <th>No. Kendaraan</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datatryek as $val)
                                                <tr>
                                                    <td>{{ $val->kode_trayek }}</td>
                                                    <td>{{ $val->nama_trayek }}</td>
                                                    <td>{{ $val->rute }}</td>
                                                    <td>{{ $val->no_kendaraan }}</td>
                                                    <td><button type="button" class="btn btn-sm btn-success edit_data_trayek" style="width:10px;" id="{{ $val->id_trayek }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeletetry({{ $val->id_trayek }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Trayek</th>
                                                    <th>Rute</th>
                                                    <th>No. Kendaraan</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-fasilitas" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formfasilitas" >+ Tambah Fasilitas</button>
                                    </div>
                                      <table id="example3" class="table table-striped table " style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;" >
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
                                                <td><img class="img img-thumbnail" style="width: 70%;" src="/upload/fasilitas/{{ $val->gambar_fasilitas }}"/></td>
                                                <td>{{ $val->kategori }}</td>
                                                <td>{{ $val->nama_fasilitas }}</td>
                                                <td>{{ $val->deskripsi }}</td>        
                                                <td><button type="button"  class="btn btn-sm btn-success edit_data_fasilitas" style="width:10px;" id="{{ $val->id_fasilitas }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeletefas({{ $val->id_fasilitas }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
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
                                  <div class="tab-pane fade show active" id="nav-sdm" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formfasilitasSDM" >+ Tambah HRM</button>
                                    </div>
                                       <table id="example2" class="table table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;" >
                                        <thead>
                                            <tr>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Tipe</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Foto</th>
                                                <th>Opsi</th>
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
                                                 <td>{{ $val->pendidikan_terakhir }}</td>  
                                                <td>{{ $val->alamat }}</td>    
                                                @if($val->foto_sdm !="-" && $val->foto_sdm !=null)
                                                <td><img id="/upload/foto_hrm/{{ $val->foto_sdm }}" class="img img-thumbnail foto" width="100" src="/upload/foto_hrm/{{ $val->foto_sdm }}"></td>
                                                @else
                                                <td>File Kosong</td>
                                                @endif     
                                                <td><button type=button  class="btn btn-sm btn-success edit_data_sdm" style="width:10px;" id="{{ $val->id }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeletesdm({{ $val->id }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                </td>
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
                                                <th>Pendidikan Terakhir</th>
                                                <th>Foto</th>
                                                 <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                  </div>
                                  <div class="tab-pane fade" id="nav-po" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formModalPO" >+ Tambah Perusahaan Otobus</button>
                                    </div>
                                      <table id="example4" class="table table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
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
                                                <td><button type="button"  class="btn btn-sm btn-success edit_data_po" style="width:10px;" id="{{ $val->id_perusahaan_otobus  }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeletepo({{ $val->id_perusahaan_otobus }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
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
                                    <form method="post" action="/simpanasset" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->id_terminal }}" >
                                      <div class="row">
                                          <div class="col-md-10">
                                              <div class="col-md-5">
                                                  SK Penetapan Lokasi
                                              </div>
                                              <div class="col-md-5">
                                                  <input type="file" class="form-control" multiple name="file_penempatan_lokasi">
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
                                                  <input type="file" class="form-control" name="file_bast_p3d">
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
                                                  <input type="file" class="form-control" name="sertifikat_tanah">
                                              </div>
                                          </div>
                                      </div>
                                      <br>
                                      <div class="row">
                                          <div class="col-md-10">
                                                <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Upload</button>

                                          </div>
                                      </div>
                                      </form>
                                      <br>
                                      <table id="example5" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>File Penempatan Lokasi</th>
                                                    <th>FIle Bast p3d</th>
                                                    <th>Sertifikat Tanah</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataasset as $val)
                                                <tr>
                                                    <td><img class="img img-thumbnail" src="/upload/asset_terminal/{{ $val->file_penempatan_lokasi }}"/></td>
                                                    <td><img class="img img-thumbnail" src="/upload/asset_terminal/{{ $val->file_bast_p3d }}"/></td>
                                                    <td><img class="img img-thumbnail" src="/upload/asset_terminal/{{ $val->sertifikat_tanah }}"/></td>
                                                    <td><a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeleteasset({{ $val->id_data_asset }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>File Penempatan Lokasi</th>
                                                    <th>FIle Bast p3d</th>
                                                    <th>Sertifikat Tanah</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                  </div>
                                </div>
                            </div>
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
                                <form method="post" action="/deletedetailterminal">
                                    @csrf
                                    <div class="col-12">
                                       <center><h5>Apakah anda yakin menghapus data ini ?</h5></center>
                                       <input type="hidden" name="idf" id="iddel">
                                       <input type="hidden" name="type" id="type">
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



     <div class="modal fade text-start" id="myModalAddFoto" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img class="img img-thumbnail" src="" id="imagepreview" style="width: 100%;" >
                            </div>
                       {{--  <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div> --}}
            </div>
        </div>
    </div>




    <div class="modal fade text-start" id="myModalAddfasilitas" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form id="ajaxform" method="post" action="/simpanfasilitas"  enctype="multipart/form-data" >
    @csrf 
        <input type="hidden" name="idterminal"  value="{{ $dataterminal->id_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" >
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Fasilitas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Gambar</label>
                                            <input type="file" class="form-control" name="gambar_fasilitas"required="" oninvalid="this.setCustomValidity('Gambar fasilitas harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Fasilitas</label>
                                            <input type="text" class="form-control" name="nama_fasilitas"   required="" oninvalid="this.setCustomValidity('Nama fasilitas harus diisi')" oninput="setCustomValidity('')">
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kategori</label>
                                            <select class="form-select"  name="kategori"  required="" oninvalid="this.setCustomValidity('Silahkan pilih kategori')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kategori</option>
                                                <option>Faslitas Utama</option>
                                                <option>Faslitas Penunjang</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi"  rows="4" required="" oninvalid="this.setCustomValidity('Deskripsi harus diisi')" oninput="setCustomValidity('')"></textarea>
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


    <!-- Modal edit fasilitas -->
    <div class="modal fade text-start" id="myModalUpdatefasilitas" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatedatapostfasilitas" enctype="multipart/form-data" > 
        @csrf()
        <input type="hidden" name="idf" id="idf">
        <input type="hidden" name="idterminal"  value="{{ $dataterminal->id_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" >
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Fasilitas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png" id="my_image" class="img img-thumbnail" width="120">
                                            <br>
                                            <label class="control-label">Gambar</label>
                                            <input type="file" class="form-control" name="gambar_fasilitas_up" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Fasilitas</label>
                                            <input type="text" class="form-control" name="nama_fasilitas" id="nama_fasilitas"  rrequired="" oninvalid="this.setCustomValidity('Nama fasilitas harus diisi')" oninput="setCustomValidity('')">
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kategori</label>
                                            <select class="form-select"  name="kategori" id="kategori" required="" oninvalid="this.setCustomValidity('Silahkan pilih kategori')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kategori</option>
                                                <option>Faslitas Utama</option>
                                                <option>Faslitas Penunjang</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" required="" oninvalid="this.setCustomValidity('Deskripsi harus diisi')" oninput="setCustomValidity('')" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button class="btn btn-primary save-data"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



    

     <!-- Modal add SDM -->
    <div class="modal fade text-start" id="myModalAddSDM" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpansdmterminal" enctype="multipart/form-data" > 
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->kode_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form SDM</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIP</label>
                                            <input type="text" class="form-control" name="nip"  required="" oninvalid="this.setCustomValidity('NIP harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="nama_sdm" required="" oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jabatan</label>
                                           <input type="text" class="form-control" name="jabatan" required="" oninvalid="this.setCustomValidity('Jabatan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih Tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>ASN</option>
                                                <option>PPNPN</option>
                                                <option>PPNS</option>
                                                <option>Penguji</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Pendidikan Terakhir</label>
                                            <select class="form-select"  name="pendidikan_terakhir"  required="" oninvalid="this.setCustomValidity('Silahkan pilih Pendidikan terakhir')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option>SD</option>
                                                <option>SMP</option>
                                                <option>SMA</option>
                                                <option>D3</option>
                                                <option>S1</option>
                                                <option>S2</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" required="" oninvalid="this.setCustomValidity('No. Telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select" readonly="" disabled="" name="id_wilayah" required="" oninvalid="this.setCustomValidity('Silahkan pilih Wilayah')" oninput="setCustomValidity('')">
                                                <option value="{{ $datawilayah->id_wilayah }}">{{ $datawilayah->nama_wilayah }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                         <div class="form-group mb-1">
                                            <label class="control-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="row">
                                        
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        </div>
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



    <!-- Modal edit SDM -->
    <div class="modal fade text-start" id="myModalAddEditSDM" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostsdmterminal" enctype="multipart/form-data"> 
        @csrf()
        <input type="hidden" name="id" id="idsdm">
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->kode_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form SDM</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIP</label>
                                            <input type="text" class="form-control" name="nip" id="nip"  required="" oninvalid="this.setCustomValidity('NIP harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="nama_sdm" id="nama_sdm" required="" oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jabatan</label>
                                           <input type="text" class="form-control" name="jabatan" id="jabatan" required="" oninvalid="this.setCustomValidity('Jabatan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" id="tipe_sdm" oninvalid="this.setCustomValidity('Silahkan pilih Tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>ASN</option>
                                                <option>PPNPN</option>
                                                <option>PPNS</option>
                                                <option>Penguji</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Pendidikan Terakhir</label>
                                            <select class="form-select"  name="pendidikan_terakhir" id="pendidikan_terakhir" required="" oninvalid="this.setCustomValidity('Silahkan pilih Pendidikan terakhir')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option>SD</option>
                                                <option>SMP</option>
                                                <option>SMA</option>
                                                <option>D3</option>
                                                <option>S1</option>
                                                <option>S2</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp_sdm" required="" oninvalid="this.setCustomValidity('No. Telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select" readonly="" disabled="" id="id_wilayah" name="id_wilayah" required="" oninvalid="this.setCustomValidity('Silahkan pilih Wilayah')" oninput="setCustomValidity('')">
                                                <option value="{{ $datawilayah->id_wilayah }}">{{ $datawilayah->nama_wilayah }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required="" id="alamat_sdm"  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                         <div class="form-group mb-1">
                                            <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png" id="my_image" class="img img-thumbnail" width="250">
                                        </div>
                                         <div class="form-group mb-1">
                                            <label class="control-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="row">
                                        
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" id="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" id="id_kota_sdm" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



     <!-- Modal add PO -->
    <div class="modal fade text-start" id="myModalAddPO" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpanpoterminal" enctype="multipart/form-data" > 
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->kode_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Perusahaan Otobus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode PO Bus</label>
                                            <input type="text" class="form-control" name="kode_po_bus" required="" oninvalid="this.setCustomValidity('Kode PO bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama PO Bus</label>
                                            <input type="text" class="form-control" name="nama_po_bus"  required="" oninvalid="this.setCustomValidity('Nama PO Bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Direktur</label>
                                            <input type="text" class="form-control" name="nama_direktur" required="" oninvalid="this.setCustomValidity('Nama direktur harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Izin</label>
                                            <input type="text" class="form-control" name="no_izin" required="" oninvalid="this.setCustomValidity('Nomor Izin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kota</option>
                                                <option>AKAP</option>
                                                <option>AKADP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="6" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
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



    <!-- Modal edit PO -->
    <div class="modal fade text-start" id="myModalUpdatePO" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatedatapobusterminal"> 
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->kode_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        @csrf()
        <input type="hidden" name="id" id="idpo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Perusahaan Otobus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode PO Bus</label>
                                            <input type="text" class="form-control" name="kode_po_bus" id="kode_po_bus" required="" oninvalid="this.setCustomValidity('Kode PO bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama PO Bus</label>
                                            <input type="text" class="form-control" name="nama_po_bus" id="nama_po_bus"  required="" oninvalid="this.setCustomValidity('Nama PO Bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Direktur</label>
                                            <input type="text" class="form-control" name="nama_direktur" id="nama_direktur" required="" oninvalid="this.setCustomValidity('Nama direktur harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Izin</label>
                                            <input type="text" class="form-control" name="no_izin" id="no_izin" required="" oninvalid="this.setCustomValidity('Nomor Izin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" id="tipe_po" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kota</option>
                                                <option>AKAP</option>
                                                <option>AKADP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp_po" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="6" id="alamat_po" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" id="kode_pos_po" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" id="id_kota_po" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



    <!-- Modal add trayek -->
    <div class="modal fade text-start" id="myModalAddTrayek" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpantrayekterminal" > 
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->id_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Trayek</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Trayek</label>
                                            <input type="text" class="form-control" name="kode_trayek" required="" oninvalid="this.setCustomValidity('Kode trayek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Trayek</label>
                                            <input type="text" class="form-control" name="nama_trayek" required="" oninvalid="this.setCustomValidity('Nama trayek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Rute</label>
                                            <textarea  class="form-control" name="rute" required="" rows="4" oninvalid="this.setCustomValidity('Rute harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
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



    <!-- Modal edit trayek -->
    <div class="modal fade text-start" id="myModalUpdateTrayek" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatedatatrayekterminal"> 
        <input type="hidden" name="id_terminal"  value="{{ $dataterminal->id_terminal }}" required="" oninvalid="this.setCustomValidity('Kode terminal harus diisi')" oninput="setCustomValidity('')">
        @csrf()
        <input type="hidden" name="id" id="idtry">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Trayek</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Trayek</label>
                                            <input type="text" class="form-control" name="kode_trayek" id="kode_trayek" required="" oninvalid="this.setCustomValidity('Kode trayek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Trayek</label>
                                            <input type="text" class="form-control" name="nama_trayek" id="nama_trayek" required="" oninvalid="this.setCustomValidity('Nama trayek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Rute</label>
                                            <textarea  class="form-control" name="rute" id="rute" required="" rows="4" oninvalid="this.setCustomValidity('Rute harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" id="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
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

    <!-- Modal edit -->

    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });
        $(document).on('click','.formfasilitas',function(){
             $('#myModalAddfasilitas').modal('show');
        });
        $(document).on('click','.formfasilitasSDM',function(){
             $('#myModalAddSDM').modal('show');
        });

        $(document).on('click','.formModalPO',function(){
             $('#myModalAddPO').modal('show');
        });

        $(document).on('click','.formTrayek',function(){
             $('#myModalAddTrayek').modal('show');
        });

        $(document).on('click','.foto',function(){
          //  $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
           var imagefoto = $(this).attr('src');
           $('#imagepreview').attr('src',imagefoto); 
             $('#myModalAddFoto').modal('show');
        });
        
      //  $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedataterminal/'+ {{$dataterminal->id_terminal}},
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id_terminal);
                      $('#kode_terminal').val(data.data.kode_terminal);
                      $('#nama_terminal').val(data.data.nama_terminal);
                      $('#no_telp').val(data.data.no_telp);
                      
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
                      var titik_koordinat = JSON.parse(data.data.titik_koordinat);
                      console.log('cektitik',titik_koordinat[0].lat);
                      $('#lat').val(titik_koordinat[0].lat);
                      $('#long').val(titik_koordinat[0].long);
                  }
                })
        //  });
    
    $(document).on('click','.edit_data_fasilitas',function(){
        var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatefasilitas/'+ idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datafasilitas',data);
                      $('#idf').val(data.data.id_fasilitas);
                      $('#nama_fasilitas').val(data.data.nama_fasilitas);
                      $('#kategori').val(data.data.kategori);
                      $('#deskripsi').val(data.data.deskripsi);
                      $('#my_image').attr('src','/upload/fasilitas/'+data.data.gambar_fasilitas);
                      $('#myModalUpdatefasilitas').modal('show');
                  }
                })
    });

    });

    $(document).on('click','.edit_data_sdm',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/updatesdm/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datajesdm',data);
                      $('#idsdm').val(data.data.id);
                      $('#nip').val(data.data.nip);
                      $('#nama_sdm').val(data.data.nama_sdm);
                      $('#jabatan').val(data.data.jabatan);
                      $('#tipe_sdm').val(data.data.tipe);
                      $('#no_telp_sdm').val(data.data.no_telp);
                      $('#id_wilayah').val(data.datawilayah.id_wilayah);
                      $('#alamat_sdm').val(data.data.alamat);
                      $('#kode_pos').val(data.data.kode_pos);
                      $('#id_kota_sdm').val(data.data.id_kota);
                      $('#pendidikan_terakhir').val(data.data.pendidikan_terakhir);
                      $('#my_image').attr('src','/upload/foto_hrm/'+data.data.foto_sdm);
                      $('#myModalAddEditSDM').modal('show');
                  }
                })
          });

    $(document).on('click','.edit_data_po',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedatapo/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#idpo').val(data.data.id_perusahaan_otobus);
                      $('#kode_po_bus').val(data.data.kode_po);
                      $('#nama_po_bus').val(data.data.nama_po);
                      $('#nama_direktur').val(data.data.nama_direktur);
                      $('#no_izin').val(data.data.no_izin);
                      $('#tgl_kadaluarsa').val(data.data.tgl_kadaluarsa);
                      $('#tipe_po').val(data.data.tipe);
                      $('#no_telp_po').val(data.data.no_telp);
                      $('#alamat_po').val(data.data.alamat);
                      $('#kode_pos_po').val(data.data.kode_pos);
                      $('#id_kota_po').val(data.data.id_kota);
                      $('#myModalUpdatePO').modal('show');
                  }
                })
    });

    $(document).on('click','.edit_data_trayek',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatetrayek/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#idtry').val(data.data.id_trayek);
                      $('#kode_trayek').val(data.data.kode_trayek);
                      $('#nama_trayek').val(data.data.nama_trayek);
                      $('#rute').val(data.data.rute);
                      $('#myModalUpdateTrayek').modal('show');
                  }
                })
          });



    function confdeletefas(val){
            document.getElementById('iddel').value= val;
            document.getElementById('type').value= "fas";
    }
    function confdeletesdm(val){
            document.getElementById('iddel').value= val;
            document.getElementById('type').value= "sdm";
    }
    function confdeletepo(val){
            document.getElementById('iddel').value= val;
            document.getElementById('type').value= "po";
    }
    function confdeletetry(val){
            document.getElementById('iddel').value= val;
            document.getElementById('type').value= "trayek";
    }
    function confdeleteasset(val)
    {   
            document.getElementById('iddel').value= val;
            document.getElementById('type').value= "asset";
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
            document.getElementById('getgateup').style.display = "inline";
       }
    }


  </script>
    
@endsection