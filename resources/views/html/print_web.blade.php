<!DOCTYPE html>
<html lang="en">
<head>
  <title>Print Out</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body style="font-size: 12px; background-color: #3a4a58;">
  <div class="container-fluid ">
  <div class="row">
    <!-- <div class="col-md-3">MAP</div> -->
    <div class="col-md-10"> 

        <div class="alert alert-warning" style="border-radius: 15px; margin-top: 20px;">
          <div class="container">
 {{--  <div style="display: inline;" id="idbutoncetak">
    <button class="btn btn-info btn-block" onclick="printprofilterminal('print')" style="color: white"><i class="fa fa-print"></i> Cetak</button>
  </div> --}}
</div>
            <center><h3>{{ $data_terminal->nama_terminal }}</h3></center>
        </div>
        <div class="card" style="margin-top: -10px; border-radius: 15px;">
          <div class="card-body" style="background-color: #193a94; color: white;border-radius: 15px;">
              <div class="row">
                  <div class="col col-md-4">
                      Lokasi
                  </div>
                  <div class="col col-md-7">
                      : {{ $data_terminal->alamat }}
                  </div>
                  <div class="col col-md-4">
                      Luas Lahan
                  </div>
                  <div class="col col-md-7">
                      : {{ $data_terminal->luas_lahan }} m2
                  </div>
                  <div class="col col-md-4">
                      Koordinat
                  </div>
                  <div class="col col-md-7">
                    <?php
                    $titikkoordinat = $data_terminal->titik_koordinat;
                    $dds = json_decode($titikkoordinat);
                    ?>
                      : {{ $dds[0]->lat}}
                  </div>
                  <div class="col col-md-4">
                      Status P3D
                  </div>
                  <div class="col col-md-7">
                      : {{ $data_terminal->status_p3d }}
                  </div>
                 
              </div>
          </div>

        </div>
        <div class="card" style="margin-top: 0px; border-radius: 15px;">
          <div class="card-body" style="background-color: #193a94; color: white;border-radius: 15px;">
              <div class="row">
              
                  <div class="col col-md-4">
                      <h4>Data Produksi</h4>
                  </div>
                  <div class="col col-md-7">
                     
                  </div>
                   <div class="col col-md-4">
                      Periode
                  </div>
                  <div class="col col-md-7">
                     : <?php
                        $datenow = date('Y-m-d');
                        $format = date('Y-m-d', strtotime('-1 days', strtotime($datenow)));
                      //  $dd = date('Y-m-d',$format);
                        echo $format;
                       ?>
                  </div>
                  <div class="col col-md-4">
                      Jumlah Kendaraan
                  </div>
                  <div class="col col-md-7">
                      : {{ $hitungjumlahkendaraanperhari }} Bus
                  </div>
                  <div class="col col-md-4">
                      Jumlah Penumpang
                  </div>
                  <div class="col col-md-7">
                  <?php 
                  $jumlahTotal =0;
                    foreach($hitungjumlahpenumpang as $val){
                      $jumlahpenumpangperharinya = (int)$val->jumlah_penumpang_tiba - (int)$val->jumlah_penumpang_turun + (int)$val->jumlah_penumpang_naik;
                     $jumlahTotal += $jumlahpenumpangperharinya;
                   }
                   echo  ": ".$jumlahTotal. " Orang";
                   //   echo $juml;
                    ?>
                  </div>
                  <div class="col col-md-4">
                      Trayek
                  </div>
                  <div class="col col-md-7">
                      : {{ $hitungjumlahakap }} AKAP  {{ $hitungjumlahakadp }} AKDP
                  </div>
                  <div class="col col-md-4">
                      Kelas Terminal
                  </div>
                  <div class="col col-md-7">
                      : {{ $data_terminal->tipe }}
                  </div>
              </div>
          </div>
          
        </div>
<div class="row">
    <div class="col-md-12">
         <div class="card" style="margin-top: 0px; border-radius: 15px;">
          <div class="card-body" style="background-color: #243f8a; color: white;border-radius: 15px;">
            <center><h4>Data SDM</h4></center>
            <center>
            <div class="row">
                <div class="col-md-4">
                    PNS : {{ $hitungjumlahsdmpns }}
                </div>
                <div class="col-md-4">
                    Non PNS : {{ $hitungjumlahsdmnonpns }}
                </div>
                <div class="col-md-4">
                    PPNS : {{ $hitungjumlahsdmppns }}
                </div>
            </div>
            </center>
          </div>
      </div>
    </div>
</div>
<br>  
<div class="row">
    <div class="col-md-4">
        <div class="card" style="border-radius: 15px;">
  <div class="card-body" style="background-color: #7398ff; color:white;border-radius: 15px;">
    <center>Fasilitas Utama</center>
    <div>
        <table class="table table-hover table-responsive" style="font-size: 12px;color:white;">
          @foreach($datafasilitasutama as $val)
            <tr>
                <td>{{ $val->nama_fasilitas_utama }}</td>
                <td>{{ $val->status_barang_utama }}</td>
            </tr>
            @endforeach

        </table>
    </div>
  </div>
</div>
</div>
    <div class="col-md-4">
        <div class="card" style="border-radius: 15px;">
  <div class="card-body" style="background-color: #f2e038; color:black;border-radius: 15px;">
    <center>Fasilitas Penunjang</center>
    <div>
        <table class="table table-hover table-responsive" style="font-size: 12px;color:black">
            @foreach($datafasilitaspenunjang as $val)
            <tr>
                <td>{{ $val->nama_fasilitas_penunjang }}</td>
                <td>{{ $val->status_barang_penunjang }}</td>
            </tr>
            @endforeach

        </table>
    </div>
</div>
</div>
</div>
<div class="col-md-4">
    <div class="mapouter"><div class="gmap_canvas"><iframe width="370" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:444px;width:454px;}</style></div></div>
</div>
</div>      
    </div>
    <div class="col-md-2" style="margin-top: 20px;">
        @foreach($dataprofil_terminal as $val)
        <img src="/upload/file_kompetensi/{{ $val->kompetensi_file }}" class="img img-thumbnail">     
        @endforeach
      </div>
  </div>

</body>
</html>
<script type="text/javascript">
    //window.print();
    function printprofilterminal(f){
      if(f=='print'){
        document.getElementById('idbutoncetak').style.display="none";
        window.print();
      } else {
        document.getElementById('idbutoncetak').style.display="inline";
      }
    }
</script>













