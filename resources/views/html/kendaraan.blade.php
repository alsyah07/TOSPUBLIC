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
                            <h2 class="content-header-title float-start mb-0">Data Kendaraan</h2>
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
                <div class="row">
                    <div class="col-md-6 content-header-left">
                         <a href="/refreshkendaraan"  class="btn btn-success"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                    @if($menu->create==1)
                     <div class="col-md-6 content-header-right text-md-end">
                         <button type="button" class="btn btn-primary registerusers" >+ Tambah Kendaraan</button>
                    </div>
                    @endif
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                   
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
<div style="padding-bottom: 10px; font-size: 12px;">
<table id="example" class="table table-striped table-responsive" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
                <th>No. Kendaraan</th>
                <th>Trayek</th>
                <th>Pbo</th>
                <th>No. Uji</th>
                <th>Tahun Buat</th>
                <th>Kapasitas</th>
                <th>Status Spionam</th>
                <th>Status E-blue</th>
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
                <?php
                $datenow = date('Y-m-d');
                if($datenow <= substr($val->tgl_kadaluarsa,0,10)){
                ?>
                <td>True</td>
                <?php 
                } else {
                ?>
                <td>False</td>
                <?php 
                }
                ?>

                <?php
                $datenow = date('Y-m-d');
                if($datenow  <= $val->tgl_kadaluarsa_kps){
                ?>
                <td>True</td>
                <?php 
                } else {
                ?>
                <td>False</td>
                <?php 
                }
                ?>
                <td>
                    @if($menu->update==1)
                    <button  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->idks }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  
                    @endif
                    @if($menu->delete==1)
                    <a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->idks }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
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
                <th>Status Spionam</th>
                <th>Status E-blue</th>
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
    <form class="form" method="post" action="/simpankendaraan" enctype="multipart/form-data" > 
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
                                            <input type="text" class="form-control inputdatakendaraan" id="nomor_kendaraan" name="no_kendaraan" required="" oninvalid="this.setCustomValidity('No. kendaraan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Rangka</label>
                                            <input type="text" class="form-control" name="no_rangka" id="no_rangka_input"  required="" oninvalid="this.setCustomValidity('No. rangka harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Mesin</label>
                                            <input type="text" class="form-control" name="no_mesin" id="no_mesin_input" required="" oninvalid="this.setCustomValidity('No. mesin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Merek</label>
                                            <input type="text" class="form-control" name="merek" id="merek_input" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <select class="form-select"  name="jenis_kendaraan" id="jenis_kendaraan_input" >
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
                                            <select class="form-select"  name="tahun" id="tahun_input" required="" oninvalid="this.setCustomValidity('Silahkan pilih tahun')" oninput="setCustomValidity('')">
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
                                            <label class="control-label">Kapasitas</label>
                                            <input type="number" class="form-control" name="kapasitas" id="kapasitas_input" placeholder="Orang" r>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" id="tipe_input" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
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
                                            <select class="form-select"  name="id_perusahaan_otobus" id="id_perusahaan_otobus_input" required="" oninvalid="this.setCustomValidity('Silahkan pilih Perusahaan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Perusahaan</option>
                                                @foreach($dataperusahaanotobus as $val)
                                                <option value="{{ $val->kode_po }}">{{ $val->nama_po }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <select class="form-select"  name="id_trayek" id="id_trayek_input" required="" oninvalid="this.setCustomValidity('Silahkan pilih trayek')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Trayek</option>
                                                @foreach($datatrayek as $val)
                                                <option value="{{ $val->kode_trayek }}">{{ $val->nama_trayek }}</option>
                                                @endforeach
                                            </select>
                                        </div>            
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Uji</label>
                                            <input type="text" class="form-control" name="no_uji" id="no_uji_input">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa Spionam</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa_input" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa spionam harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. KPS</label>
                                            <input type="number" class="form-control" name="no_kps" id="no_kps_input" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa Eblue</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa_kps" id="tgl_kadaluarsa_kps_input" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa eblue harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. SRUT</label>
                                            <input type="number" class="form-control" name="no_srut" id="no_srut" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku Kendaraan</label>
                                            <input type="date" class="form-control" name="masa_berlaku_kendaraan" id="masa_berlaku_kendaraan_input" >
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
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatekendaraan"> 
        @csrf()
        <input type="hidden" name="id" id="id">
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
                                            <select class="form-select"  name="jenis_kendaraan" id="jenis_kendaraan" >
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
                                            <label class="control-label">Kapasitas</label>
                                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Orang" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" id="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
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
                                                <option value="{{ $val->kode_po }}">{{ $val->nama_po }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <select class="form-select"  name="id_trayek" id="id_trayek" required="" oninvalid="this.setCustomValidity('Silahkan pilih trayek')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Trayek</option>
                                                @foreach($datatrayek as $val)
                                                <option value="{{ $val->kode_trayek }}">{{ $val->nama_trayek }}</option>
                                                @endforeach
                                            </select>
                                        </div>            
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Uji</label>
                                            <input type="number" class="form-control" name="no_uji" id="no_ujis" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa Spionam</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. KPS</label>
                                            <input type="text" class="form-control" name="no_kps" id="no_kps" required="" oninvalid="this.setCustomValidity('No. Kps harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa Eblue</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa_kps" id="tgl_kadaluarsa_kps" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. SRUT</label>
                                            <input type="text" class="form-control" name="no_srut" id="no_srut" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Masa Berlaku Kendaraan</label>
                                            <input type="date" class="form-control" name="masa_berlaku_kendaraan" id="masa_berlaku_kendaraan" >
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


    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletekendaraan">
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
                  url :'/api/updatedatakendaraan/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id_kendaraan);
                      $('#no_kendaraan').val(data.data.no_kendaraan);
                      $('#no_rangka').val(data.data.no_rangka);
                      $('#no_mesin').val(data.data.no_mesin);
                      $('#merek').val(data.data.merek);
                      $('#jenis_kendaraan').val(data.data.jenis_kendaraan);
                      $('#tahun').val(data.data.tahun);
                      $('#kapasitas').val(data.data.kapasitas);
                      $('#id_perusahaan_otobus').val(data.data.id_perusahaan_otobus);
                      $('#id_trayek').val(data.data.id_trayek);
                      $('#no_ujis').val(data.data.no_uji);
                      $('#tgl_kadaluarsa').val(data.data.tgl_kadaluarsa);
                      $('#no_kps').val(data.data.no_kps);
                      $('#tgl_kadaluarsa_kps').val(data.data.tgl_kadaluarsa_kps);
                      $('#no_srut').val(data.data.no_srut);
                      $('#masa_berlaku_kendaraan').val(data.data.masa_berlaku_kendaraan);
                      $('#tipe').val(data.data.tipe_kendaraan);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });

        $(document).on('input','.inputdatakendaraan',function(){
             var nokend = $(this).val();
             console.log('nokend',nokend);
                $.ajax({
                  url :'/api/datakendaraan/'+nokend,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dkamd',data);
                      $('#no_rangka_input').val(data.api_data.parameters.data.no_rangka);
                       $('#no_mesin_input').val(data.api_data.parameters.data.no_mesin);
                       $('#merek_input').val(data.api_data.parameters.data.merek);
                   //   $('#jenis_kendaraan_input').val(data.api_data.parameters.data[0].jenis_kendaraan);
                      $('#tahun_input').val(data.api_data.parameters.data.tahun);
                    //  $('#kapasitas_input').val(data.api_data.parameters.data[0].kapasitas);
                      $('#tipe_input').val(data.api_data.parameters.data.jenis_pelayanan);
                     // $('#id_perusahaan_otobus_input').val(data.api_data.parameters.data[0].id_perusahaan_otobus);
                     // $('#id_trayek_input').val(data.api_data.parameters.data[0].id_trayek);
                      $('#no_uji_input').val(data.api_data.parameters.data.no_uji);
                      $('#tgl_kadaluarsa_input').val(data.api_data.parameters.data.tgl_exp_uji);
                      $('#no_kps_input').val(data.api_data.parameters.data.no_kps);
                      $('#tgl_kadaluarsa_kps_input').val(data.api_data.parameters.data.tgl_exp_kps);
                     // $('#no_srut').val(data.api_data.parameters.data[0].no_srut);
                      $('#masa_berlaku_kendaraan_input').val(data.api_data.parameters.data.tgl_exp_uji);
                      // $('#myModalUpdate').modal('show');
                  }
                })
          });


    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection