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
                            <h2 class="content-header-title float-start mb-0"><a class="btn btn-warning" href="/datakendaraantiba"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a></h2>
                            <h2 class="content-header-title float-start mb-0">Foto Kendaraan Tiba</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Operasional Terminal</a>
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
            <div class="modals fades text-start"  tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #17abb0;">
                            <h4 class="modal-title" id="myModalLabel16" style="color: white">Foto Kendaraan</h4>
                                </div>
                                    <div class="modal-body"> 
                                    <div class="row">
                                        @foreach($data as $val)
                                        <div class="col-md-12">
                                            <img id="/upload/filegate/{{ $val->url_foto }}" src="/upload/filegate/{{ $val->url_foto }}" class="img img-thumbnail registerusers" width="100%">
                                        </div>
                                        @endforeach
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

    <!-- END: Content-->
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
          //  $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
           var imagefoto = $(this).attr('src');
           $('#imagepreview').attr('src',imagefoto); 
             $('#myModalAdd').modal('show');
        });

    });
</script>
   
    
@endsection