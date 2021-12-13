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
                            <h2 class="content-header-title float-start mb-0">Data Building Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Building Management</a>
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
                    <button type="button" class="btn btn-primary AddFormRamcheckdata" >+ Tambah Data</button>
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
                    <table id="example" class="table table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
                            <thead>
                                <tr>
                                    <th>Nomor Kendaraan</th>
                                    <th>Foto Kendaraan</th>
                                    <th>Keterangan</th>
                                    <th style="width: 100px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $val)
                                <tr>
                                    <td>{{ $val->no_kendaraan }}</td>
                                    <td><img id="/upload/rampcheck/{{ $val->foto_kendaraan }}" class="img img-thumbnail registerusers" width="100" src="/upload/rampcheck/{{ $val->foto_kendaraan }}"></td>
                                    <td>{{ $val->keterangan }}</td> 
                                    <td>
                                    @if($menu->update==1)
                                    <button type="button"  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                                    @endif
                                    @if($menu->delete==1)
                                        <a style="width:60%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>Nomor Kendaraan</th>
                                    <th>Foto Kendaraan</th>
                                    <th>Keterangan</th>
                                    <th style="width: 100px;">Opsi</th>
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



    <!-- Modal add -->
    <div class="modal fade text-start" id="addDataRampCheck" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
     <form method="post" action="/inputrampcheck" enctype="multipart/form-data">
        @csrf()
       
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form RampCheck</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nomor Kendaraan</label>
                                            <input type="text" name="no_kendaraan" class="form-control datakendaraaninput" placeholder="Masukan Nomor Kendaraan" required="" oninvalid="this.setCustomValidity('Nomor Kendaraan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Foto Keterangan</label>
                                            <input type="file" class="form-control" name="foto_kendaraan" required="" oninvalid="this.setCustomValidity('Foto kendaraan harus diisi')" oninput="setCustomValidity('')">

                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Keterangan</label>
                                            <select class="form-control" name="keterangan" required="" oninvalid="this.setCustomValidity('keterangan kendaraan harus diisi')" oninput="setCustomValidity('')">
                                                <option value="Lulus">Lulus</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                            </select>
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
     <form method="post" action="/updateinputrampcheck" enctype="multipart/form-data">
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form RampCheck</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nomor Kendaraan</label>
                                            <input type="text" name="no_kendaraan" id="no_kendaraan" class="form-control datakendaraaninput" placeholder="Masukan Nomor Kendaraan" required="" oninvalid="this.setCustomValidity('Nomor Kendaraan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Foto Kendaraan</label>
                                            <input type="file" class="form-control" name="foto_kendaraan" id="foto_kendaraan" oninvalid="this.setCustomValidity('Foto kendaraan harus diisi')" oninput="setCustomValidity('')">
                                            <br>
                                             <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png" id="my_image" class="img img-thumbnail" width="250">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Keterangan</label>
                                            <select class="form-control" name="keterangan" required="" id="keterangan" oninvalid="this.setCustomValidity('keterangan kendaraan harus diisi')" oninput="setCustomValidity('')">
                                                <option value="Lulus">Lulus</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                            </select>
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
                                <form method="post" action="/deleterampcheck">
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
          //  $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
           var imagefoto = $(this).attr('src');
           $('#imagepreview').attr('src',imagefoto); 
             $('#myModalAdd').modal('show');
        });

        $(document).on('click','.AddFormRamcheckdata',function(){
             $('#addDataRampCheck').modal('show');
        });

        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/updateramcheck/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                    $('#id').val(data.data.id);
                      $('#no_kendaraan').val(data.data.no_kendaraan);
                      $('#keterangan').val(data.data.keterangan);
                     $('#my_image').attr('src','/upload/rampcheck/'+data.data.foto_kendaraan);
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