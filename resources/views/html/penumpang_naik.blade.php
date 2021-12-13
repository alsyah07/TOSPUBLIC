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
                            <h2 class="content-header-title float-start mb-0">Data Penumpang Naik</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Operasional Terminal</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produksi Penumpang</a>
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
                   {{--  <button type="button" class="btn btn-primary registerusers" >+ Tambah Penumpang Tiba</button> --}}
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
            <div class="content-body">
                <!-- Row grouping -->
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card container-fluid">
                                {{-- <div class="card-header border-bottom">
                                    <h4 class="card-title">Row Grouping</h4>
                                </div> --}}
<div style="padding-bottom: 10px; font-size: 12px;">
<table id="example" class="table table-responsive table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
                <th>Nama Terminal</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>No. Kendaraan</th>
                <th>Nama Perusahaan</th>
                <th>Terminal Tujuan</th>
                <th>Jumlah Penumpang</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kendaraan_tiba as $val)
            <tr>
                <td>{{ $terminalasal->nama_terminal }}</td>
                <td>{{ $val->tgl }}</td>
                <td>{{ $val->jam }}</td>
                @if($val->no_kendaraan==null)
                <td>{{ $val->no_kendaraan }}</td>
                @else
                 <td>{{ $val->noken }}</td>
                @endif
                <td>{{ $val->nama_po }}</td>
                <td>{{ $val->nama_terminal }}</td>
                <td>{{ $val->jumlah_penumpang_naik }}</td>
                <td>
                    @if($menu->update==1)
                    <button  class="btn btn-sm btn-success edit_data" style="width:100%;" id="{{ $val->id_kendaraan_tiba }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  
                    @endif
                    @if($menu->delete==1)
                    <a style="width:100%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_kendaraan_tiba }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama Terminal</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>No. Kendaraan</th>
                <th>Nama Perusahaan</th>
                <th>Terminal Tujuan</th>
                <th>Jumlah Penumpang</th>
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

    <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalUpdatetiba" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatekendaraannaik"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="type" value="naik">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form Penumpang Naik</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nomor Kendaraan</label>
                                            {{-- <select class="form-select kendaraanhfuncup"  name="no_kendaraan" id="no_kendaraan" required="" oninvalid="this.setCustomValidity('Silahkan pilih kendaraan')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kendaraan</option>
                                                @foreach($kendaraan as $val)
                                                <option value="{{ $val->no_kendaraan }}">{{ $val->no_kendaraan }}</option>
                                                @endforeach
                                            </select> --}}
                                            <input type="text" class="form-control kendaraanhfuncup" name="no_kendaraan" id="no_kendaraan" readonly required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            <select class="form-select"  name="id_terminal"  required="" disabled="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="{{ $dataterminalget->id_wilayah }}">{{ $dataterminalget->nama_wilayah }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Petugas</label>
                                            <input type="text" class="form-control" name="nama" id="namaup" value="{{ Auth::user()->name }}" readonly="">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">ID PO Bus</label>
                                            <input type="text" class="form-control" id="kode_poup" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Trayek</label>
                                            <input type="text" class="form-control" id="nama_trayekup" required="" disabled="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Kendaraan</label>
                                            <input type="text" class="form-control" id="jenis_kendaraanAup" disabled="" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jenis Angkutan</label>
                                            <input type="text" class="form-control" id="tipe_kendaraanup" disabled="" required="" oninvalid="this.setCustomValidity('Merek harus diisi')" oninput="setCustomValidity('')">
                                        </div>    
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal Asal</label>
                                            <input type="number" class="form-control" name="kapasitas" disabled="" required="" oninvalid="this.setCustomValidity('Kapasitas harus diisi')" oninput="setCustomValidity('')">
                                        </div> --}}
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Terminal Tujuan</label>
                                            <select class="form-select"  name="terminal_tujuan" id="terminal_tujuanup" required="" oninvalid="this.setCustomValidity('Silahkan pilih tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tujuan</option>
                                                @foreach($dataterminal as $vv)
                                                <option value="{{ $vv->id_terminal }}">{{ $vv->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div>     --}}                               
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jumlah Penumpang Naik</label>
                                            <input type="number" class="form-control" placeholder="Masukan jumlah penumpang naik" name="jumlah_penumpang" id="jumlah_penumpang_naik" required="">
                                        </div>   
                                         <div class="form-group mb-1">
                                            <label class="control-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tgl"  id="tglup" required="">
                                        </div>       
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jam</label>
                                            <input type="time" class="form-control" name="jam"  id="jamup" required="" >
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Catatan</label>
                                            <textarea class="form-control" name="catatan"   id="catatanup" rows="4"></textarea>
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
                                <form method="post" action="/deletekendaraantiba">
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

     <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.registerusers',function(){
             $('#myModalAdd').modal('show');
        });
        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/api/updatedatakendaraantiba/'+idubh+'/'+ {{ Auth::user()->id }},
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#no_kendaraan').val(data.data.no_kendaraan)
                      $('#kode_poup').val(data.data.kode_po)
                      $('#nama_trayekup').val(data.data.nama_trayek)
                      $('#jenis_kendaraanAup').val(data.data.jenis_kendaraan)
                      $('#tipe_kendaraanup').val(data.data.tipe_kendaraan)
                      $('#nama_trayekup').val(data.data.nama_trayek)
                      $('#terminal_tujuanup').val(data.data.terminal_tujuan)
                      $('#tglup').val(data.data.tgl)
                      $('#jamup').val(data.data.jam)
                      $('#catatanup').val(data.data.catatan)
                      $('#tgl_kadaluarsaup').val(data.data.tgl_kadaluarsa);
                      $('#tgl_kadaluarsa_kpsup').val(data.data.tgl_kadaluarsa_kps);
                      $('#masa_berlaku_kendaraanup').val(data.data.masa_berlaku_kendaraan);
                      $('#masa_berlaku_kendaraanup').val(data.data.masa_berlaku_kendaraan);
                      $('#jumlah_penumpang_naik').val(data.data.jumlah_penumpang_naik);
                       $('#id').val(data.data.id_kendaraan_tiba)
                      

                      $('#myModalUpdatetiba').modal('show');
                  }
                })
          });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection