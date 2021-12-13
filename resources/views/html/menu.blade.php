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
    <div class="app-content content "  >
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0" >
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Data User</h2>
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
                    <button type="button" class="btn btn-primary registerusers"  >+ Tambah user</button>
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
            <br>
            <div class="content-body" >
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
                <th>Role</th>
                <th>Menu</th>
                <th>Tambah Data</th>
                <th>Ubah Data</th>
                <th>Delete Data</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permission_menu as $val)
            <tr>
                <td>{{ $val->role }}</td>
                <td>{{ $val->nama_menu }}</td>
                @if($val->create==1)
                <td><label class="btn btn-info btn-sm">Aktif</label></td>
                @else
                <td><label class="btn btn-secondary btn-sm">Tidak Aktif</label></td>
                @endif
                @if($val->update==1)
                <td><label class="btn btn-info btn-sm">Aktif</label></td>
                @else
                <td><label class="btn btn-secondary btn-sm">Tidak Aktif</label></td>
                @endif
                @if($val->delete==1)
                <td><label class="btn btn-info btn-sm">Aktif</label></td>
                @else
                <td><label class="btn btn-secondary btn-sm">Tidak Aktif</label></td>
                @endif
                <td><button  class="btn btn-sm btn-success edit_data" style="width:100%;" id="{{ $val->id_permission }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Role</th>
                <th>Menu</th>
                <th>Tambah Data</th>
                <th>Ubah Data</th>
                <th>Delete Data</th>
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
    <form class="form" method="post" action="/insertmenu" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Role</label>
                                            <select name="id_role" class="form-control" required="" oninvalid="this.setCustomValidity('Silahkan Pilih Role')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Role</option>
                                                @foreach($role as $val)
                                                <option value={{ $val->id_role }}>{{ $val->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Menu</label>
                                            <select name="id_menu" class="form-control" required="" oninvalid="this.setCustomValidity('Silahkan Pilih Menu')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Menu</option>
                                                @foreach($menu as $val)
                                                <option value={{ $val->id }}>{{ $val->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                         <center><label class="control-label">Akses</label></center>
                                         <hr>
                                        <div class="row">
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
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
                                        <div class="form-group mb-1">
                                            <label class="control-label">Role</label>
                                            <select name="id_role" id="id_role" class="form-control" disabled="" required="" oninvalid="this.setCustomValidity('Silahkan Pilih Role')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Role</option>
                                                @foreach($role as $val)
                                                <option value={{ $val->id_role }}>{{ $val->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Menu</label>
                                            <select name="id_menu" id="id_menu" class="form-control" disabled="" required="" oninvalid="this.setCustomValidity('Silahkan Pilih Menu')" oninput="setCustomValidity('')" >
                                                <option value="">Pilih Menu</option>
                                                @foreach($menu as $val)
                                                <option value={{ $val->id }}>{{ $val->nama_menu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                         <center><label class="control-label">Akses</label></center>
                                         <hr>
                                        <div class="row">
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
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


    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deleteuser">
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


   {{--  <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalrole" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updateregisteruser"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Form Role User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select" name="id_wilayah">
                                                <option>Pilih Wilayah</option>
                                                <option>Jakarta</option>
                                                <option>Bogor</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Role</label>
                                            <select class="form-select" name="id_role">
                                                <option>Pilih Role</option>
                                                <option>Administrasi</option>
                                                <option>API</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form> 
    </div>
 --}}

    <div aria-live="polite" aria-atomic="true" class="position-relative">
  <!-- Position it: -->
  <!-- - `.toast-container` for spacing between toasts -->
  <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
  <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
  <div class="toast-container position-absolute top-0 end-0 p-3">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        See? Just like this.
      </div>
    </div>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small class="text-muted">2 seconds ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Heads up, toasts will stack automatically
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
                  url :'/updatedatamenu/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data.data.create);
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
                       $('#create').val(data.data.create);
                       $('#update').val(data.data.update);
                       $('#delete').val(data.data.delete);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });
        $(document).on('input','.selectrole',function(){

            let val = $('#id_role').val();
            if(val==2){
                document.getElementById("iddispwilayah").style.display = "inline";
                document.getElementById("iddispterminal").style.display = "none";
                document.getElementById("terminalget").innerHTML ='';
            } else if(val==3){
                document.getElementById("iddispterminal").style.display = "inline";
                document.getElementById("iddispwilayah").style.display = "inline";
                document.getElementById("terminalget").innerHTML ='';
            }
        });

        $(document).on('change','.pilihwilayah',function(){
            var id_bptd = $(this).val();
           // alert(id_bptd)
                $.ajax({
                  url :'getbptdterminal/'+id_bptd,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    document.getElementById("terminalget").innerHTML ='';
                  //  console.log('kodeposdatakotaa',data[0]['id_terminal']);
                  let getdata = data.data;
                    getdata.forEach(function(dataterminal) {
                        $("#terminalget").append(new Option(dataterminal.nama_terminal, dataterminal.kode_terminal));

                    });
                  }
                })
          });


    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection