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
                            <h2 class="content-header-title float-start mb-0">Data PO Bus</h2>
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
                @if($menu->create==1)
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah PO Bus</button>
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
<div style="padding-bottom: 10px; font-size: 12px;">
<table id="example" class="table table-striped table-responsive" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;" >
        <thead>
            <tr>
                <th>Nama</th>
                <th>No. Izin</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datapo as $val)
            <tr>
                <td>{{ $val->nama_po }}</td>
                <td>{{ $val->no_izin }}</td>
                <td>{{ $val->alamat }}</td>
                <td>
                    @if($menu->update==1)
                    <a href="/editpo/{{ $val->id_perusahaan_otobus }}"  class="btn btn-sm btn-success edit_datax" style="width:60%;" id="{{ $val->id_perusahaan_otobus  }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></a>  
                    @endif
                    @if($menu->delete==1)
                    <a style="width:60%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id_perusahaan_otobus }})" class="btn btn-sm btn-danger"> <span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>No. Izin</th>
                <th>Alamat</th>
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
    <!-- Modal add PO -->
    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpanpo" enctype="multipart/form-data" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form PO Bus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode PO Bus</label>
                                            <input type="text" class="form-control" name="kode_po_bus" required="" oninvalid="this.setCustomValidity('Kode PO bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama PO Bus</label>
                                            <input type="text" class="form-control" name="nama_po_bus"  required="" oninvalid="this.setCustomValidity('Nama PO Bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Direktur</label>
                                            <input type="text" class="form-control" name="nama_direktur" required="" oninvalid="this.setCustomValidity('Nama direktur harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Izin</label>
                                            <input type="text" class="form-control" name="no_izin" required="" oninvalid="this.setCustomValidity('Nomor Izin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>AKAP</option>
                                                <option>AKADP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="6" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary registerroleuser"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form> 
    </div>



    <!-- Modal edit PO -->
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatedatapobus"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form PO Bus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode PO Bus</label>
                                            <input type="text" class="form-control" name="kode_po_bus" id="kode_po_bus" required="" oninvalid="this.setCustomValidity('Kode PO bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama PO Bus</label>
                                            <input type="text" class="form-control" name="nama_po_bus" id="nama_po_bus"  required="" oninvalid="this.setCustomValidity('Nama PO Bus harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama Direktur</label>
                                            <input type="text" class="form-control" name="nama_direktur" id="nama_direktur" required="" oninvalid="this.setCustomValidity('Nama direktur harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Izin</label>
                                            <input type="text" class="form-control" name="no_izin" id="no_izin" required="" oninvalid="this.setCustomValidity('Nomor Izin harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" name="tgl_kadaluarsa" id="tgl_kadaluarsa" required="" oninvalid="this.setCustomValidity('Tanggal kadaluarsa harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" id="tipe" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>AKAP</option>
                                                <option>AKADP</option>
                                                <option>Pariwisata</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp" required="" oninvalid="this.setCustomValidity('No telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="6" id="alamat" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" id="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" id="id_kota"  oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <input class="form-check-input" name="status" type="checkbox" id="inlineCheckbox1" value="1" checked />
                                            <label class="form-check-label" for="inlineCheckbox1">Aktif</label>
                                        </div>
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


    <div class="modal fade" id="moddelete" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Informasi</h1>

                                <!-- form -->
                                <form method="post" action="/deletepo">
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
                  url :'/api/updatedatapo/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id_perusahaan_otobus);
                      $('#kode_po_bus').val(data.data.kode_po);
                      $('#nama_po_bus').val(data.data.nama_po);
                      $('#nama_direktur').val(data.data.nama_direktur);
                      $('#no_izin').val(data.data.no_izin);
                      $('#tgl_kadaluarsa').val(data.data.tgl_kadaluarsa);
                      $('#tipe').val(data.data.tipe);
                      $('#no_telp').val(data.data.no_telp);
                      $('#alamat').val(data.data.alamat);
                      $('#kode_pos').val(data.data.kode_pos);
                      $('#id_kota').val(data.data.id_kota);
                      $('#myModalUpdate').modal('show');
                  }
                })
          });

    });
    function confdelete(val){
            document.getElementById('iduser').value= val;
        }
  </script>
    
@endsection