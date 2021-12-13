@extends('html.index')
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-3 col-md-5 col-11">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5></h5>
                                    <p class="card-text font-small-3"><h5>Terminal</h5></p>
                                    <h3 class="mb-75 mt-0 pt-10">
                                        <h3>{{ $datauserid->nama_terminal }}</h3>
                                    </h3>
                                    <div style="margin-top: 30px;">
                                    <a href="/profilterminalprint/{{ $datauserid->kode_terminal }}/web" class="btn btn-info fa fa-bus"> Profil Terminal</a>
                                </div>
                                    {{-- <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" /> --}}
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-9 col-md-9 col-9">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistik Penumpang Bulan Ini</h4>
                                    <div class="d-flex align-items-center">
                                       {{--  <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p> --}}
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                         <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ $grp_statistic_penumpangob->penumpang_tiba }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Tiba</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ $grp_statistic_penumpangob->penumpang_turun }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Turun</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ $grp_statistic_penumpangob->penumpang_naik }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Naik</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ $grp_statistic_penumpangob->penumpang_berangkat }}</h4>
                                                    <p class="card-text font-small-3 mb-0">Berangkat</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>

                    {{-- <div class="row match-height">
                        <div class="col-lg-4 col-12">
                            <div class="row">
                                <!-- Bar Chart - Orders -->
                               <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats">
                                        <div class="card-body pb-50">
                                            <h6>Kendaraan Masuk</h6>
                                            <h2 class="fw-bolder mb-1">6,24k</h2>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->

                                <!-- Line Chart - Profit -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats">
                                        <div class="card-body pb-50">
                                            <h6>Kendaraan Keluar</h6>
                                            <h2 class="fw-bolder mb-1">2,00k</h2>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Line Chart - Profit -->

                                <!-- Earnings Card -->
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="card earnings-card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="card-title mb-1">Earnings</h4>
                                                    <div class="font-small-2">This Month</div>
                                                    <h5 class="mb-1">$4055.56</h5>
                                                    <p class="card-text text-muted font-small-2">
                                                        <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <div id="earnings-chart"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Earnings Card -->
                            </div>
                        </div> --}}

                        <!-- Revenue Report Card -->
                        <div class="row">
                        <div class="col-lg-6 col-6">
                            <div class="card card-revenue-budget">
                                <div style="padding: 20px">
                                <center><h4>Produksi Kendaraan Bulan Ini</h4></center>
                                </div>
                                {{-- <div id="chart" style="margin-top: -30px;"></div> --}}
                                <form method="post" action="/filter">
                                    @csrf
                                <div class="row" style="padding: 30px;">
                                    {{-- <div class="col-md-5">
                                        <select class="form-control" name="tahunproduksikendaraan">
                                            <option value="">Pilih Tahun</option>
                                            <?php
                                            $yaer = 2021;
                                            for($yaerfirst = 2000; $yaerfirst <= $yaer; $yaerfirst++){ 
                                            ?>
                                            <option>{{ $yaerfirst }}</option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success filterkendaraan">Filter</button>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/dashboard"  class="btn btn-success filterkendaraan">Refresh</a>
                                    </div> --}}
                                </div>
                            </form>
                                <div style="padding: 10px;">
                                    <div id="columnchart_material" style="width: 530px; height: 430px; margin-top: 0px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <div class="card card-revenue-budget container">
                                <div style="margin-top: 20px;">
                                <center><h4>Jumlah Kendaraan Bulan Ini</h4></center>
                                </div>
                                 <form method="post" action="/filter2">
                                    @csrf
                                    <div class="row" style="margin-top: 50px;">
                                   
                                </div>
                            </form>
                            <div style="padding:10px; margin-top: 35px;">
                                <div id="chart_div" style="width: 500px; height: 425px"></div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                        <!--/ Revenue Report Card -->
                    </div>

                    
                    </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMaterial);

        function drawMaterial() {
            

              var data = google.visualization.arrayToDataTable([
                ['-','Kendaraan Valid', 'Kendaraan Tidak Valid'],
                <?php foreach($datagrafikkendaraanjumkend as $val){ ?>
                ['-',{{ $val->kendaraan_valid }},{{ $val->kendaraan_not_valid }}],
                <?php } ?>
              ]);

              var materialOptions = {
                chart: {
                  title: '',
                },
                hAxis: {
                  title: 'Total Population',
                  minValue: 0,
                },
                vAxis: {
                  title: 'City'
                },
                bars: 'horizontal'
              };
              var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
              materialChart.draw(data, materialOptions);
            }
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                          ['-','AKAP kend tiba', 'AKAP kend keluar','AKDP kend tiba','AKDP kend keluar'],
                           <?php foreach($datagrafikkendaraan as $val){ ?>
                                ['-',{{ $val->AKAP_kendaraan_tiba }},{{ $val->AKAP_kendaraan_keluar }}, {{ $val->AKDP_kendaraan_tiba }},{{ $val->AKDP_kendaraan_keluar }}],
                            <?php } ?>
                        ]);

                        var options = {
                         colors: ['#0ac710', '#f54242','#e6ff42','#426bff'],
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
            });

       

    </script>
   @endsection