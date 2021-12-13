@extends('html.index')
@section('content')
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
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah user</button>
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
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Role</th>
                <th>Wilayah</th>
                <th>Nama Terminal</th>
                {{-- <th>Status</th> --}}
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datauser as $val)
            <tr>
                <td>{{ $val->username }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>
                <td>{{ $val->role }}</td>
                @if($val->bptb==null)
                <td>Semua</td>
                @else 
                <td>{{ $val->bptb }}</td>
                @endif
                @if($val->nama_terminal==null)
                 <td>Semua</td>
                @else
                <td>{{ $val->nama_terminal }}</td>
                @endif
                {{-- @if($val->status==0 || $val->status=="")
                <td>Tidak Aktif</td>
                @else 
                <td>Aktif</td>
                @endif  --}}
                <td><button  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  <a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Role</th>
                <th>Wilayah</th>
                <th>Nama Terminal</th>
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
    <!-- Modal add -->
    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/registeruser" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="idnamalengkap" required="" oninvalid="this.setCustomValidity('Nama lengkap harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIK</label>
                                            <input type="text" class="form-control" name="nik" id="idnik" required="" oninvalid="this.setCustomValidity('NIK harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telp</label>
                                            <input type="number" class="form-control" name="no_telp" >
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" required="" oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Username</label>
                                            <input type="text" class="form-control" name="username" required="" oninvalid="this.setCustomValidity('Username harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" required="" oninvalid="this.setCustomValidity('Email harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" name="password" required="" oninvalid="this.setCustomValidity('Password lengkap harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password2" required="" oninvalid="this.setCustomValidity('Konfirmasi password harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-header " style="background-color: #17abb0;">
                                <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Role</h4>
                            </div>
                            <br>
                            <div class="col-md-12 container">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Role</label>
                                            <select class="form-select selectrole." name="id_role" required=""   oninvalid="this.setCustomValidity('Silahkan pilih role')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Role</option>
                                                @foreach($datarole as $val)
                                                <option value="{{ $val->id_role }}">{{ $val->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1" id="iddispwilayah" style="display: inline">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select pilihwilayah" name="id_bptb" >
                                                <option value="">All</option>
                                                @foreach($datawilayah as $val)
                                                <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group mb-1" id="iddispterminal" style="display: inline">
                                            <label class="control-label">Terminal</label>
                                            {{-- <select class="form-select" name="kode_terminal" >
                                                <option value="">Pilih Terminal</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select> --}}
                                            <select class=" form-control pilihterminal pilihpo " data-live-search="true" float name="kode_terminal" id="terminalget"></select>
                                        </div>
                                        
                                        {{--  <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select" name="id_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Terminal</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->id_wilayah }}">{{ $val->nama_wilayah }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
    <form class="form" method="post" action="/updateregisteruser"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Edit User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="name" id="name" required="" oninvalid="this.setCustomValidity('Nama lengkap harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIK</label>
                                            <input type="text" class="form-control" name="nik" id="nik" required="" oninvalid="this.setCustomValidity('NIK harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telp</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp" required="" oninvalid="this.setCustomValidity('Nomor telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" required="" id="alamat" oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" required="" oninvalid="this.setCustomValidity('Username harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" required="" oninvalid="this.setCustomValidity('Email harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password2" id="password2" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-header " style="background-color: #17abb0;">
                                <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Role</h4>
                            </div>
                            <br>
                            <div class="col-md-12 container">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Role</label>
                                            <select class="form-select selectrole." name="id_role" required="" id="id_role"  oninvalid="this.setCustomValidity('Silahkan pilih role')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Role</option>
                                                @foreach($datarole as $val)
                                                <option value="{{ $val->id_role }}">{{ $val->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1" id="iddispwilayah" style="display: inline">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select pilihwilayahup" name="id_bptb" id="id_wilayahup">
                                                <option value="">All</option>
                                                @foreach($datawilayah as $val)
                                                <option value="{{ $val->id_bptb }}">{{ $val->bptb }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group mb-1" id="iddispterminal" style="display: inline">
                                            <label class="control-label">Terminal</label>
                                            {{-- <select class="form-select" name="kode_terminal" >
                                                <option value="">Pilih Terminal</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select> --}}
                                            <select class=" form-control pilihterminal pilihpo " data-live-search="true" float name="kode_terminal" id="terminalgetup"></select>
                                        </div>
                                        
                                        {{--  <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select" name="id_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Terminal</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->id_wilayah }}">{{ $val->nama_wilayah }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                            </div>
                        <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> Update</button>
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


    <!-- Modal edit -->
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
                  url :'/api/updateuser/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id);
                      $('#id_terminal').val(data.data.id_terminal);
                      $('#name').val(data.data.name);
                      $('#nik').val(data.data.nik);
                      $('#no_telp').val(data.data.no_telp);
                      $('#alamat').val(data.data.alamat);
                      $('#email').val(data.data.email);
                      $('#id_wilayahup').val(data.data.id_wilayah);
                      $('#id_role').val(data.data.id_role);
                      $('#username').val(data.data.username);
                      $('#password').val(data.data.password);
                      $('#my_image').attr('src','/upload/image/'+data.data.foto);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });
        $(document).on('input','.selectrole',function(){

            // let val = $('#id_role').val();
            // if(val==2){
            //     document.getElementById("iddispwilayah").style.display = "inline";
            //     document.getElementById("iddispterminal").style.display = "none";
            //     document.getElementById("terminalget").innerHTML ='ALl';
            // } else if(val==3){
            //     document.getElementById("iddispterminal").style.display = "inline";
            //     document.getElementById("iddispwilayah").style.display = "inline";
            //     document.getElementById("terminalget").innerHTML ='All';
            // }
        });

        $(document).on('change','.pilihwilayah',function(){
            var id_bptd = $(this).val();
           // alert(id_bptd)
                $.ajax({
                  url :'getbptdterminal/'+id_bptd,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    document.getElementById("terminalget").innerHTML ='<option value="">All</option';
                  //  console.log('kodeposdatakotaa',data[0]['id_terminal']);
                  let getdata = data.data;
                    getdata.forEach(function(dataterminal) {
                        $("#terminalget").append(new Option(dataterminal.nama_terminal, dataterminal.kode_terminal));

                    });
                  }
                })
          });
        $(document).on('change','.pilihwilayahup',function(){
            var id_bptd = $(this).val();
                $.ajax({
                  url :'getbptdterminal/'+id_bptd,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    document.getElementById("terminalgetup").innerHTML ='<option value="">All</option';
                    console.log('updatewkwkmen',data);
                  let getdata = data.data;
                    getdata.forEach(function(dataterminal) {
                        $("#terminalgetup").append(new Option(dataterminal.nama_terminal, dataterminal.kode_terminal));

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