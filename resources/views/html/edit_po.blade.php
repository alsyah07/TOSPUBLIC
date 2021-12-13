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
                            <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/po"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2>
                            <h2 class="content-header-title float-start mb-0">Data PO Bus</h2>
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
                            <div class="card ">
                                {{-- <div class="card-header border-bottom">
                                    <h4 class="card-title">Row Grouping</h4>
                                </div> --}}

                                <!-- Modal edit PO -->
    <div class="modals fades text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatedatapobus"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form PO Bus</h4>
                        
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
                                            <input type="text" class="form-control" name="nama_direktur" id="nama_direktur">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Izin</label>
                                            <input type="text" class="form-control" name="no_izin" id="no_izin">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" id="tipe" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kota</option>
                                                <option>AKAP</option>
                                                <option>AKADP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="6" id="alamat" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" id="kode_pos">
                                        </div>
                                        
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" id="id_kota" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                    <div class="">
                             <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-kendaraan" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kendaraan</button>
                                    {{-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-fasilitas" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Fasilitas</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-sdm" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">SDM</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-po" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Perusahaan Otobus</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-dataasset" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Data Asset</button> --}}
                                  </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="nav-kendaraan" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formkendaraan" >+ Tambah Kendaraan</button>
                                    </div>
                                      <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. Kendaraan</th>
                                            <th>Trayek</th>
                                            <th>Pbo</th>
                                            <th>No. Uji</th>
                                            <th>Tahun Buat</th>
                                            <th>Kapasitas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datakendaraan as $val)
                                        <tr>
                                            <td>{{ $val->no_kendaraan }}</td>
                                            <td>{{ $val->nama_trayek }}</td>
                                            <td>{{ $val->nama_po }}</td>
                                            <td>{{ $val->no_uji }}</td>
                                            <td>{{ $val->tahun }}</td>
                                            <td>{{ $val->kapasitas }}</td>
                                            <td><button type="button"  class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->idks  }}"><i class="fas fa-edit"></i></button>  <a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->idks }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No. Kendaraan</th>
                                            <th>Trayek</th>
                                            <th>Pbo</th>
                                            <th>No. Uji</th>
                                            <th>Tahun Buat</th>
                                            <th>Kapasitas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
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
    

    
<!-- Modal add kendaraan -->
    <div class="modal fade text-start" id="myModalAddKendaraan" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpankendaraanpo" enctype="multipart/form-data" > 
        <input type="hidden" name="id_perusahaan_otobus" value="{{ $datapo->id_perusahaan_otobus }}">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Kendaraan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Kendaraan</label>
                                            <input type="text" class="form-control" name="no_kendaraan" required="" oninvalid="this.setCustomValidity('No. kendaraan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Rangka</label>
                                            <input type="text" class="form-control" name="no_rangka"  required="" oninvalid="this.setCustomValidity('No. rangka harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Mesin</label>
                                            <input type="text" class="form-control" name="no_mesin" required="" oninvalid="this.setCustomValidity('No. mesin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Merek</label>
                                            <input type="text" class="form-control" name="merek" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <select class="form-select"  name="jenis_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih jenis kendaraan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Jenis Kendaraan</option>
                                                <option>Mobil Penumpang Umum</option>
                                                <option>Bus Kecil</option>
                                                <option>Bus Sedang</option>
                                                <option>Bus Besar Lantai Tunggal</option>
                                                <option>Bis Besar Laintai Ganda</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tahun</label>
                                            <select class="form-select"  name="tahun" required="" oninvalid="this.setCustomValidity('Silahkan pilih tahun')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tahun</option>
                                                <?php
                                                $tahunkendaraan = 1921;
                                                    for($i= $tahunkendaraan; $i <= 2021; $i++){
                                                        $arytahun = $i;
                                                ?>
                                                <option>{{ $arytahun }}</option>
                                                <?php
                                                 }
                                                ?> 
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">kapasitas</label>
                                            <input type="number" class="form-control" name="kapasitas" placeholder="Orang" required="" oninvalid="this.setCustomValidity('Kapasitas harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>AKAP</option>
                                                <option>AKDP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Perusahaan</label>
                                            <select class="form-select"  name="id_perusahaan_otobusd" disabled="" required="" oninvalid="this.setCustomValidity('Silahkan pilih Perusahaan')" oninput="setCustomValidity('')">
                                                <option value="">{{ $datapo->nama_po }}</option>
                                            </select>
                                        </div>    
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <select class="form-select"  name="id_trayek" required="" oninvalid="this.setCustomValidity('Silahkan pilih trayek')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Trayek</option>
                                                @foreach($datatryek as $val)
                                                <option value="{{ $val->id_trayek }}">{{ $val->nama_trayek }}</option>
                                                @endforeach
                                            </select>
                                        </div>            
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Uji</label>
                                            <input type="number" class="form-control" name="no_uji" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. KPS</label>
                                            <input type="number" class="form-control" name="no_kps" required="" oninvalid="this.setCustomValidity('No. Kps harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa KPS</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa_kps" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa kps harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. SRUT</label>
                                            <input type="number" class="form-control" name="no_srut" required="" oninvalid="this.setCustomValidity('No. srut harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku Kendaraan</label>
                                            <input type="date" class="form-control" name="masa_berlaku_kendaraan" required="" oninvalid="this.setCustomValidity('Masa berlaku kendaraan harus diisi')" oninput="setCustomValidity('')">
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



    <!-- Modal edit kendaraan -->
    <div class="modal fade text-start" id="myModalUpdatekendaraan" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatekendaraanpo"> 
        <input type="hidden" name="id_perusahaan_otobus" value="{{ $datapo->id_perusahaan_otobus }}">
        @csrf()
        <input type="hidden" name="id" id="idkendaraan">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Kendaraan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Kendaraan</label>
                                            <input type="text" class="form-control" name="no_kendaraan" id="no_kendaraan" required="" oninvalid="this.setCustomValidity('No. kendaraan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Rangka</label>
                                            <input type="text" class="form-control" name="no_rangka" id="no_rangka"  required="" oninvalid="this.setCustomValidity('No. rangka harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Mesin</label>
                                            <input type="text" class="form-control" name="no_mesin" id="no_mesin" required="" oninvalid="this.setCustomValidity('No. mesin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Merek</label>
                                            <input type="text" class="form-control" name="merek" id="merek" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <select class="form-select"  name="jenis_kendaraan" id="jenis_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih jenis kendaraan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Jenis Kendaraan</option>
                                                <option>Mobil Penumpang Umum</option>
                                                <option>Bus Kecil</option>
                                                <option>Bus Sedang</option>
                                                <option>Bus Besar Lantai Tunggal</option>
                                                <option>Bis Besar Laintai Ganda</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tahun</label>
                                            <select class="form-select"  name="tahun" id="tahun" required="" oninvalid="this.setCustomValidity('Silahkan pilih tahun')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tahun</option>
                                                <?php
                                                $tahunkendaraan = 1921;
                                                    for($i= $tahunkendaraan; $i <= 2021; $i++){
                                                        $arytahun = $i;
                                                ?>
                                                <option>{{ $arytahun }}</option>
                                                <?php
                                                 }
                                                ?> 
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">kapasitas</label>
                                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Orang" required="" oninvalid="this.setCustomValidity('Kapasitas harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" id="tipe_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>AKAP</option>
                                                <option>AKDP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Perusahaan</label>
                                            <select class="form-select"  name="id_perusahaan_otobus" id="id_perusahaan_otobus" required="" oninvalid="this.setCustomValidity('Silahkan pilih Perusahaan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Perusahaan</option>
                                                @foreach($dataperusahaanotobus as $val)
                                                <option value="{{ $val->id_perusahaan_otobus }}">{{ $val->nama_po }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <select class="form-select"  name="id_trayek" id="id_trayek" required="" oninvalid="this.setCustomValidity('Silahkan pilih trayek')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Trayek</option>
                                                @foreach($datatryek as $val)
                                                <option value="{{ $val->id_trayek }}">{{ $val->nama_trayek }}</option>
                                                @endforeach
                                            </select>
                                        </div>            
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Uji</label>
                                            <input type="number" class="form-control" name="no_uji" id="no_uji" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa_kendaraan" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. KPS</label>
                                            <input type="number" class="form-control" name="no_kps" id="no_kps" required="" oninvalid="this.setCustomValidity('No. Kps harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa KPS</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa_kps" id="tgl_kadaluarsa_kps" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa kps harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. SRUT</label>
                                            <input type="number" class="form-control" name="no_srut" id="no_srut" required="" oninvalid="this.setCustomValidity('No. srut harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku Kendaraan</label>
                                            <input type="date" class="form-control" name="masa_berlaku_kendaraan" id="masa_berlaku_kendaraan" required="" oninvalid="this.setCustomValidity('Masa berlaku kendaraan harus diisi')" oninput="setCustomValidity('')">
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



    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletepokendaraan">
                                    @csrf
                                    <div class="col-12">
                                       <center><h5>Apakah anda yakin menghapus data ini ?</h5></center>
                                       <input type="hidden" name="id" id="iduser">
                                       <input type="hidden" name="type" id="pokend">
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

    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });
        $(document).on('click','.formkendaraan',function(){
             $('#myModalAddKendaraan').modal('show');
        });
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedatapo/'+{{ $datapo->id_perusahaan_otobus }},
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id_perusahaan_otobus);
                      $('#kode_po_bus').val(data.data.kode_po);
                      $('#nama_po_bus').val(data.data.nama_po);
                      $('#nama_direktur').val(data.data.nama_direktur);
                      $('#no_izin').val(data.data.no_izin);
                      $('#tgl_kadaluarsa').val(data.data.tgl_kadaluarsa);
                      $('#tipe').val(data.data.tipe);
                      $('#no_telp').val(data.data.no_telp);
                      $('#alamat').val(data.data.alamat);
                      $('#kode_pos').val(data.data.kode_pos);
                      $('#id_kota').val(data.data.id_kota);
                  }
                });
        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedatakendaraan/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#idkendaraan').val(data.data.id_kendaraan);
                      $('#no_kendaraan').val(data.data.no_kendaraan);
                      $('#no_rangka').val(data.data.no_rangka);
                      $('#no_mesin').val(data.data.no_mesin);
                      $('#merek').val(data.data.merek);
                      $('#jenis_kendaraan').val(data.data.jenis_kendaraan);
                      $('#tahun').val(data.data.tahun);
                      $('#kapasitas').val(data.data.kapasitas);
                      $('#id_perusahaan_otobus').val(data.data.id_perusahaan_otobus);
                      $('#id_trayek').val(data.data.id_trayek);
                      $('#no_uji').val(data.data.no_uji);
                      $('#tgl_kadaluarsa_kendaraan').val(data.data.tgl_kadaluarsa);
                      $('#no_kps').val(data.data.no_kps);
                      $('#tgl_kadaluarsa_kps').val(data.data.tgl_kadaluarsa_kps);
                      $('#no_srut').val(data.data.no_srut);
                      $('#masa_berlaku_kendaraan').val(data.data.masa_berlaku_kendaraan);
                      $('#tipe_kendaraan').val(data.data.tipe_kendaraan);
                      $('#myModalUpdatekendaraan').modal('show');
                  }
                })
          });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection