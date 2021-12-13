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
                             @if($menu->create==1)
                            <h2 class="content-header-title float-start mb-0"><a class="btn btn-success" href="/importkendaraan">Import</a></h2>
                            @endif
                            <h2 class="content-header-title float-start mb-0">Data Kendaraan Tiba</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Operasional Terminal</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produksi Kendaraan</a>
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
                @if($menu->create==1)
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah Kendaraan Tiba</button>
                </div>
                @endif
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
<div style="padding-bottom: 10px; font-size: 12px;">
<table id="example" class="table table-responsive table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
                <th>Nama Terminal</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Nama Petugas</th>
                <th>No. Kendaraan</th>
                <th>Perusahaan ID</th>
                <th>Nama Perusahaan</th>
                <th>Jenis Kendaraan</th>
                {{-- <th>Status Spionam</th>
                <th>Status E-blue</th> --}}
                <th>Jenis Angkutan</th>
                <th>Foto Kendaraan</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kendaraan_tiba as $val)
            <tr>
                <th>{{ $val->nama_terminal }}</th>
                <td>{{ $val->tgl }}</td>
                <td>{{ $val->jam }}</td>
                @if($val->nama_sdm=="")
                <td>{{ $val->nama_admin }}</td>
                @else
                <td>{{ $val->nama_sdm }}</td>
                @endif
                @if($val->no_kendaraan==null)
                <td>{{ $val->no_kendaraan }}</td>
                @else
                 <td>{{ $val->noken }}</td>
                @endif
                <td>{{ $val->kode_po }}</td>
                <td>{{ $val->nama_po }}</td>
                <td>{{ $val->jenis_kendaraan }}</td>
                {{-- <?php
                $datenow = date('Y-m-d');
                if($datenow <= substr($val->tgl_kadaluarsa,0,10)){
                ?>
                <td>True</td>
                <?php 
                } else {
                ?>
                <td>{{ substr($val->tgl_kadaluarsa,0,10) }}</td>
                <?php 
                }
                ?>

                <?php
                $datenow = date('Y-m-d');
                if($datenow  <= $val->tgl_kadaluarsa_kps){
                ?>
                <td>{{ substr($val->tgl_kadaluarsa_kps,0,10) }}</td>
                <?php 
                } else {
                ?>
                <td>False</td>
                <?php 
                }
                ?> --}}

                <td>{{ $val->tipe_kendaraan }}</td>
                <td><a href="/fotokendaraan/{{ $val->no_kendaraan }}/{{ $val->jam }}/tiba" class="btn btn-secondary btn-sm view_foto" id="{{ $val->no_kendaraan }}">Lihat Foto</a></td>
                <td>
                    @if($menu->update==1)
                    <button  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id_kendaraan_tiba }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  
                    @endif
                    @if($menu->delete==1)
                    <a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_kendaraan_tiba }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama Terminal</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Nama Petugas</th>
                <th>No. Kendaraan</th>
                <th>Perusahaan ID</th>
                <th>Nama Perusahaan</th>
                <th>Jenis Kendaraan</th>
                {{-- <th>Status Spionam</th>
                <th>Status E-blue</th> --}}
                <th>Jenis Angkutan</th>
                <th>Foto Kendaraan</th>
                <th>Opsi</th>
            </tr>
        </tfoot>
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

    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpankendaraantiba" enctype="multipart/form-data" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Kendaraan Tiba</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nomor Kendaraan</label>
                                            <select class="form-select kendaraanhfunc"  name="no_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih kendaraan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kendaraan</option>
                                                @foreach($kendaraan as $val)
                                                <option value="{{ $val->no_kendaraan }}">{{ $val->no_kendaraan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            {{-- <select class="form-select"  name="id_terminal" required="" disabled="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="{{ $dataterminalget->id_wilayah }}">{{ $dataterminalget->nama_wilayah }}</option>
                                            </select> --}}
                                            <input type="text" class="form-control" name="terminal_asal" id="terminal_asal" required="" value="{{ $dataterminalget->nama_wilayah }}" readonly oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Petugas</label>
                                            <input type="text" class="form-control" name="nama" value="{{ Auth::user()->name }}" readonly="">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">ID PO Bus</label>
                                            <input type="text" class="form-control" id="kode_po" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <input type="text" class="form-control" id="nama_trayek" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <input type="text" class="form-control" id="jenis_kendaraanA" disabled="" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Angkutan</label>
                                            <input type="text" class="form-control" id="tipe_kendaraan" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>    
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            <input type="number" class="form-control" name="kapasitas" disabled="" required="" oninvalid="this.setCustomValidity('Kapasitas harus diisi')" oninput="setCustomValidity('')">
                                        </div> --}}
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal Tujuan</label>
                                            <select class="form-select"  name="terminal_tujuan" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tujuan</option>
                                                @foreach($dataterminal as $vv)
                                                <option value="{{ $vv->id_terminal }}">{{ $vv->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div>     --}}                               
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group mb-1">
                                            <label class="control-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tgl" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>       
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jam</label>
                                            <input type="time" class="form-control" name="jam" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Status Spionam</label>
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="spinoam1" name="status_spinoam" value="1">
                                                    <span>Valid</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="spinoam2" name="status_spinoam" value="0">
                                                    <span>Expired</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="date" class="form-control" disabled="" name="no_uji" id="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="date" class="form-control" disabled="" name="no_uji" id="tgl_kadaluarsa_kps" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Status E-blue</label>
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="eblue1"  name="eblue" value="1">
                                                    <span>Valid</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="eblue2"  name="eblue" value="0">
                                                    <span>Expired</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku</label>
                                            <input type="date" class="form-control" disabled="" disabled="" id="masa_berlaku_kendaraan" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa kps harus diisi')" oninput="setCustomValidity('')">
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Catatan</label>
                                            <textarea class="form-control" name="catatan" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



    <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalUpdatetiba" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatekendaraantiba"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Kendaraan Tiba</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nomor Kendaraan</label>
                                            <select class="form-select kendaraanhfuncup"  name="no_kendaraan" id="no_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih kendaraan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kendaraan</option>
                                                @foreach($kendaraan as $val)
                                                <option value="{{ $val->no_kendaraan }}">{{ $val->no_kendaraan }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control kendaraanhfuncup" name="no_kendaraan" id="no_kendaraan" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')"> --}}
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            <select class="form-select"  name="id_terminal"  required="" disabled="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="{{ $dataterminalget->id_wilayah }}">{{ $dataterminalget->nama_wilayah }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Petugas</label>
                                            <input type="text" class="form-control" name="nama" id="namaup" value="{{ Auth::user()->name }}" readonly="">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">ID PO Bus</label>
                                            <input type="text" class="form-control" id="kode_poup" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <input type="text" class="form-control" id="nama_trayekup" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <input type="text" class="form-control" id="jenis_kendaraanAup" disabled="" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Angkutan</label>
                                            <input type="text" class="form-control" id="tipe_kendaraanup" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>    
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            <input type="number" class="form-control" name="kapasitas" disabled="" required="" oninvalid="this.setCustomValidity('Kapasitas harus diisi')" oninput="setCustomValidity('')">
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal Tujuan</label>
                                            <select class="form-select"  name="terminal_tujuan" id="terminal_tujuanup" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tujuan</option>
                                                @foreach($dataterminal as $vv)
                                                <option value="{{ $vv->id_terminal }}">{{ $vv->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div>                                   
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group mb-1">
                                            <label class="control-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tgl" id="tglup" required="">
                                        </div>       
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jam</label>
                                            <input type="time" class="form-control" name="jam" id="jamup" required="" >
                                        </div>
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Status Spionam</label>
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="spinoam1up" name="status_spinoam" value="1">
                                                    <span>Valid</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" disabled="" id="spinoam2up" name="status_spinoam" value="0">
                                                    <span>Expired</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="date" class="form-control" disabled="" name="no_uji" id="tgl_kadaluarsaup" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <input type="date" class="form-control" disabled="" name="no_uji" id="tgl_kadaluarsa_kpsup" required="" oninvalid="this.setCustomValidity('No. uji harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Status E-blue</label>
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" id="eblue1up"  name="eblue" value="1">
                                                    <span>Valid</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="radio" class="form-check-input" id="eblue2up"  name="eblue" value="0">
                                                    <span>Expired</span>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku</label>
                                            <input type="date" class="form-control" disabled="" disabled="" id="masa_berlaku_kendaraanup" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa kps harus diisi')" oninput="setCustomValidity('')">
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Catatan</label>
                                            <textarea class="form-control" name="catatan"  id="catatanup" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form> 
    </div>


    <!-- Modal edit -->
    <div class="modal fade text-start" id="layoutfoto" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Kendaraan Tiba</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Foto 
                            </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
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
                                <form method="post" action="/deletekendaraantiba">
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

    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });
        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedatakendaraantiba/'+idubh+'/'+ {{ Auth::user()->id }},
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#no_kendaraan').val(data.data.no_kendaraan)
                      $('#kode_poup').val(data.data.kode_po)
                      $('#nama_trayekup').val(data.data.nama_trayek)
                      $('#jenis_kendaraanAup').val(data.data.jenis_kendaraan)
                      $('#tipe_kendaraanup').val(data.data.tipe_kendaraan)
                      $('#nama_trayekup').val(data.data.nama_trayek)
                      $('#terminal_tujuanup').val(data.data.terminal_tujuan)
                      $('#tglup').val(data.data.tgl)
                      $('#jamup').val(data.data.jam)
                      $('#catatanup').val(data.data.catatan)
                      $('#tgl_kadaluarsaup').val(data.data.tglkadaluarsa);
                      $('#tgl_kadaluarsa_kpsup').val(data.data.tgl_kadaluarsa_kps);
                      $('#masa_berlaku_kendaraanup').val(data.data.masa_berlaku_kendaraan);
                       $('#id').val(data.data.id_kendaraan_tiba)
                      //  document.getElementById("no_kendaraan").setAttribute("readonly", "true");
                      // let tgl_kadaluarsa = document.getElementById('tgl_kadaluarsaup').value;
                      // let tgl_kadaluarsa_kps = document.getElementById('tgl_kadaluarsa_kpsup').value;
                      // let masa_berlaku_kendaraan = document.getElementById('masa_berlaku_kendaraanup').value;
                      // var d = new Date(tgl_kadaluarsa);
                      // var n = d.getTime();

                      // var dkps = new Date(tgl_kadaluarsa_kps);
                      // var nkps = dkps.getTime();
                      // if(n  <=  nkps){
                      //   document.getElementById("spinoam2up").checked = false;
                      //   document.getElementById("spinoam1up").checked = true;
                      // } else {
                      //   document.getElementById("spinoam2up").checked = true;
                      //   document.getElementById("spinoam1up").checked = false;
                      // }
                      // var dk = new Date(masa_berlaku_kendaraan);
                      // var nk = dk.getTime();
                      // var dnow = Date.now;
                      // if(nk <= dnow ){
                      //   document.getElementById("eblue2up").checked = false;
                      //   document.getElementById("eblue1up").checked = true;
                      // } else {
                      //   document.getElementById("eblue2up").checked = false;
                      //   document.getElementById("eblue1up").checked = true;
                      // }


                      $('#myModalUpdatetiba').modal('show');
                  }
                })
          });

        $(document).on('change','.kendaraanhfunc',function(){
             var idubh = $(this).val();
                $.ajax({
                  url :'/api/getkendaraan/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datakendaraangetmen',data);
                      //$('#id').val(data.data.id_kendaraan);
                      $('#kode_po').val(data.data.kode_po);
                      $('#nama_trayek').val(data.data.nama_trayek);
                      $('#jenis_kendaraanA').val(data.data.jenis_kendaraan);
                      $('#tipe_kendaraan').val(data.data.tipe_kendaraan);
                      $('#tgl_kadaluarsa').val(data.data.tglkadaluarsa);
                      $('#tgl_kadaluarsa_kps').val(data.data.tgl_kadaluarsa_kps);
                      $('#masa_berlaku_kendaraan').val(data.data.masa_berlaku_kendaraan);
                      let tgl_kadaluarsa = document.getElementById('tgl_kadaluarsa').value;
                      let tgl_kadaluarsa_kps = document.getElementById('tgl_kadaluarsa_kps').value;
                      let masa_berlaku_kendaraan = document.getElementById('masa_berlaku_kendaraan').value;
                      var d = new Date(tgl_kadaluarsa);
                      var n = d.getTime();

                      var dkps = new Date(tgl_kadaluarsa_kps);
                      var nkps = dkps.getTime();
                      if(n  <=  nkps){
                        document.getElementById("spinoam2").checked = false;
                        document.getElementById("spinoam1").checked = true;
                      } else {
                        document.getElementById("spinoam2").checked = true;
                        document.getElementById("spinoam1").checked = false;
                      }
                      var dk = new Date(masa_berlaku_kendaraan);
                      var nk = dk.getTime();
                      var dnow = Date.now;
                      if(nk <= dnow ){
                        document.getElementById("eblue2").checked = false;
                        document.getElementById("eblue1").checked = true;
                      } else {
                        document.getElementById("eblue2").checked = false;
                        document.getElementById("eblue1").checked = true;
                      }

                  }
                })
          });

        $(document).on('change','.kendaraanhfuncup',function(){
             var idubh = $(this).val();
                $.ajax({
                  url :'/api/getkendaraan/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datakendaraangetmen',data);
                      $('#no_kendaraan').val(data.data.no_kendaraan);
                      $('#kode_poup').val(data.data.kode_po);
                      $('#nama_trayekup').val(data.data.nama_trayek);
                      $('#jenis_kendaraanAup').val(data.data.jenis_kendaraan);
                      $('#tipe_kendaraanup').val(data.data.tipe_kendaraan);
                      $('#tgl_kadaluarsaup').val(data.data.tgl_kadaluarsa);
                      $('#tgl_kadaluarsa_kpsup').val(data.data.tgl_kadaluarsa_kps);
                      $('#masa_berlaku_kendaraanup').val(data.data.masa_berlaku_kendaraan);
                      $('#tglup').val(data.data.tgl);
                      $('#jamup').val(data.data.jam);
                      let tgl_kadaluarsa = document.getElementById('tgl_kadaluarsaup').value;
                      let tgl_kadaluarsa_kps = document.getElementById('tgl_kadaluarsa_kpsup').value;
                      let masa_berlaku_kendaraan = document.getElementById('masa_berlaku_kendaraanup').value;
                      var d = new Date(tgl_kadaluarsa);
                      var n = d.getTime();

                      var dkps = new Date(tgl_kadaluarsa_kps);
                      var nkps = dkps.getTime();
                      if(n  <=  nkps){
                        document.getElementById("spinoam2up").checked = false;
                        document.getElementById("spinoam1up").checked = true;
                      } else {
                        document.getElementById("spinoam2up").checked = true;
                        document.getElementById("spinoam1up").checked = false;
                      }
                      var dk = new Date(masa_berlaku_kendaraan);
                      var nk = dk.getTime();
                      var dnow = Date.now;
                      if(nk <= dnow ){
                        document.getElementById("eblue2up").checked = false;
                        document.getElementById("eblue1up").checked = true;
                      } else {
                        document.getElementById("eblue2up").checked = false;
                        document.getElementById("eblue1up").checked = true;
                      }

                  }
                })
          });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection