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
                        <h2 class="content-header-title float-start mb-0">Pengajuan Persetujuan Pembangunan</h2>
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
                                        <th>Gambar Teknis</th>
                                        <th>Surat Usulan</th>
                                        <th>Kak Tor</th>
                                        <th>Surat Pertanggungjawaban Mutlak</th>
                                        <th>Rencana Kerja Dan Syarat-Syarat</th>
                                        <th>Justifikasi Teknis</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                @foreach($datapengajuan_terminal as $val)
                                <tr>
                                    <td>{{ $val->nama_terminal}}</td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->gambar_teknis_file }}" download target="_blank"> {{ $val->gambar_teknis }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->surat_usulan_file }}" download target="_blank"> {{ $val->surat_usulan }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->kak_tor_file }}" download target="_blank"> {{ $val->kak_tor }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->surat_pertanggungjawaban_mutlak_file }}" download target="_blank"> {{ $val->surat_pertanggungjawaban_mutlak }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->rencana_kerja_file }}" download target="_blank"> {{ $val->rencana_kerja }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->justifikasi_file }}" download target="_blank"> {{ $val->justifikasi }}</a></td>
                                    <td>
                                        @if($menu->update==1)
                                        <button type="button"  class="btn btn-sm btn-success edit_data" style="width:100%;" id="{{ $val->id_pengajuan_terminal }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                                        @endif
                                         @if($menu->delete==1)
                                        <!-- <button class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id }}"><i class="fas fa-edit"></i></button>   -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_pengajuan_terminal }})" class="btn btn-sm btn-danger"> Hapus <i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>Terminal</th>
                                        <th>Gambar Teknis</th>
                                        <th>Surat Usulan</th>
                                        <th>Kak Tor</th>
                                        <th>Surat Pertanggungjawaban Mutlak</th>
                                        <th>Rencana Kerja Dan Syarat-Syarat</th>
                                        <th>Justifikasi Teknis</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                 <!-- Modal edit -->
                 <div class="modal fade text-start" id="editpengajuanterminal" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <form class="form" method="post" action="/updatepostpengajuanterminal" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" name="idpt" id="idpt">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #17abb0;">
                                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Edit Pengajuan Persetujuan Pembangunan</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-1">
                                                <label class="control-label">Terminal</label>
                                                 <input type="text" readonly="" required="" class="form-control" name="kodeterminal" value="{{ $datauserid->nama_terminal }}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Gambar Teknis</label>
                                                <input type="file" class="form-control" name="gambar_teknis" id="upgambar_teknis" oninvalid="this.setCustomValidity('Upload Gambar Teknis')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Surat Usulan</label>
                                                <input type="file" class="form-control" name="surat_usulan" id="surat_usulan" oninvalid="this.setCustomValidity('Upload Surat Usulan')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Kak Tor</label>
                                                <input type="file" class="form-control" name="kak_tor" id="kak_tor" oninvalid="this.setCustomValidity('Upload Surat Pertanggungjawaban Mutlak')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-1">
                                                <label class="control-label">Surat Pertanggungjawaban Mutlak</label>
                                                <input type="file" class="form-control" name="surat_pertanggungjawaban_mutlak" id="surat_pertanggungjawaban_mutlak" oninvalid="this.setCustomValidity('Upload Feasibility Study')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Rencana Kerja dan Syarat-Syarat</label>
                                                <input type="file" class="form-control" name="rencana_kerja" id="rencana_kerja" oninvalid="this.setCustomValidity('Upload Rencana Kerja')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Justifikasi</label>
                                                <input type="file" class="form-control" name="justifikasi" id="justifikasi" oninvalid="this.setCustomValidity('Upload Justifikasi')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
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
                            <form method="post" action="/deletepengajuanterminal">
                                @csrf
                                <div class="col-12">
                                    <center>
                                        <h5>Apakah anda yakin menghapus data ini ?</h5>
                                    </center>
                                    <input type="hidden" name="idpt" id="idpts">
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
                <form class="form" method="post" action="/simpanpengajuanterminal" enctype="multipart/form-data">
                    @csrf()
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #17abb0;">
                                <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Pengajuan Persetujuan Pembangunan</h4>
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
                                            <label class="control-label">Gambar Teknis</label>
                                            <input type="file" class="form-control" name="gambar_teknis" id="gambar_teknis" oninvalid="this.setCustomValidity('Upload Gambar Teknis')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Surat Usulan</label>
                                            <input type="file" class="form-control" name="surat_usulan" id="surat_usulan" oninvalid="this.setCustomValidity('Upload Surat Usulan')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kak Tor</label>
                                            <input type="file" class="form-control" name="kak_tor" id="kak_tor" oninvalid="this.setCustomValidity('Upload Surat Pertanggungjawaban Mutlak')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Surat Pertanggungjawaban Mutlak</label>
                                            <input type="file" class="form-control" name="surat_pertanggungjawaban_mutlak" id="surat_pertanggungjawaban_mutlak" oninvalid="this.setCustomValidity('Upload Feasibility Study')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Rencana Kerja dan Syarat-Syarat</label>
                                            <input type="file" class="form-control" name="rencana_kerja" id="rencana_kerja" oninvalid="this.setCustomValidity('Upload Rencana Kerja')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Justifikasi</label>
                                            <input type="file" class="form-control" name="justifikasi" id="justifikasi" oninvalid="this.setCustomValidity('Upload Justifikasi')" oninput="setCustomValidity('')">
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
                url :'/updatepengajuanterminal/'+ idubh,
                method : 'GET',
                dataType : 'json',
                success:function(data){
                    $('#idpt').val(data.data.id_pengajuan_terminal);
                    $('#upnama_terminal').val(data.data.id_terminal);
                    $('#editpengajuanterminal').modal('show');
                   }
            })
        });
    });

    function confdelete(val) {
        document.getElementById('idpts').value = val;
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