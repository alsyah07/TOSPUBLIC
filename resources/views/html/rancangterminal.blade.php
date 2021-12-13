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
                        <h2 class="content-header-title float-start mb-0">Rencana Pembangunan Terminal</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Rancang Bangun</a>
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
                <button type="button" class="btn btn-primary registerusers">+ Tambah Data</button>
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

                            <table id="example" class="table table-striped table-responsive" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
                                <thead>
                                    <tr>
                                        <th>Terminal</th>
                                        <th>SK Penetapan Lokasi</th>
                                        <th>Berita Acara Serah Terima/P3D</th>
                                        <th>Sertifikat</th>
                                        <th>Feasibility Study</th>
                                        <th>Master Plan/DED</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                @foreach($datarancang_terminal as $val)
                                <tr>
                                    <td>{{ $val->nama_terminal}}</td>
                                    {{-- <td><option value="{{ $val->id_terminal }}">{{ $val->nama_terminal }}</option></td> --}}
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->sk_penetapan_lokasi_file }}" download target="_blank"> {{ $val->sk_penetapan_lokasi }} </a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->ba_serah_terima_file }}" download target="_blank"> {{ $val->ba_serah_terima }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->sertifikat_file }}" download target="_blank"> {{ $val->sertifikat }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->feasibility_study_file }}" download target="_blank"> {{ $val->feasibility_study }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->master_plan_file }}" download target="_blank"> {{ $val->master_plan }}</a></td>
                                    <td>
                                        @if($menu->update==1)
                                        <button type="button"  class="btn btn-sm btn-success edit_data" style="width:100%;" id="{{ $val->id_rancang_terminal }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                                        @endif
                                        @if($menu->delete==1)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_rancang_terminal }})" class="btn btn-sm btn-danger"> Hapus <i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>Terminal</th>
                                        <th>SK Penetapan Lokasi</th>
                                        <th>Berita Acara Serah Terima/P3D</th>
                                        <th>Sertifikat</th>
                                        <th>Feasibility Study</th>
                                        <th>Master Plan/DED</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                 <!-- Modal edit -->
                 <div class="modal fade text-start" id="editrancangterminal" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <form class="form" method="post" action="/updatepostrancangterminal" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" name="idrc" id="idrc">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #17abb0;">
                                <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Edit Rencana Pembangunan Terminal</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <input type="text" class="form-control" name="terminal" id="terminal" required="" oninvalid="this.setCustomValidity('Nama terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div> -->
                                       {{--  <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select" name="nama_terminal" id="upnama_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">SK Penetapan Lokasi</label>
                                            <input type="file" class="form-control" name="sk_penetapan_lokasi" id="upsk_penetapan_lokasi" oninvalid="this.setCustomValidity('')" oninput="setCustomValidity('')">
                                            {{-- @foreach($datarancang_terminal as $val)
                                            <option value="{{ $val->sk_penetapan_lokasi_file }}">{{ $val->sk_penetapan_lokasi }}</option>
                                            @endforeach --}}
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Berita Acara Serah Terima/P3D</label>
                                            <input type="file" class="form-control" name="ba_serah_terima" id="ba_serah_terima" oninvalid="this.setCustomValidity('Upload Berita Acara Serah Terima')" oninput="setCustomValidity('')">
                                            {{-- @foreach($datarancang_terminal as $val)
                                            <option value="{{ $val->ba_serah_terima_file }}">{{ $val->ba_serah_terima }}</option>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Sertifikat</label>
                                            <input type="file" class="form-control" name="sertifikat" id="sertifikat" oninvalid="this.setCustomValidity('Upload Sertifikat')" oninput="setCustomValidity('')">
                                            {{-- @foreach($datarancang_terminal as $val)
                                            <option value="{{ $val->sertifikat_file }}">{{ $val->sertifikat }}</option>
                                            @endforeach --}}
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Feasibility Study</label>
                                            <input type="file" class="form-control" name="feasibility_study" id="feasibility_study" oninvalid="this.setCustomValidity('Upload Feasibility Study')" oninput="setCustomValidity('')">
                                            {{-- @foreach($datarancang_terminal as $val)
                                            <option value="{{ $val->feasibility_study_file }}">{{ $val->feasibility_study }}</option>
                                            @endforeach --}}
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Master Plan/Ded</label>
                                            <input type="file" class="form-control" name="master_plan" id="master_plan" oninvalid="this.setCustomValidity('Upload Master Plan')" oninput="setCustomValidity('')">
                                            {{-- @foreach($datarancang_terminal as $val)
                                            <option value="{{ $val->master_plan_file }}">{{ $val->master_plan }}</option>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Update</button>
                                    </div>
                                </div>
         
                                </form>
                            </div>
                            <hr>

            </section>
            <!--/ Row grouping -->
                       


            <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 mx-50 pb-5">
                            <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                            <!-- form -->
                            <form method="post" action="/deleterancangterminal">
                                @csrf
                                <div class="col-12">
                                    <center>
                                        <h5>Apakah anda yakin menghapus data ini ?</h5>
                                    </center>
                                    <input type="hidden" name="idrt" id="idrt">
                                    <!-- <input type="hidden" name="type" id="type"> -->
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

             <!-- Modal add -->
             <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
                <form class="form" method="post" action="/simpanrancangterminal" enctype="multipart/form-data">
                    @csrf()
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #17abb0;">
                                <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Rencana Pembangunan Terminal</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <input type="text" class="form-control" name="terminal" id="terminal" required="" oninvalid="this.setCustomValidity('Nama terminal harus diisi')" oninput="setCustomValidity('')">
                                        </div> -->
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select" name="nama_terminal" id="nama_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">SK Penetapan Lokasi</label>
                                            <input type="file" class="form-control" name="sk_penetapan_lokasi" id="sk_penetapan_lokasi" oninvalid="this.setCustomValidity('Upload SK Penetapan')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Berita Acara Serah Terima/P3D</label>
                                            <input type="file" class="form-control" name="ba_serah_terima" id="ba_serah_terima" oninvalid="this.setCustomValidity('Upload Berita Acara Serah Terima')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Sertifikat</label>
                                            <input type="file" class="form-control" name="sertifikat" id="sertifikat" oninvalid="this.setCustomValidity('Upload Sertifikat')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Feasibility Study</label>
                                            <input type="file" class="form-control" name="feasibility_study" id="feasibility_study" oninvalid="this.setCustomValidity('Upload Feasibility Study')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Master Plan/Ded</label>
                                            <input type="file" class="form-control" name="master_plan" id="master_plan" oninvalid="this.setCustomValidity('Upload Master Plan')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <hr>

        
        </div>                                                
    </div>
</div>
<!-- END: Content-->


<script type="text/javascript">

    $(document).ready(function() {
        $(document).on('click', '.registerusers', function() {
            $('#myModalAdd').modal('show');
        });

        $(document).on('click', '.edit_data', function() {
            var idubh = $(this).attr('id');
            $.ajax({
                url :'/updaterancangterminal/'+ idubh,
                method : 'GET',
                dataType : 'json',
                success:function(data){
                    $('#idrc').val(data.data.id_rancang_terminal);
                    $('#upnama_terminal').val(data.data.kode_terminal);
                    $('#editrancangterminal').modal('show');
                   }
            })
        });
    });



    function confdelete(val) {
        document.getElementById('idrt').value = val;
        // document.getElementById('type').value = "rt";
    }


    function funcgate() {
        var gt = document.getElementById('notifgate').value;
        if (gt == "1") {
            document.getElementById('getgate').style.display = "inline";
        } else {
            document.getElementById('getgate').style.display = "none";
        }
    }

    function funcgateup() {
        var gt = document.getElementById('notifgateup').value;
        if (gt == "1") {
            document.getElementById('getgateup').style.display = "inline";
        } else {
            document.getElementById('getgateup').style.display = "inline";
        }
    }
</script>

@endsection