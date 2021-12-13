<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
     body {
    margin:0;
    color:#edf3ff;
    background:#c8c8c8;
    background:url(https://hdqwalls.com/download/material-design-4k-2048x1152.jpg) fixed;
    background-size: cover;
    font:600 16px/18px 'Open Sans',sans-serif;
}
</style>
<body> 
 <div class="container">
<center>
        <div style="padding : 20px;">
        <img src="/gambar/logo_checker.png" width="100%">
        </div>
    </center>
@if(session('notif'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Sukses!</strong> {{ session('notif') }}
</div>
@endif

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="color: red; font-weight: bold">Input Data Kendaraan</button>
  </li>
 {{--  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="color: red; font-weight: bold">Turun</button>
  </li> --}}
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" style="color: red; font-weight: bold">RampCheck</button>
  </li>
</ul>
</div>
<div class="container">
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <form method="post" action="/updatechecker">
        @csrf()
        <input type="hidden" name="id_kendaraan_tiba" id="id_kendaraan_tiba">
        <div class="">
        <br>
        <center><h3>Form Penumpang Tiba</h3></center>
        <div class="login-form">
            <div class="sign-in-htm">
                {{-- <input type="hidden" name="penumpang" value="penumpang_tiba"> --}}
                {{-- <div class="group">
                    <label for="user" class="label">Penumpang</label>
                    <select class="form-control" name="penumpang" id="penumpang">
                        <option value="">Pilih</option>
                        <option value="penumpang_tiba">Penumpang Tiba</option>
                        <option value="penumpang_turun">Penumpang Turun</option>
                    </select>
                </div> --}}
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Nomor Kendaraan (Tanpa Spasi | contoh : AB1234XYZ)</label>
                    <input type="text" name="no_kendaraan" class="form-control datakendaraaninput1" placeholder="Masukan Nomor Kendaraan">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Kode PO Bus</label>
                    <input type="text" class="form-control" id="kode_po" readonly="">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Trayek</label>
                    <input type="text" class="form-control" id="nama_trayek">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jenis Angkutan</label>
                    <input type="text" class="form-control" readonly="" id="tipe_kendaraan">
                </div>
                {{--  <div class="mb-3 mt-3">
                    <label for="pass" class="label">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" required="">
                </div>
                 <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jam</label>
                    <input type="time" name="jam" class="form-control" required="">
                </div> --}}
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jumlah Penumpang Naik</label>
                    <input type="text" name="jumlah_penumpang_tiba" class="form-control" id="jumlah_penumpang_tibas">
                </div>
                  <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jumlah Penumpang Turun</label>
                    <input type="text" name="jumlah_penumpang_turun" class="form-control" id="jumlah_penumpang_tibas">
                </div>
                 <div class="mb-3 mt-3">
                    <label for="pass" class="label">Terminal Tujuan</label>
                    <select name="terminal_tujuan" class="form-control" required="">
                      <option value="">Pilih</option>
                      @foreach($dataterminal as $val)
                      <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <input type="submit" class="btn btn-warning btn-block" style="width:100%" value="Input">
                </div>
                <div class="hr"></div>
            </div>
            <div class="for-pwd-htm">
                <div class="form-group">
                   
                </div>
            </div>
        </div>
    </div>
</form>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <form method="post" action="/updatechecker">
        @csrf()
        <input type="hidden" name="id_kendaraan_tiba" id="id_kendaraan_tiba2">
        <div class="">
        <br>
        <center><h3>Form Penumpang Turun</h3></center>
        <div class="login-form">
            <input type="hidden" name="penumpang" value="penumpang_turun">
            <div class="sign-in-htm">
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Nomor Kendaraan</label>
                    <input type="text" name="no_kendaraan" class="form-control datakendaraaninput2" placeholder="Masukan Nomor Kendaraan">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">ID PO Bus</label>
                    <input type="text" class="form-control" id="kode_po2" readonly="">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Trayek</label>
                    <input type="text" class="form-control" id="nama_trayek2">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jenis Angkutan</label>
                    <input type="text" class="form-control" readonly="" id="tipe_kendaraan2">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Jumlah Penumpang Turun</label>
                    <input type="text" name="jumlah_penumpang" class="form-control" id="jumlah_penumpang_tibas2">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Terminal</label>
                    <select name="terminal_tujuan" class="form-control">
                      <option value="">Pilih</option>
                      @foreach($dataterminal as $val)
                      <option value="{{ $val->kode_terminal }}">{{ $val->nama_terminal }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <input type="submit" class="btn btn-warning btn-block" style="width:100%" value="Input">
                </div>
                <div class="hr"></div>
            </div>
            <div class="for-pwd-htm">
                <div class="form-group">
                   
                </div>
            </div>
        </div>
    </div>
</form>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <form method="post" action="/inputrampcheck" enctype="multipart/form-data">
        @csrf()
        <input type="hidden" name="id_kendaraan_tiba" id="id_kendaraan_tiba">
        <div class="">
        <br>
        <center><h3>Form RampCheck</h3></center>
        <div class="login-form">
            <div class="sign-in-htm">
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Nomor Kendaraan</label>
                    <input type="text" name="no_kendaraan" class="form-control datakendaraaninput" placeholder="Masukan Nomor Kendaraan">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Foto Kendaraan</label>
                    <input type="file" class="form-control" name="foto_kendaraan">
                </div>
                <div class="mb-3 mt-3">
                    <label for="pass" class="label">Keterangan</label>
                    <select class="form-control" name="keterangan">
                        <option value="Lulus">Lulus</option>
                        <option value="Tidak Lulus">Tidak Lulus</option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <input type="submit" class="btn btn-warning btn-block" style="width:100%" value="Upload">
                </div>
            </div>
            <div class="for-pwd-htm">
                <div class="form-group">
                   
                </div>
            </div>
        </div>
    </div>
</form>
  </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('input','.datakendaraaninput1',function(){
            var nokend = $(this).val();
            console.log('caridata',nokend);
                $.ajax({
                  url :'/api/input_checker/'+nokend,
                  timeout: 30000,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datakendaraanceker',data.api_response_code);
                    if(data.api_response_code ==200){
                       $('#id_kendaraan_tiba').val(data.api_data.parameters.data.id_kendaraan_tiba)
                       $('#kode_po').val(data.api_data.parameters.data.kode_po)
                       $('#nama_trayek').val(data.api_data.parameters.data.nama_trayek)
                       $('#jenis_kendaraan').val(data.api_data.parameters.data.jenis_kendaraan)
                       $('#tipe_kendaraan').val(data.api_data.parameters.data.tipe_kendaraan)
                       $('#tgl').val(data.api_data.parameters.data.tgl)
                       $('#jam').val(data.api_data.parameters.data.jam)
                       $('#jumlah_penumpang_tiba').val(data.api_data.parameters.data.jumlah_penumpang_tiba)
                       $('#nama_terminal').val(data.api_data.parameters.data.nama_terminal)
                     } else {
                      let kosong = 'Nomor kendaraan belum terdaftar';
                       $('#id_kendaraan_tiba').val(kosong)
                       $('#kode_po').val(kosong)
                       $('#nama_trayek').val(kosong)
                       $('#jenis_kendaraan').val(kosong)
                       $('#tipe_kendaraan').val(kosong)
                       $('#tgl').val(kosong)
                       $('#jam').val(kosong)
                       $('#jumlah_penumpang_tiba').val(kosong)
                       $('#nama_terminal').val(kosong)
                     }
                  }
                })
          });

        $(document).on('input','.datakendaraaninput2',function(){
            var nokend = $(this).val();
                $.ajax({
                  url :'/api/input_checker/'+nokend,
                  method : 'GET',
                  dataType : 'json',
                  success:function(data){
                    console.log('datakendaraanceker',data);
                    if(data.api_response_code ==200){
                       $('#id_kendaraan_tiba2').val(data.api_data.parameters.data.id_kendaraan_tiba)
                       $('#kode_po2').val(data.api_data.parameters.data.kode_po)
                       $('#nama_trayek2').val(data.api_data.parameters.data.nama_trayek)
                       $('#jenis_kendaraan2').val(data.api_data.parameters.data.jenis_kendaraan)
                       $('#tipe_kendaraan2').val(data.api_data.parameters.data.tipe_kendaraan)
                       $('#tgl2').val(data.api_data.parameters.data.tgl)
                       $('#jam2').val(data.api_data.parameters.data.jam)
                       $('#jumlah_penumpang_tiba2').val(data.api_data.parameters.data.jumlah_penumpang_tiba)
                       $('#nama_terminal2').val(data.api_data.parameters.data.nama_terminal)
                     } else {
                      let kosong = 'Nomor kendaraan belum terdaftar';
                       $('#id_kendaraan_tiba2').val(kosong)
                       $('#kode_po2').val(kosong)
                       $('#nama_trayek2').val(kosong)
                       $('#jenis_kendaraan2').val(kosong)
                       $('#tipe_kendaraan2').val(kosong)
                       $('#tgl2').val(kosong)
                       $('#jam2').val(kosong)
                       $('#jumlah_penumpang_tiba2').val(kosong)
                       $('#nama_terminal2').val(kosong)
                     }
                  }
                })
          });



    });
</script>

</body>
</html>
