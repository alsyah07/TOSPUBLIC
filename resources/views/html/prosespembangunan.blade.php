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
                        <h2 class="content-header-title float-start mb-0">Proses Pembangunan</h2>
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
                <button type="button" class="btn btn-primary registerusers">+ Tambah Terminal</button>
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
                                        <th>Imb</th>
                                        <th>Andaln</th>
                                        <th>Pre Contruction Meeting</th>
                                        <th>MC-0, MC-50, MC-100</th>
                                        <th>Laporan Progres Mingguan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                @foreach($dataproses_pembangunan as $val)
                                <tr>
                                    <td>{{ $val->nama_terminal}}</td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->imb_file }}" download target="_blank"> {{ $val->imb }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->andaln_file }}"download target="_blank"> {{ $val->andaln }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->pcm_file }}" download target="_blank"> {{ $val->pcm }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->mc_file }}" download target="_blank"> {{ $val->mc }}</a></td>
                                    <td><i class="fa fa-file" aria-hidden="true"><a href="{{ $val->laporan_progres_file }}" download target="_blank"> {{ $val->laporan_progres }}</a></td>
                                    <td>
                                         @if($menu->update==1)
                                        <button type="button"  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id_proses_pembangunan }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>
                                        <!-- <button class="btn btn-sm btn-success edit_data" style="width:10px;" id="{{ $val->id }}"><i class="fas fa-edit"></i></button>   -->
                                        @endif
                                         @if($menu->delete==1)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_proses_pembangunan }})" class="btn btn-sm btn-danger"> Hapus <i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>Terminal</th>
                                        <th>Imb</th>
                                        <th>Andaln</th>
                                        <th>Pre Contruction Meeting</th>
                                        <th>MC-0, MC-50, MC-100</th>
                                        <th>Laporan Progres Mingguan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                 <!-- Modal edit -->
                 <div class="modal fade text-start" id="editprosespembangunan" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
                    <form class="form" method="post" action="/updatepostprosespembangunan" enctype="multipart/form-data">
                        @csrf()
                        <input type="hidden" name="idpp" id="idpp">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #17abb0;">
                                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Edit Rencana Pembangunan Terminal</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- <div class="form-group mb-1">
                                                <label class="control-label">Terminal</label>
                                                <select class="form-select" name="nama_terminal" id="upnama_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                    @foreach($dataterminal as $val)
                                                    <option value="{{ $val->id_terminal }}">{{ $val->nama_terminal }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <div class="form-group mb-1">
                                                <label class="control-label">Imb</label>
                                                <input type="file" class="form-control" name="imb" id="imb" oninvalid="this.setCustomValidity('Upload Imb')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Andaln</label>
                                                <input type="file" class="form-control" name="andaln" id="andaln" oninvalid="this.setCustomValidity('Upload Andaln')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-1">
                                                <label class="control-label">Pre Contruction Meeting</label>
                                                <input type="file" class="form-control" name="pcm" id="pcm" oninvalid="this.setCustomValidity('Upload Pcm')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">MC-0, MC-50, MC-100</label>
                                                <input type="file" class="form-control" name="mc" id="mc" oninvalid="this.setCustomValidity('Upload Mc')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label class="control-label">Laporan Progres</label>
                                                <input type="file" class="form-control" name="laporan_progres" id="laporan_progres" oninvalid="this.setCustomValidity('Upload Laporan Progres')" oninput="setCustomValidity('')">
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
                            <form method="post" action="/deleteprosespembangunan">
                                @csrf
                                <div class="col-12">
                                    <center>
                                        <h5>Apakah anda yakin menghapus data ini ?</h5>
                                    </center>
                                    <input type="hidden" name="idpp" id="idpps">
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
                <form class="form" method="post" action="/simpanprosespembangunan" enctype="multipart/form-data">
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
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select" name="nama_terminal" id="nama_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->id_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Imb</label>
                                            <input type="file" class="form-control" name="imb" id="imb" oninvalid="this.setCustomValidity('Upload Imb')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Andaln</label>
                                            <input type="file" class="form-control" name="andaln" id="andaln" oninvalid="this.setCustomValidity('Upload Andaln')" oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Pre Contruction Meeting</label>
                                            <input type="file" class="form-control" name="pcm" id="pcm" oninvalid="this.setCustomValidity('Upload Pcm')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">MC-0, MC-50, MC-100</label>
                                            <input type="file" class="form-control" name="mc" id="mc" oninvalid="this.setCustomValidity('Upload Mc')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Laporan Progres</label>
                                            <input type="file" class="form-control" name="laporan_progres" id="laporan_progres" oninvalid="this.setCustomValidity('Upload Laporan Progres')" oninput="setCustomValidity('')">
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
                url :'/updateprosespembangunan/'+ idubh,
                method : 'GET',
                dataType : 'json',
                success:function(data){
                    $('#idpp').val(data.data.id_proses_pembangunan);
                    $('#upnama_terminal').val(data.data.id_terminal);
                    $('#editprosespembangunan').modal('show');
                   }
            })
        });

    });


    function confdelete(val) {
        document.getElementById('idpps').value = val;
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