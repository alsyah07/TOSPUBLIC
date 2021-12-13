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
                        <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/sdm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2>
                        <h2 class="content-header-title float-start mb-0">Data Kompetensi</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/terminal">Sistem Informasi</a>
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
                                              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <form class="form" method="post" action="/simpankompetensisdm" enctype="multipart/form-data">
                                                @csrf()
                                                 <input type="hidden" name="id" value="{{ $idsdm->id }}" id="id">                     
                                                 <br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" placeholder="Masukan Nama File"  name="nama_file" id="kompetensi" >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="file" class="form-control" name="file_sdm" required="" id="kompetensi" >
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
                                                        <th>Nama File</th>
                                                         <th>File</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($kom as $val)
                                                    <tr>
                                                        <th>{{ $val->nama_file }}</th>
                                                        <td>
                                                            <img id="/upload/file_kompetensi_sdm/{{ $val->file_sdm }}" class="img img-thumbnail registerusers" width="150" src="/upload/file_kompetensi_sdm/{{ $val->file_sdm }}">
                                                        </td>
                                                        <td><a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i> 
                                                            <a class="btn btn-sm btn-primary" href="/upload/file_kompetensi_sdm/{{ $val->file_sdm }}" download>Download</a>
                                                        </a>
                                                </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nama File</th>
                                                         <th>File</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
                                <form method="post" action="/deletekompetensisdm">
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
</script>

@endsection