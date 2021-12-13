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
                        <h2 class="content-header-title float-start mb-0">Report Terminal Kendaraan</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a>
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
        </div>

            <div class="content-body">
                <!-- Row grouping -->
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card container-fluid">
                            </div>
                            {{-- <div class="card-header border-bottom">
                                <h4 class="card-title">Row Grouping</h4>
                            </div> --}}
                            <div style="padding: 10px; font-size: 12px;">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                      {{--   <a href="/importkendaraantiba" class="nav-link active"  type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kendaraan</a> --}}
                                        {{-- <a href="/importpenumpangtiba" class="nav-link"  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Penumpang</a> --}}
                                    </div>
                                </nav>

                                <div style="padding: 10px; font-size: 12px;">
                                    {{-- <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a href="#" class="nav-link"  type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kendaraan Tiba</a>
                                            <a href="/importkendaraankeluar" class="nav-link active"  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Kendaraan Keluar</a>
                                        </div>
                                    </nav> --}}


                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                  <form class="form" method="post" action="/simpanimportkendaraankeluar" enctype="multipart/form-data">
                                      @csrf()
                                      {{-- <input type="hidden" name="id" value="{{ $dataterminal->id_terminal }}" id="id">                        --}}
                                       <br>
                                       <a href="/doc/data_kendaraan_keluar.xlsx" class="btn btn-info" type="button" role="tab"><i class="fa fa-download"></i> Template</a>
                                       <div class="row">
                                           <div class="col-md-10">
                                               <div class="col-md-5">
                                                      <br>
                                                <h5> Import Data Kendaraan Keluar </h5>
                                                        </div>
                                              <div class="col-md-5">
                                              <input type="file" required class="form-control" name="importkendaraan" id="importkendaraan" multiple>
                                          </div>
                                          <div class="mt-1">
                                            <span class="text-secondary">File yang harus diupload : .xls, xlsx</span>
                                        </div>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-10">
                                          <button type="submit" class="btn btn-success registerroleuser"><i class="fas fa-file-import"></i> Import</button>
                                      </div>
                                  </div>
                                  </form>
                                    </div>
                                    <br>
                                    <br>
                                    <h4>Perhatian</h4>
                                    <br>
                                    <p>- Klik tombol Template untuk mengunduh (download) file yang akan diimport.<p>
                                    <p>- Pastikan menggunakan template (File Excell) yang berasal dari web terminalonline.id.<p>
                                    <p>- Untuk melihat Kode Terminal, silahkan <a target="_blank" href="/doc/Kode_Terminal.pdf"><b>klik disini</b></a></p>
                                    <p>- Mohon untuk tidak merubah struktur dari template tersebut.</p>
                                    <p>- Pastikan mengunggah (upload) file yang benar untuk meminimalisir kesalahan data.</p>
                                    </div>
                                </div>
                            </form>
                            
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

<!-- Modal Import -->
<div class="modal fade" id="importKendaraan" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Import Data Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="#" method="post" enctype="multipart/form-data">
            {{csrf_field() }}
            <div class="form-group">
                <input type="file" name="file" required>
            </div>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Selesai</button>
        <button type="submit" class="btn btn-primary"> Import</button>
        </div>
    </div>
    </div>
</div>
<!-- Akhir Modal Import -->

{{-- <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', function(){
             $('#importKendaraan').modal('show');
        });
</script> --}}
        
@endsection