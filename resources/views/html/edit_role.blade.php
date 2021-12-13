@extends('html.index')
@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Data Role</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/role"><a class="btn btn-warning" href="/role"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></a>
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
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah Role</button>
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
            <div class="">
                <!-- Row grouping -->
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card container-fluid">
                                <!-- Modal edit -->
    <div class="  text-start" id="myModalUpdates" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostrole"> 
        @csrf()
        <input type="hidden" name="id" value="{{ $data->id_role }}">
        <div class="container">
            <div class="modal-content" style="margin-top: 3%;">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Role</h4>
                       
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Role</label>
                                            <input type="text" class="form-control" value="{{ $data->role }}" name="role" id="role" placeholder="Masukan nama role" required="" oninvalid="this.setCustomValidity('Nama role harus diisi')" oninput="setCustomValidity('')" >
                                        </div>
                                        {{--  <div class="form-group mb-1">
                                            <label class="control-label">Nama Menu</label>
                                            <select class="form-control" name="id_menu" required="" oninvalid="this.setCustomValidity('Nama menu harus diisi')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Menu</option>
                                                @foreach($menu as $val)
                                                <option value="{{ $val->id }}">{{ $val->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Web</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" checked name="lead" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Tambah Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" checked name="create" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Ubah Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" checked name="update" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Hapus Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" checked name="delete" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button> 

                                        <hr>
                                        {{-- <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div> --}}
                                         <table class="table table-striped table-hover">
                                            <tr>
                                                <th><center>Menu</center></th>
                                                <th><center>Status</center></th>
                                                <th><center>Tambah</center></th>
                                                <th><center>Ubah</center></th>
                                                <th><center>Hapus</center></th>
                                                <th><center>Opsi</center></th>
                                            </tr>
                                            <?php 
                                             ?>
                                            @foreach($datamenus as $val)
                                            <tr>
                                                <td>{{ $val->nama_menu }}</td>
                                                @if($val->lead==1)
                                                <td><div class="alert alert-info"><center>Aktif</center></div></td>
                                                @else
                                                 <td><div class="alert alert-danger"><center>Tidak Aktif</center></div></td>
                                                @endif

                                                @if($val->create==1)
                                                 <td><div class="alert alert-info"><center>Aktif</center></div></td>
                                                @else
                                                  <td><div class="alert alert-danger"><center>Tidak Aktif</center></div></td>
                                                @endif

                                                @if($val->update==1)
                                                 <td><div class="alert alert-info"><center>Aktif</center></div></td>
                                                @else
                                                 <td><div class="alert alert-danger"><center>Tidak Aktif</center></div></td>
                                                @endif

                                                @if($val->delete==1)
                                                 <td><div class="alert alert-info"><center>Aktif</center></div></td>
                                                @else
                                                  <td><div class="alert alert-danger"><center>Tidak Aktif</center></div></td>
                                                @endif
                                                <td><button type="button"  class="btn btn-sm btn-success edit_data" style="width:100%;" id="{{ $val->id_permission }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    {{-- <a href="/role" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Kembali</a> --}}
                </div>
            </div>
        </div>
    </form> 
    </div>


     <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatemenu" > 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group mb-1">
                                            <label class="control-label">Menu</label>
                                            <select  id="id_menu" class="form-control" disabled="" required="" oninvalid="this.setCustomValidity('Silahkan Pilih Menu')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Menu</option>
                                                @foreach($menu as $val)
                                                <option value={{ $val->id }}>{{ $val->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Web</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" class="lead"  name="lead" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Tambah Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" class="create"  name="create" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Ubah Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" class="update"   name="update" value="1" >
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Hapus Data</label>
                                                    <div>
                                                        <label class="switch">
                                                          <input type="checkbox" class="delete"  name="delete" value="1">
                                                          <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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



                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Row grouping -->

                

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
                                <form method="post" action="/deleterole">
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
    //     $(document).on('click','.edit_data',function(){
    //         var idubh = $(this).attr('id');
    //             $.ajax({
    //               url :'/api/updatedatarole/'+idubh,
    //               method : 'GET',
    //               dataType : 'json',
    //               success:function(data){
    //                 console.log('dataje',data);
    //                   $('#id').val(data.data.id_role);
    //                   $('#role').val(data.data.role);
    //                   $('#myModalUpdate').modal('show');
    //               }
    //             })
    //       });
         $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/updatedatamenu/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data.data.create);
                    if(data.data.lead==1){
                         $(".lead").prop("checked", true);
                    } else {
                         $(".lead").prop("checked", false);
                    }
                    if(data.data.create==1){
                         $(".create").prop("checked", true);
                    } else {
                         $(".create").prop("checked", false);
                    }

                    if(data.data.update==1){
                        $(".update").prop("checked", true);
                    } else {
                        $(".update").prop("checked", false);
                    }

                     if(data.data.delete==1){
                        $(".delete").prop("checked", true);
                    } else {
                       $(".delete").prop("checked", false);
                    }
                       $('#id').val(data.data.id);
                       $('#id_role').val(data.data.id_role);
                       $('#id_menu').val(data.data.id_menu);
                       $('#lead').val(data.data.create);
                       $('#create').val(data.data.lead);
                       $('#update').val(data.data.update);
                       $('#delete').val(data.data.delete);
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