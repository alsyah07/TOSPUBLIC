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
                @if($menu->create==1)
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah Terminal</button>
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
                <th>Kode Terminal</th>
                <th>Nama Terminal</th>
                <th>Tipe</th>
                <th>Kota</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataterminal as $val)
            <tr>
                <td>{{ $val->kode_terminal }}</td>
                <td>{{ $val->nama_terminal }}</td>
                <td>{{ $val->tipe }}</td>
                <td>{{ $val->nama_kota }}</td>
                <td>
                    <a href="/profilterminalprint/{{ $val->kode_terminal }}/dashboard" target="_blank" class="btn btn-sm btn-warning"> Lihat </span><i class="fas fa-eye"></i></a>
                    @if($menu->create==1)
                    <a href="/profilterminal/{{ $val->kode_terminal }}" class="btn btn-sm btn-info"> Edit Profil </span><i class="fas fa-bus"></i></a>
                    @endif
                    @if($menu->update==1)
                    <a href="/editterminal/{{ $val->id_terminal }}" class="btn btn-sm btn-success edit_data">Edit Data </span><i class="fas fa-edit"></i></a>
                    @endif
                    @if($menu->delete==1)
                      <a  href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_terminal }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;">Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
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
                                            <input type="number" class="form-control" name="no_telp" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Latitude</label>
                                                    <input type="text" class="form-control" name="lat"  oninvalid="this.setCustomValidity('Latitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Longtitude</label>
                                                    <input type="text" class="form-control" name="long"  oninvalid="this.setCustomValidity('Longtitude harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4"   oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
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
                                            <input type="file" class="form-control" name="gambar_terminal"  oninvalid="this.setCustomValidity('Gambar harus diisi')" oninput="setCustomValidity('')">
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
                                            <input type="text" class="form-control" name="status_p3d" oninvalid="this.setCustomValidity('Status P3D harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Lahan</label>
                                                    <input type="text" class="form-control" name="luas_lahan"  placeholder="m³" oninvalid="this.setCustomValidity('Luas lahan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Luas Bangunan</label>
                                                    <input type="text" class="form-control" name="luas_bangunan" placeholder="m³" oninvalid="this.setCustomValidity('Luas bangunan harus diisi')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Luas Area Pengembangan</label>
                                            <input type="text" class="form-control" name="luas_area_pengembangan" placeholder="m³" oninvalid="this.setCustomValidity('Luas area pengembangan harus diisi')" oninput="setCustomValidity('')">
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
                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
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
                    var titik_koordinat = JSON.parse(data.data.titik_koordinat);
                    console.log('cektitik',titik_koordinat);
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