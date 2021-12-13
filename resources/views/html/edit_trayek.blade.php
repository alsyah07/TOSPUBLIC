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
                            <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/trayek"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2>
                            <h2 class="content-header-title float-start mb-0">Data Trayek</h2>
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
                @if(session('notifdouble'))
                <div class="demo-spacing-0">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ session('notifdouble') }}
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
            <div class="modals fades text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
            <form class="form" method="post" action="/updatetrayek"> 
                @csrf()
                <input type="hidden" name="id" id="id">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #17abb0;">
                            <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Trayek</h4>
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
                                    <hr>
                                    <div class="">
                             <nav>
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-kendaraan" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Terminal</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-angkutan" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Angkutan</button>
                                  </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="nav-kendaraan" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formterminal" >+ Tambah Terminal</button>
                                    </div>
                                      <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Terminal</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($masterterminaltrayek as $val)
                                        <tr>
                                            <td>{{ $val->nama_terminal }}</td>
                                            <td><a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeleteterminaltrayek({{ $val->id }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Terminal</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>
                                </table>                               
                                  </div>
                                  <div class="tab-pane fade" id="nav-angkutan" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="">
                                        <button type="button" class="btn btn-primary formangkutan" >+ Tambah Angkutan</button>
                                    </div>
                                      <table id="example6" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No Kendaraan</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($masterterminalangkutantrayek as $val)
                                        <tr>
                                            <td>{{ $val->no_kendaraan }}</td>
                                            <td>{{ $val->nama_po }}</td>
                                            <td><a style="width:10px;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdeleteltrayekkendaraan({{ $val->id }})" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No Kendaraan</th>
                                            <th>Nama Perusahaan</th>
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
    <!-- END: Content-->

    <!-- Modal add -->
    <div class="modal fade text-start" id="myModalAddterminal" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpanterminaltrayek" enctype="multipart/form-data" > 
        <input type="hidden" name="id_trayek" value="{{ $datatryek->id_trayek }}">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Terminal</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Terminal</label>
                                            <select class="form-select"  name="id_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih nama terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Terminal</option>
                                                @foreach($dataterminal as $dd)
                                                <option value="{{ $dd->id_terminal }}">{{ $dd->nama_terminal }}</option>
                                                @endforeach
                                            </select>
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

    <!-- Modal add -->
    <div class="modal fade text-start" id="myModalAddangkutan" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpantrayekangkutan" enctype="multipart/form-data" > 
        <input type="hidden" name="id_trayek" value="{{ $datatryek->id_trayek }}">
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Data Angkutan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table id="example7" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>No Kendaraan</th>
                                            <th>Nama Perusahaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mastertrayekkendaraan as $val)
                                        <tr>
                                            <td><input type="checkbox" name="id_kendaraan[]" value="{{ $val->idkendaraan }}"></td>
                                            <td>{{ $val->no_kendaraan }}</td>
                                            <td>{{ $val->nama_po }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>No Kendaraan</th>
                                            <th>Nama Perusahaan</th>
                                        </tr>
                                    </tfoot>
                                </table>        
                            </div>
                        <div class="modal-footer">
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
                                <form method="post" action="/deletetrayekterminal">
                                    @csrf
                                    <div class="col-12">
                                       <center><h5>Apakah anda yakin menghapus data ini ?</h5></center>
                                       <input type="hidden" name="id" id="iduser">
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

    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });

         $(document).on('click','.formterminal',function(){
             $('#myModalAddterminal').modal('show');
        });
         $(document).on('click','.formangkutan',function(){
             $('#myModalAddangkutan').modal('show');
        });

      //  $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatetrayek/'+{{ $datatryek->id_trayek }},
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id_trayek);
                      $('#kode_trayek').val(data.data.kode_trayek);
                      $('#nama_trayek').val(data.data.nama_trayek);
                      $('#rute').val(data.data.rute);
                  }
                })
      //    });

    });
    function confdeleteterminaltrayek(val){
            document.getElementById('iduser').value= val;
            document.getElementById('type').value= "terminal";
        }
    function confdeleteltrayekkendaraan(val){
        document.getElementById('iduser').value= val;
        document.getElementById('type').value= "kendaraan";
    }
  </script>
    
@endsection