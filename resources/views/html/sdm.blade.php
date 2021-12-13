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
                            <h2 class="content-header-title float-start mb-0">Data HRM</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen User</a>
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
                    <button type="button" class="btn btn-primary registerusers" >+ Tambah HRM</button>
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
<table id="example" class="table table-responsive table-striped" style="width:100%; overflow: auto; overflow: auto;white-space:nowrap;">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Terminal</th>
                 <th>Pendidikan Terakhir</th>
                 <th>Foto</th>
                <th style="width: 100px;">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datasdm as $val)
            <tr>
                <td>{{ $val->nip }}</td>
                <td>{{ $val->nama_sdm }}</td>
                <td>{{ $val->jabatan }}</td>
                <td>{{ $val->tipe }}</td>
                <td>{{ $val->alamat }}</td> 
                <td>{{ $val->nomor }}</td> 
                <td>{{ $val->nama_terminal }}</td>  
                <td>{{ $val->pendidikan_terakhir }}</td>   
                @if($val->foto_sdm !="-" && $val->foto_sdm !=null)
                <td><img id="/upload/foto_hrm/{{ $val->foto_sdm }}" class="img img-thumbnail foto" width="100" src="/upload/foto_hrm/{{ $val->foto_sdm }}"></td>
                @else
                <td>File Kosong</td>
                @endif       
                <td>
                    @if($menu->create==1)
                    <a href="/kompetensi_sdm/{{ $val->id }}" class="btn btn-sm btn-warning"> Kompetensi </span><i class="fas fa-file"></i></a>
                    @endif
                    @if($menu->update==1)
                    <button  class="btn btn-sm btn-success edit_data" style="width:40%;" id="{{ $val->id }}"><span style="font-size: 10px;">Edit </span><i class="fas fa-edit"></i></button>  
                    @endif
                    @if($menu->delete==1)
                    <a style="width:50%;" href="#"  data-bs-toggle="modal" data-bs-target="#moddelete" onclick="confdelete({{ $val->id }})" class="btn btn-sm btn-danger"><span style="font-size: 10px;"> Hapus </span> <i class="fas fa-trash"></i></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Terminal</th>
                <th>Pendidikan Terakhir</th>
                <th>Foto</th>
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

    <div class="modal fade text-start" id="myModalAddFoto" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
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
    <!-- Modal add -->
    <div class="modal fade text-start" id="myModalAdd" tabindex="-1" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/simpansdm" enctype="multipart/form-data" > 
        @csrf()
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form HRM</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIP</label>
                                            <input type="text" class="form-control" name="nip"  required="" oninvalid="this.setCustomValidity('NIP harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="nama_sdm" required="" oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jabatan</label>
                                           <input type="text" class="form-control" name="jabatan" required="" oninvalid="this.setCustomValidity('Jabatan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" oninvalid="this.setCustomValidity('Silahkan pilih Tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>ASN</option>
                                                <option>PPNPN</option>
                                                <option>PPNS</option>
                                                <option>Penguji</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Pendidikan Terakhir</label>
                                            <select class="form-select"  name="pendidikan_terakhir" required="" oninvalid="this.setCustomValidity('Silahkan pilih Pendidikan terakhir')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option>SD</option>
                                                <option>SMP</option>
                                                <option>SMA</option>
                                                <option>D3</option>
                                                <option>S1</option>
                                                <option>S2</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" required="" oninvalid="this.setCustomValidity('No. Telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select"  name="id_terminal" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
{{--                                         <div class="form-group mb-1">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select" readonly="" disabled="" name="id_wilayah" required="" oninvalid="this.setCustomValidity('Silahkan pilih Wilayah')" oninput="setCustomValidity('')">
                                                <option value="{{ $datawilayah->id_wilayah }}">{{ $datawilayah->nama_wilayah }}</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required=""  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                         <div class="form-group mb-1">
                                            <label class="control-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="row">
                                        
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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



    <!-- Modal edit -->
    <div class="modal fade text-start" id="myModalUpdate" tabindex="-2" aria-labelledby="myModalLabel16" aria-hidden="true">
    <form class="form" method="post" action="/updatepostsdm" enctype="multipart/form-data"> 
        @csrf()
        <input type="hidden" name="id" id="id">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #17abb0;">
                    <h4 class="modal-title" id="myModalLabel16" style="color: white">Form HRM</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="control-label">NIP</label>
                                            <input type="text" class="form-control" name="nip" id="nip"  required="" oninvalid="this.setCustomValidity('NIP harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="nama_sdm" id="nama_sdm" required="" oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Jabatan</label>
                                           <input type="text" class="form-control" name="jabatan" id="jabatan" required="" oninvalid="this.setCustomValidity('Jabatan harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Tipe</label>
                                            <select class="form-select"  name="tipe" required="" id="tipes" oninvalid="this.setCustomValidity('Silahkan pilih Tipe')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Tipe</option>
                                                <option>ASN</option>
                                                <option>PPNPN</option>
                                                <option>PPNS</option>
                                                <option>Penguji</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Pendidikan Terakhir</label>
                                            <select class="form-select"  name="pendidikan_terakhir" id="pendidikan_terakhir" required="" oninvalid="this.setCustomValidity('Silahkan pilih Pendidikan terakhir')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option>SD</option>
                                                <option>SMP</option>
                                                <option>SMA</option>
                                                <option>D3</option>
                                                <option>S1</option>
                                                <option>S2</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">No. Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp" required="" oninvalid="this.setCustomValidity('No. Telepon harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Terminal</label>
                                            <select class="form-select"  name="id_terminal" id="id_terminals" required="" oninvalid="this.setCustomValidity('Silahkan pilih terminal')" oninput="setCustomValidity('')">
                                                <option value="">Pilih</option>
                                                @foreach($dataterminal as $val)
                                                <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <div class="form-group mb-1">
                                            <label class="control-label">Wilayah</label>
                                            <select class="form-select" readonly="" disabled="" id="id_wilayah" name="id_wilayah" required="" oninvalid="this.setCustomValidity('Silahkan pilih Wilayah')" oninput="setCustomValidity('')">
                                                <option value="{{ $datawilayah->id_wilayah }}">{{ $datawilayah->nama_wilayah }}</option>
                                            </select>
                                        </div> --}}
                                        <div class="form-group mb-1">
                                            <label class="control-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" rows="4" required="" id="alamat"  oninvalid="this.setCustomValidity('Alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                        <div class="form-group mb-1">
                                            <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png" id="my_image" class="img img-thumbnail" width="250">
                                        </div>
                                         <div class="form-group mb-1">
                                            <label class="control-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="row">
                                        
                                       {{--  <div class="form-group mb-1">
                                            <label class="control-label">Kode Pos</label>
                                            <input type="number" class="form-control" name="kode_pos" id="kode_pos" required="" oninvalid="this.setCustomValidity('Kode pos harus diisi')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="control-label">Kelurahan / Kecamatan / Kota</label>
                                            <select class="form-select"  name="id_kota" required="" id="id_kota" oninvalid="this.setCustomValidity('Silahkan pilih kelurahan / kecamatan / kota')" oninput="setCustomValidity('')">
                                                <option value="">Pilih Kelurahan / Kecamatan / Kota</option>
                                                @foreach($datakota as $val)
                                                <option value="{{ $val->id_kota }}">{{ $val->nama_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
                                <form method="post" action="/deletesdm">
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

        $(document).on('click','.foto',function(){
          //  $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
           var imagefoto = $(this).attr('src');
           $('#imagepreview').attr('src',imagefoto); 
             $('#myModalAddFoto').modal('show');
        });

        $(document).on('click','.edit_data',function(){
            var idubh = $(this).attr('id');
                $.ajax({
                  url :'/updatesdm/'+idubh,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('dataje',data);
                      $('#id').val(data.data.id);
                      $('#id_terminal').val(data.data.kode_terminal);
                      $('#nip').val(data.data.nip);
                      $('#nama_sdm').val(data.data.nama_sdm);
                      $('#jabatan').val(data.data.jabatan);
                      $('#tipes').val(data.data.tipes);
                      $('#no_telp').val(data.data.no_telp);
                      $('#id_wilayah').val(data.datawilayah.id_wilayah);
                      $('#alamat').val(data.data.alamat);
                      $('#kode_pos').val(data.data.kode_pos);
                      $('#id_kota').val(data.data.id_kota);
                      $('#pendidikan_terakhir').val(data.data.pendidikan_terakhir);
                       $('#id_terminals').val(data.data.kode_terminal);
                       $('#my_image').attr('src','/upload/foto_hrm/'+data.data.foto_sdm);
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