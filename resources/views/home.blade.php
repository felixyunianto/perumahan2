@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item active"><a href="#!">Dashboard</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header with-elements">
                <h6 class="card-header-title mb-0">Statistik Pemasukan</h6>
            </div>
            <div class="card-body">
                <canvas id="canvas-income" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header with-elements">
                <h6 class="card-header-title mb-0">Statistik Pengeluaran</h6>
            </div>
            <div class="card-body">
                <canvas id="canvas-out" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header with-elements">
                <h6 class="card-header-title mb-0">Status Proses</h6>
            </div>
            <div class="row no-gutters row-bordered">
                <div class="col-md-8 col-lg-12 col-xl-8">
                    <div class="card-body">
                        <canvas id="canvas-statusHouse" height="280" width="600"></canvas>
                    </div>
                </div>
                <div class="col-md-4 col-lg-12 col-xl-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6 col-xl-5 text-muted mb-3">Akad</div>
                            <div class="col-6 col-xl-7 mb-3">
                                <span class="text-big">{{ count($akad) }}</span>
                            </div>
                            <div class="col-6 col-xl-5 text-muted mb-3">ACC</div>
                            <div class="col-6 col-xl-7 mb-3">
                                <span class="text-big">{{ count($acc) }}</span>
                            </div>
                            <div class="col-6 col-xl-5 text-muted mb-3">Proses</div>
                            <div class="col-6 col-xl-7 mb-3">
                                <span class="text-big">{{ count($proses) }}</span>
                            </div>
                            <div class="col-6 col-xl-5 text-muted mb-3">Cash</div>
                            <div class="col-6 col-xl-7 mb-3">
                                <span class="text-big">{{ count($cash) }}</span>
                            </div>
                            <div class="col-6 col-xl-5 text-muted mb-3">Kosong</div>
                            <div class="col-6 col-xl-7 mb-3">
                                <span class="text-big">{{ count($kosong) }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4" style="height: 337px">
            <div class="card-header with-elements">
                <h6 class="card-header-title mb-0">Hutang / Piutang</h6>
            </div>

            <div class="card-body text-center">
                <div class="row no-gutters row-bordered">
                    <div class="col-6 col-xl-5 text-muted mb-3">Hutang</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">Rp. {{ number_format(1000000,0,'','.') }}</span>
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">Piutang</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">Rp. {{ number_format(2000000,0,'','.') }}</span>
                    </div>
                    <div class="col-6 col-xl-5 text-muted mb-3">Total</div>
                    <div class="col-6 col-xl-7 mb-3">
                        <span class="text-big">Rp. {{ number_format(1000000,0,'','.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
    var urlIncome = "{{ route('incomeChart') }}";
    var urlOutCome = "{{ route('outcomeChart') }}";
    var urlStatusHouse = "{{ route('statusHouse') }}";

    
        $(document).ready(function () {
            $.get(urlIncome, function (response) {
                var Years = new Array('', 'Januari', 'Februari', 'Maret', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                var Labels = new Array();
                var Prices = new Array();
                response.forEach(function (dataIncome) {
                    Prices.push(dataIncome);
                });
                var ctx = document.getElementById("canvas-income").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Years,
                        datasets: [{
                            label: "Laporan Pemasukan",
                            data: Prices,
                            borderWidth: 1,
                            borderColor: "#62d493",
                            backgroundColor: "#62d493",
                            pointBackgroundColor: "#55bae7",
                            pointBorderColor: "#55bae7",
                            pointHoverBackgroundColor: "#55bae7",
                            pointHoverBorderColor: "#55bae7",
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
            $.get(urlOutCome, function (response) {
                var Years = new Array('', 'Januari', 'Februari', 'Maret', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                var Labels = new Array();
                var Prices = new Array();
                response.forEach(function (dataOutcome) {
                    Prices.push(dataOutcome);
                });
                var ctx = document.getElementById("canvas-out").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: Years,
                        datasets: [{
                            label: "Laporan Pengeluaran",
                            data: Prices,
                            borderWidth: 1,
                            borderColor: "#FF6941",
                            backgroundColor: "#FF6941",
                            pointBackgroundColor: "#FF4A00",
                            pointBorderColor: "#FF4A00",
                            pointHoverBackgroundColor: "#FF4A00",
                            pointHoverBorderColor: "#FF4A00",
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })


        $.get(urlStatusHouse, function (response) {
            var Total = new Array();
            var statusProcess = new Array();
            var Labels = new Array();
            response.forEach(function (dataStatusHouse) {
                Total.push(dataStatusHouse.total);
                statusProcess.push(dataStatusHouse.status_process);
            });
            var ctx = document.getElementById("canvas-statusHouse").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: statusProcess,
                    datasets: [{
                        label: "Laporan Pengeluaran",
                        data: Total,
                        backgroundColor: ["#0074D9", "#FF4136", "#2ECC40",
                            "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00",
                            "#001f3f", "#39CCCC", "#01FF70", "#85144b",
                            "#F012BE", "#3D9970", "#111111", "#AAAAAA"
                        ]
                    }]
                },
                options: {}
            });
        })

    })

</script>
@endsection
