<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Terminal Online System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets_web/img/favtos.png" rel="icon">
  <link href="assets_web/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_web/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets_web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_web/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_web/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_web/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_web/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets_web/css/style.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h6>KEMENTERIAN PERHUBUNGAN | DITJEN PERHUBUNGAN DARAT</h6>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tujuan Terminal Online</a></li>
          <li><a class="nav-link scrollto " href="#faq">Profile Terminal</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->


    </div>
  </header><!-- End Header -->

   <!-- ======= Hero Section ======= -->
   <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
          <div>
            <h1>Terminal Online System</h1>
            <h2>Pelaksanaan Terminal Operasional System Dalam Terminal Berbasis Digital.</h2>
            <a href="#about" class="btn-get-started scrollto">Lebih Lanjut</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
          <img src="assets_web/img/TOS_logo_Transparent.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6" data-aos="zoom-in">
            <img src="assets_web/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-contents-center" data-aos="fade-left">
            <div class="content pt-4 pt-lg-0">
              <h4 style="text-align: center">Tujuan Terminal Online Sistem</h4>
              <p class="fst-italic" style="text-align: justify">
                Sebagai salah satu komponen dari sistem transportasi yang mempunyai fungsi utama sebagai 
                tempat pemberhentian sementara kendaraan umum untuk menaikkan dan menurunkan penumpang hingga sampai ketujuan akhir suatu perjalanan pada terminal tipe A.<br>
                Terminal online memiliki tujuan sebagai berikut :
              </p>
              <ul>
                <li><i class="bi bi-check-circle"></i> Menjamin ketersediaan pelayanan angkutan penumpang umun dalam trayek.</li>
                <li><i class="bi bi-check-circle"></i> Menjamin ketersedian data penumpang dan perjalanan kendaraan (live inventory).</li>
                <li><i class="bi bi-check-circle"></i> Menjamin perlindungan data yang diperoleh dari transaksi tiket secara elektronik.</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Profile Terminal Tipe A</h2>
          <p>Terminal Tipe A berfungsi melayani kendaraan penumpang umum untuk angkutan antar kota antar propinsi (AKAP), dan angkutan lintas batas antar negara, angkutan antar kota dalam propinasi (AKDP), angkutan kota (AK) serta angkutan pedesaan (ADES).</p>
        </div><br>
        <div style="padding-bottom: 10px; font-size: 12px;">
<table id="example" class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>Nama Terminal</th>
                <th>Tipe</th>
                <th>Kota</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataterminal as $val)
            <tr>
                <td>{{ $val->nama_terminal }}</td>
                <td>{{ $val->tipe }}</td>
                <td>{{ $val->nama_kota }}</td>
                <td>
                    <a href="/profilterminalprint/{{ $val->kode_terminal }}/web" target="_blank" class="btn btn-sm btn-success btn-block" style="width:100%"> Lihat Profil </span><i class="fas fa-eye"></i></a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama Terminal</th>
                <th>Tipe</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
        </tfoot>
    </table>
</div>
       {{--  <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">BPTD WILAYAH I PROVINSI ACEH<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                <ul>
                  <p><a href="#!">Terminal Langsa</a></p>
                  <p><a href="#!">Terminal Lhokseumawe</a></p>
                  <p><a href="#!">Terminal Meulaboh</a></p>
                  <p><a href="#!">Terminal Batoh</a></p>
                  <p><a href="#!">Terminal Paya Ilang</a></p>
                </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">BPTD WILAYAH II PROVINSI SUMATERA UTARA <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Tanjung Pinggir</a></p>
                <p><a href="#!">Terminal Madya Tarutung</a></p>
                <p><a href="#!">Terminal Sibolga</a></p>
                <p><a href="#!">Terminal Padang Bulan</a></p>
                <p><a href="#!">Terminal Amplas</a></p>
                <p><a href="#!">Terminal Pinang Baris</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">BPTD WILAYAH III PROVINSI SUMATERA BARAT  <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Anak Air</a></p>
                <p><a href="#!">Terminal Kiliran Jao</a></p>
                <p><a href="#!">Terminal Bareh Solok</a></p>
                <p><a href="#!">Terminal Simpang Aur</a></p>
                <p><a href="#!">Terminal Jati Pariaman</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">BPTD WILAYAH IV PROVINSI RIAU DAN KEPRI <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Bangkinang</a></p>
                <p><a href="#!">Terminal Payung Sekaki</a></p>
                <p><a href="#!">Terminal Dumai</a></p>
                <p><a href="#!">Terminal Gerbangsari</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">BPTD WILAYAH IX PROVINSI JAWA BARAT <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal KH. Ahmad Sanusi</a></p>
                <p><a href="#!">Terminal Ciakar</a></p>
                <p><a href="#!">Terminal Indihiang</a></p>
                <p><a href="#!">Terminal Kertawangunan</a></p>
                <p><a href="#!">Terminal Subang</a></p>
                <p><a href="#!">Terminal Banjar</a></p>
                <p><a href="#!">Terminal Cikampek</a></p>
                <p><a href="#!">Terminal Baranangsiang</a></p>
                <p><a href="#!">Terminal Induk Bekasi</a></p>
                <p><a href="#!">Terminal Kalijaya Cikarang</a></p>
                <p><a href="#!">Terminal Jatijajar</a></p>
                <p><a href="#!">Terminal Cicaheum</a></p>
                <p><a href="#!">Terminal Leuwipanjang</a></p>
                <p><a href="#!">Terminal Harjamukti</a></p>
                <p><a href="#!">Terminal Guntur Melati</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">BPTD WILAYAH V PROVINSI JAMBI <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Alam Barajo</a></p>
                <p><a href="#!">Terminal Muara Bungoxx</a></p>
                <p><a href="#!">Terminal Bangko</a></p>
                <p><a href="#!">Terminal Sri Bulan</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq7" class="collapsed question">BPTD WILAYAH VI PROVINSI SUMATERA SELATAN DAN BABEL <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq7" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Alang-Alang Lebar</a></p>
                <p><a href="#!">Terminal Kayuagung</a></p>
                <p><a href="#!">Terminal Batu Kuning</a></p>
                <p><a href="#!">Terminal Betung</a></p>
                <p><a href="#!">Terminal Karya Jaya</a></p>
                <p><a href="#!">Terminal Simpang Priuk</a></p>
                <p><a href="#!">Terminal Regional Lahat</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq8" class="collapsed question">BPTD WILAYAH VII PROVINSI LAMPUNG DAN BENGKULU <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq8" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Simpang Nangka</a></p>
                <p><a href="#!">Terminal Air Sebakul</a></p>
                <p><a href="#!">Terminal Rajabasa</a></p>
                <p><a href="#!">Terminal Betan Subing</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq9" class="collapsed question">BPTD WILAYAH VIII PROVINSI BANTEN <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq9" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Pakupatan</a></p>
                <p><a href="#!">Terminal Labuan</a></p>
                <p><a href="#!">Terminal Mandala Lebak</a></p>
                <p><a href="#!">Terminal Merak</a></p>
                <p><a href="#!">Terminal Poris Plawad</a></p>
                <p><a href="#!">Terminal Pondok Cabe</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq10" class="collapsed question">BPTD WILAYAH X PROVINSI JAWA TENGAH DAN DI.YOGYAKARTA <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq10" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Purworejo</a></p>
                <p><a href="#!">Terminal Cepu</a></p>
                <p><a href="#!">Terminal Bangga Bangun Desa</a></p>
                <p><a href="#!">Terminal Giri Adipura</a></p>
                <p><a href="#!">Terminal Ir. Soekarno</a></p>
                <p><a href="#!">Terminal Kebumen</a></p>
                <p><a href="#!">Terminal Pekalongan</a></p>
                <p><a href="#!">Terminal Induk Pemalang</a></p>
                <p><a href="#!">Terminal Mendolo</a></p>
                <p><a href="#!">Terminal Bawen</a></p>
                <p><a href="#!">Terminal Tidar</a></p>
                <p><a href="#!">Terminal Tingkir</a></p>
                <p><a href="#!">Terminal Jati</a></p>
                <p><a href="#!">Terminal Bobot Sari</a></p>
                <p><a href="#!">Terminal Demak</a></p>
                <p><a href="#!">Terminal Tegal</a></p>
                <p><a href="#!">Terminal Giwangan</a></p>
                <p><a href="#!">Terminal Dhaksinarga</a></p>
                <p><a href="#!">Terminal Purwokerto</a></p>
                <p><a href="#!">Terminal Mangkang</a></p>
                <p><a href="#!">Terminal Tirtonadi</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq11" class="collapsed question">BPTD WILAYAH XI PROVINSI JAWA TIMUR <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq11" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Arjosari</a></p>
                <p><a href="#!">Terminal Arya Wiraraja</a></p>
                <p><a href="#!">Terminal Bangkalan</a></p>
                <p><a href="#!">Terminal Banyuangga</a></p>
                <p><a href="#!">Terminal Gayatri</a></p>
                <p><a href="#!">Terminal Kertonegoro</a></p>
                <p><a href="#!">Terminal Pacitan</a></p>
                <p><a href="#!">Terminal Patria</a></p>
                <p><a href="#!">Terminal Purboyo</a></p>
                <p><a href="#!">Terminal Selo Aji</a></p>
                <p><a href="#!">Terminal Tamanan</a></p>
                <p><a href="#!">Terminal Tawangalun</a></p>
                <p><a href="#!">Terminal Surodakan</a></p>
                <p><a href="#!">Terminal Rajekwesi</a></p>
                <p><a href="#!">Terminal Pandaan Pasuruan</a></p>
                <p><a href="#!">Terminal Kambang Putih</a></p>
                <p><a href="#!">Terminal Sri Tanjung</a></p>
                <p><a href="#!">Terminal Osowilangun</a></p>
                <p><a href="#!">Terminal Purabaya</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq12" class="collapsed question">BPTD WILAYAH XII PROVINSI BALI DAN NTB <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq12" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Mengwi</a></p>
                <p><a href="#!">Terminal Mandalika</a></p>
                <p><a href="#!">Terminal Sumer Payung</a></p>
                <p><a href="#!">Terminal Dara</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq14" class="collapsed question">BPTD WILAYAH XIII PROVINSI NTT <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq14" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Kefamenanu</a></p>
                <p><a href="#!">Terminal Bimoku</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq15" class="collapsed question">BPTD WILAYAH XIV PROVINSI KALIMANTAN BARAT <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq15" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Sei Ambawang</a></p>
                <p><a href="#!">Terminal Singkawang</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq16" class="collapsed question">BPTD WILAYAH XIX PROVINSI SULAWESI SELATAN DAN BARAT <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq16" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Induk Lumpue</a></p>
                <p><a href="#!">Terminal Latenri Sessu Pekkae</a></p>
                <p><a href="#!">Terminal Petta Pongawai</a></p>
                <p><a href="#!">Terminal Daya</a></p>
                <p><a href="#!">Terminal Simbuang</a></p>
                <p><a href="#!">Terminal Tipalayo</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq17" class="collapsed question">BPTD WILAYAH XV PROVINSI KALIMANTAN SELATAN <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq17" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Gambut Barakat</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq18" class="collapsed question">BPTD WILAYAH XVI PROVINSI KALIMANTAN TENGAH <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq18" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal W.A. Gara</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq19" class="collapsed question">BPTD WILAYAH XVII PROVINSI KALTARA <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq19" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Batu Ampar</a></p>
                <p><a href="#!">Terminal Samarinda Seberang</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq20" class="collapsed question">BPTD WILAYAH XVIII PROVINSI SULAWESI TENGGARA <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq20" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Puuwatu</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq21" class="collapsed question">BPTD WILAYAH XX PROVINSI SULAWESI TENGAH <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq21" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Kasintuwu</a></p>
                <p><a href="#!">Terminal Mamboro</a></p>
                <p><a href="#!">Terminal Boroko</a></p>
                <p><a href="#!">Terminal Liwas</a></p>
                <p><a href="#!">Terminal Tangkoko</a></p>
                <p><a href="#!">Terminal Bolaang Mongondow</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq22" class="collapsed question">BPTD WILAYAH XXI PROVINSI GORONTALO <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq22" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Isimu</a></p>
                <p><a href="#!">Terminal Dungingi</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq23" class="collapsed question">BPTD WILAYAH XXV PROVINSI PAPUA <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq23" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Entrop</a></p>
              </ul>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq24" class="collapsed question">DINAS PERHUBUNGAN PROVINSI DKI <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq24" class="collapse" data-bs-parent=".faq-list">
              <ul>
                <p><a href="#!">Terminal Pulo Gebang</a></p>
                <p><a href="#!">Terminal Kampung Rambutan</a></p>
                <p><a href="#!">Terminal Kalideres</a></p>
                <p><a href="#!">Terminal Priok</a></p>
              </ul>
            </div>
          </li>

        </ul> --}}

      </div>
    </section> 
    
    <!--End Frequently Asked Questions Section -->     
      

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
  
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>TOS</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        DIRJEN HUBDAT | KEMENTERIAN PERHUBUNGAN RI
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets_web/vendor/aos/aos.js"></script>
  <script src="assets_web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets_web/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets_web/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets_web/vendor/php-email-form/validate.js"></script>
  <script src="assets_web/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets_web/js/main.js"></script>

</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</html>