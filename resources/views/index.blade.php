@extends('layouts.master')
@section('title')
    الصفحة الرئيسية
@endsection

@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,700;1,400&family=Ruwudu:wght@600&display=swap"
        rel="stylesheet">
    <style>
        .card:hover {
            transform: translate(-5px, -10px);
        }

        .main-content-title {
            width: 80%;
            padding: 10px;
            background: transparent;
        }

        .main-content-title h2 {
            position: relative;
        }

        .main-content-title h2:after {
            content: "";
            width: 2px;
            height: 100%;
            background: #333;
            position: absolute;
            opacity: 0;
            animation: cursor 1s infinite;
            left: -10px;
        }

        @keyframes cursor {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <style>
        #chartdiv {
            width: 100%;
            height: 400px;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content" style="margin-top: 5px">
            <div>
                <div class="main-content-title mg-b-1 mg-b-lg-1 w-100">
                    <h2 class="tx-25 mg-b-0 mg-b-lg-0" style="font-family:'Amiri', serif; color:rgba(0, 0, 0, 0.515)">
                        مرحبا بك في فواتير
                    </h2>
                </div>
            </div>
        </div>
        <div class="main-dashboard-header-right" style="margin-top: 10px">
            <div>
            </div>
            <div>
                <h3 class="tx-13 d-flex justify-content-center badge badge-success">Admins</h3>
                <h5 style="text-align: center">{{App\Models\User::where('role_name','["Admin"]')->count()+App\Models\User::where('role_name','["owner"]')->count()}}</h5>
            </div>
            <div style="">
                <h3 class="tx-13 d-flex justify-content-center badge badge-info">Users</h3>
                <h5 style="text-align: center">{{App\Models\User::where('role_name','["User"]')->count()}}</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient" style="box-shadow: 5px 5px #337ded76;">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"
                            style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; text-shadow: 0.5px 0.5px black">
                            اجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ number_format(App\Models\Invoice::sum('Total'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white  font-weight-bold"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ App\Models\Invoice::count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient" style="box-shadow: 5px 5px #f7647d7e;">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"
                            style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; text-shadow: 0.5px 0.5px black">
                            الفواتير الغير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ number_format(App\Models\Invoice::where('Value_Status', 2)->sum('Total'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white font-weight-bold"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ App\Models\Invoice::where('Value_Status', 2)->count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">
                                    <?php
                                    $count_all = App\Models\Invoice::count();
                                    $count_invoices2 = App\Models\Invoice::where('Value_Status', 2)->count();
                                    if ($count_invoices2 == 0) {
                                        echo $count_invoices2 = 0;
                                    } else {
                                        echo round($count_invoices2 = ($count_invoices2 / $count_all) * 100, 2) . '%';
                                    }
                                    ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient" style="box-shadow: 5px 5px #3bca9a84;">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"
                            style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ; text-shadow: 0.5px 0.5px black">
                            الفواتير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ number_format(App\Models\Invoice::where('Value_Status', 1)->sum('Total'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white font-weight-bold"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ App\Models\Invoice::where('Value_Status', 1)->count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    <?php
                                    $count_all = App\Models\Invoice::count();
                                    $count_invoices2 = App\Models\Invoice::where('Value_Status', 1)->count();
                                    if ($count_invoices2 == 0) {
                                        echo $count_invoices2 = 0;
                                    } else {
                                        echo round($count_invoices2 = ($count_invoices2 / $count_all) * 100, 2) . '%';
                                    }
                                    ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient" style="box-shadow: 5px 5px #d8975587;">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"
                            style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; text-shadow: 0.5px 0.5px black">
                            الفواتير المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ number_format(App\Models\Invoice::where('Value_Status', 3)->sum('Total'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white font-weight-bold"
                                    style="font-size: 15px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                    {{ App\Models\Invoice::where('Value_Status', 3)->count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">
                                    <?php
                                    $count_all = App\Models\Invoice::count();
                                    $count_invoices2 = App\Models\Invoice::where('Value_Status', 3)->count();
                                    if ($count_invoices2 == 0) {
                                        echo $count_invoices2 = 0;
                                    } else {
                                        echo round($count_invoices2 = ($count_invoices2 / $count_all) * 100, 2) . '%';
                                    }
                                    ?>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>

        <div class=" container d-flex flex-wrap justify-content-center mt-4">
            <div style="width: auto">
                <canvas id="canvas"></canvas>
            </div>
            <div style="width: auto">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>
    </div>
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>

    <script>
        $(function() {
            typitvs();
        });

        function typitvs() {
            var h2 = $(".main-content-title h2");
            var text = $(h2).text();
            $(h2).text("");
            var i = 0;
            var len = text.length;
            setInterval(function() {
                if (i < len) {
                    $(h2).append(text[i]);
                    i++;
                }
            }, 100);
        }
    </script>

    <script>
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            // yellow: 'rgb(255, 205, 86)',
            green: 'rgb(31,177,130)',
            // blue: 'rgb(54, 162, 235)',
            // purple: 'rgb(153, 102, 255)',
            // grey: 'rgb(231,233,237)'
        };
        var ctx = document.getElementById("canvas").getContext("2d");
        var myBar = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["مدفوعة جزئيا", "مدفوعة", "غير مدفوعة"],
                datasets: [{
                    label: 'العدد:',
                    backgroundColor: [
                        chartColors.orange,
                        chartColors.green,
                        chartColors.red
                    ],
                    data: [
                        {{ App\Models\Invoice::where('Value_Status', 3)->count() }},
                        {{ App\Models\Invoice::where('Value_Status', 1)->count() }},
                        {{ App\Models\Invoice::where('Value_Status', 2)->count() }}
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                    // text: "احصائية الفواتير",
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: false,
                },
                responsive: true,
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["مدفوعة جزئيا", "مدفوعة", "غير مدفوعة"],
                datasets: [{
                    backgroundColor: [
                        'rgb(255, 159, 64)',
                        'rgb(31,177,130)',
                        'rgb(255, 99, 132)',
                    ],
                    data: [
                        {{ App\Models\Invoice::where('Value_Status', 3)->count() }},
                        {{ App\Models\Invoice::where('Value_Status', 1)->count() }},
                        {{ App\Models\Invoice::where('Value_Status', 2)->count() }},
                    ]
                }]
            }
        });
    </script>
@endsection
