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
                            <h2 class="content-header-title float-start mb-0">Data Wilayah</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen User</a>
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
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah Wilayah BPTD</button>
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
<table id="example" class="table table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
               {{--  <th>Kode Wilayah</th> --}}
               {{--  <th>Level</th> --}}
                <th>Nama Wilayah / BPTD</th>
               {{--  <th>Status</th> --}}
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datawilayah as $val)
            <tr>
                {{-- <td>{{ $val->kode_wilayah }}</td>
                <td>{{ $val->level }}</td> --}}
                <td>{{ $val->bptb }}</td>
                {{-- @if($val->status==0 || $val->status=="")
                <td>Tidak Aktif</td>
                @else 
                <td>Aktif</td>
                @endif --}}
                <td><button  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id_bptb }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  <a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_bptb }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                 <th>Nama Wilayah / BPTB</th>
               {{--  <th>Status</th> --}}
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
    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpanwilayah" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Wilayah BPTD</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">BPTD</label>
                                            <input type="text" class="form-control" name="bptb" required="" oninvalid="this.setCustomValidity('BPTB harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
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



    <!-- Modal edit wilayah BPTB -->
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostwilayah"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Wilayah BPTD</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">BPTD</label>
                                            <input type="text" class="form-control" name="bptb" id="bptb" required="" oninvalid="this.setCustomValidity('BPTB harus diisi')" oninput="setCustomValidity('')">
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


    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletewilayah">
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
                  url :'/api/updatewilayah/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                     console.log('dataje',data);
                    // var titik_koordinat = JSON.parse(data.data.titik_koordinat);
                    // console.log('cektitik',titik_koordinat[0].lat);

                      $('#id').val(data.data.id_bptb);
                      $('#bptb').val(data.data.bptb);
                      // $('#nama_wilayah').val(data.data.nama_wilayah);
                      // $('#induk_wilayah').val(data.data.induk_wilayah);
                      // $('#level').val(data.data.level);
                      // $('#kode_wilayah').val(data.data.kode_wilayah);
                      // $('#no_telp').val(data.data.no_telp);
                      // $('#alamat').val(data.data.alamat);
                      // $('#status').val(data.data.status);
                      // $('#lat').val(titik_koordinat[0].lat);
                      // $('#long').val(titik_koordinat[0].long);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection




