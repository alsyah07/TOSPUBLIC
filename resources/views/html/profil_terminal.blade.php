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
                        <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/terminal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2>
                        <h2 class="content-header-title float-start mb-0">Profil Terminal</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/terminal">Data Terminal</a>
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

        </div>
        <div class="content-body">
            <!-- Row grouping -->
            <section id="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            {{-- <div class="card-header border-bottom">
                                    <h4 class="card-title">Row Grouping</h4>
                                </div> --}}
                            <div class="modals fades text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Foto Terminal</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Fasilitas Utama</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Fasilitas Penunjang</button>
                                              </li>
                                              <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-setifikat" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Sertifikat</button>
                                              </li>
                                              <li style="margin-left:  20%;">
                                                   <a href="/profilterminalprint/{{ $dataterminal->kode_terminal }}/dashboard" target="_blank"><button type="submit" class="btn btn-info registerroleuser"><i class="fa fa-eye"></i> Lihat Profil</button></a>
                                              </li>
                                            </ul>
                                            <hr>
                                            <div class="tab-content" id="pills-tabContent">
                                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <form class="form" method="post" action="/simpanprofilterminal" enctype="multipart/form-data">
                                                @csrf()
                                                <input type="hidden" name="id" value="{{ $dataterminal->kode_terminal }}" id="id">                       
                                                 <br>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="col-md-5">
                                                                    Foto Terminal
                                                            </div>
                                                        <div class="col-md-5">
                                                        <input type="file" class="form-control" name="kompetensi" id="kompetensi" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <button type="submit" class="btn btn-success registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                                                </div>
                                            </div>
                                            </form>
                                            <br>
                                            <hr>
                                            <table id="example5" class="table table-striped" >
                                                <thead>
                                                    <tr>
                                                        <th>Foto Terminal</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dataprofil_terminal as $val)
                                                    <tr>
                                                        <td>
                                                            <img id="/upload/file_kompetensi/{{ $val->kompetensi_file }}" class="img img-thumbnail registerusers" width="150" src="/upload/file_kompetensi/{{ $val->kompetensi_file }}">
                                                        </td>
                                                        <td><a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_profil_terminal }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;">Delete </span> <i class="fas fa-trash"></i></a>
                                                </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>File Kompetensi</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                              </div>


                                              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <form class="form" method="post" action="/simpanfasilitasutama" enctype="multipart/form-data">
                                                @csrf()
                                                <input type="hidden" name="id" value="{{ $dataterminal->kode_terminal }}" id="id">                       
                                                 <br>
                                                    <div class="row">
                                                            <div class="col-md-3">
                                                                    Nama Fasilitas Utama
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="nama_fasilitas_utama" id="kompetensi" placeholder="Masukan Nama Fasilitas Utama" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="status_barang_utama">
                                                                    <option>Ada</option>
                                                                    <option>Tidak Ada</option>
                                                                </select>
                                                                    </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-success registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <br>
                                                    <hr>
                                                    <table id="example2" class="table table-striped" >
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Fasilitas</th>
                                                                 <th>Status</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($datafasilitasutama as $val)
                                                            <tr>
                                                                <td>{{ $val->nama_fasilitas_utama }}</td>
                                                                <td>{{ $val->status_barang_utama }}</td>
                                                                <td><a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete1" onclick="confdelete1({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;">Delete </span> <i class="fas fa-trash"></i></a>
                                                        </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Nama Fasilitas</th>
                                                                 <th>Status</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                              </div>
                                              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                  <form class="form" method="post" action="/simpanfasilitaspenunjang" enctype="multipart/form-data">
                                                @csrf()
                                                <input type="hidden" name="id" value="{{ $dataterminal->kode_terminal }}" id="id">                       
                                                 <br>
                                                    <div class="row">
                                                            <div class="col-md-3">
                                                                    Nama Fasilitas Penunjang
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="nama_fasilitas_penunjang" id="kompetensi" placeholder="Masukan Nama Fasilitas Utama" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" name="status_barang_penunjang">
                                                                    <option>Ada</option>
                                                                    <option>Tidak Ada</option>
                                                                </select>
                                                                    </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-success registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <br>
                                                    <hr>
                                                    <table id="example1" class="table table-striped" >
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Fasilitas</th>
                                                                 <th>Status</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($datafasilitaspenunjang as $val)
                                                            <tr>
                                                                <td>{{ $val->nama_fasilitas_penunjang }}</td>
                                                                <td>{{ $val->status_barang_penunjang }}</td>
                                                                <td><a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete2" onclick="confdelete2({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                                                        </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Nama Fasilitas</th>
                                                                 <th>Status</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                              </div>

                                              <div class="tab-pane fade" id="pills-setifikat" role="tabpanel" aria-labelledby="pills-setifikat-tab">
                                                  <form class="form" method="post" action="/simpansertifikat" enctype="multipart/form-data">
                                                @csrf()
                                                <input type="hidden" name="id" value="{{ $dataterminal->kode_terminal }}" id="id">                       
                                                 <br>
                                                    <div class="row">
                                                            <div class="col-md-3">
                                                                    Nama File
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="nama_file" id="kompetensi" placeholder="Masukan Nama File" >
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="file" class="form-control" name="file" required="">
                                                            </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-success registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <br>
                                                    <hr>
                                                    <table id="example12" class="table table-striped" >
                                                        <thead>
                                                            <tr>
                                                                <th>Nama File</th>
                                                                 <th>File</th>
                                                                 <th>Tanggal</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($sertifikat as $val)
                                                            <tr>
                                                                <td>{{ $val->nama_file }}</td>
                                                                @if($val->file =="-")
                                                                <td>-</td>
                                                                @else
                                                                <td><a href="/upload/sertifikat_2/{{$val->file }}"><label class="btn btn-info btn-sm">File</label></a></td>
                                                                @endif
                                                                 <td>{{ $val->created_at }}</td>
                                                                <td><a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete3" onclick="confdelete3({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                                                        </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                 <th>Nama File</th>
                                                                  <th>File</th>
                                                                  <th>Tanggal</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                              </div>


                                            </div>
                                
                            </div>
                        </div>
                    </div>
                </div>


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


                <div class="col-md-8 ">
                    <!-- <form class="form" method="post" action="#" target="_blank" enctype="multipart/form-data"> -->
                   
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
                                <form method="post" action="/deleteprofilterminal">
                                    @csrf
                                    <div class="col-12">
                                        <center>
                                            <h5>Apakah anda yakin menghapus data ini ?</h5>
                                        </center>
                                        <input type="hidden" name="id" id="iddel">
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

                <div class="modal fade" id="moddelete1" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletefasilitasutama">
                                    @csrf
                                    <div class="col-12">
                                        <center>
                                            <h5>Apakah anda yakin menghapus data ini ?</h5>
                                        </center>
                                        <input type="hidden" name="id" id="iddelutama">
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

                <div class="modal fade" id="moddelete2" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletefasilitaspenunjang">
                                    @csrf
                                    <div class="col-12">
                                        <center>
                                            <h5>Apakah anda yakin menghapus data ini ?</h5>
                                        </center>
                                        <input type="hidden" name="id" id="iddelpen">
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


                <div class="modal fade" id="moddelete3" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletesertifikat">
                                    @csrf
                                    <div class="col-12">
                                        <center>
                                            <h5>Apakah anda yakin menghapus data ini ?</h5>
                                        </center>
                                        <input type="hidden" name="id" id="idsertifikat">
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








        </div>
    </div>
</div>
</section>
<!--/ Row grouping -->



</div>
</div>
</div>
<!-- END: Content-->

<!-- Modal edit -->

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','.registerusers',function(){
          //  $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
           var imagefoto = $(this).attr('src');
           $('#imagepreview').attr('src',imagefoto); 
             $('#myModalAdd').modal('show');
        });
    });

     function confdelete(val){
            document.getElementById('iddel').value= val;
     }
     function confdelete1(val){
            document.getElementById('iddelutama').value= val;
     }
     function confdelete2(val){
            document.getElementById('iddelpen').value= val;
     }
     function confdelete3(val){
            document.getElementById('idsertifikat').value= val;
     }
</script>

@endsection