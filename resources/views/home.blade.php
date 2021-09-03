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
                <h6 class="card-header-title mb-0">Statistik Pemasukan & Pengeluaran</h6>
            </div>
            <div class="card-body">
                <canvas id="canvas-income" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header with-elements">
                <h6 class="card-header-title mb-0">Status Rumah</h6>
            </div>

            <div class="row no-gutters row-bordered">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="justify-content-end m-3">
                        <form action="{{ route('home') }}" method="get" id="block_chart">
                            <select name="block_id" id="block_id" class="float-right">
                                <option value="">Pilih</option>
                                @foreach ($house as $h)
                                <option value="{{ $h->id }}">{{ $h->name_block }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        <canvas id="canvas-statusHouse" height="260" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('script')
<script>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script src="https://rawgit.com/beaver71/Chart.PieceLabel.js/master/build/Chart.PieceLabel.min.js"></script>
<script>
    var urlIncome = "{{ route('incomeChart') }}";
    var urlStatusHouse = "{{ route('statusHouse') }}";



    $(document).ready(function () {
        $.get(urlIncome, function (response) {
            var Years = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            var Labels = new Array();
            var priceIn = new Array();
            var priceOut = new Array();
            var profit = new Array();

            response[0].forEach(function (data) {
                priceIn.push(data)
                console.log('Data Masuk ' + data);
            });

            response[1].forEach(function (data) {
                priceOut.push(data)
                console.log('Data Keluar ' + data);
            });

            profit = response[2];

            var ctx = document.getElementById("canvas-income").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Years,
                    datasets: [{
                            label: "Pemasukan",
                            data: priceIn,
                            borderWidth: 1,
                            borderColor: "#55bae7",
                            backgroundColor: "#55bae7",
                            pointBackgroundColor: "#55bae7",
                            pointBorderColor: "#55bae7",
                            pointHoverBackgroundColor: "#55bae7",
                            pointHoverBorderColor: "#55bae7",
                            fill: false
                        },
                        {
                            label: "Pengeluaran",
                            data: priceOut,
                            borderWidth: 1,
                            borderColor: "#FF6941",
                            backgroundColor: "#FF6941",
                            pointBackgroundColor: "#FF4A00",
                            pointBorderColor: "#FF4A00",
                            pointHoverBackgroundColor: "#FF4A00",
                            pointHoverBorderColor: "#FF4A00",
                            fill: false
                        },
                        {
                            label: "Laba : Rp. " + profit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."),
                            borderWidth: 1,
                            borderColor: "#00ff00",
                            backgroundColor: "#00ff00",
                        }
                    ]
                },
                options: {
                    tooltips: {
                        callbacks: {
                            label: function (t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = t.yLabel >= 1000 ? 'Rp.' + t.yLabel.toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                                return xLabel + ': ' + yLabel;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return 'Rp.' + value.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, ".");
                                    } else {
                                        return 'Rp.' + value;
                                    }
                                },
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
                statusProcess.push(dataStatusHouse.status_process + ' = ' + dataStatusHouse
                    .total);
                Labels.push(dataStatusHouse.status_process)
            });
            var ctx = document.getElementById("canvas-statusHouse").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Labels,
                    datasets: [{
                        data: Total,
                        backgroundColor: ["#0074D9", "#FF4136", "#2ECC40",
                            "#FF851B", "#7FDBFF", "#e9e9e9"
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    pieceLabel: {
                        render: 'value',
                        fontColor: '#000',
                        position: 'outside',
                        segment: true
                    },
                }
            });
        })
    })

    var chartStatusHouse = document.getElementById('block_id');
    chartStatusHouse.addEventListener('change', function () {
        $.get(urlStatusHouse + '?block_id=' + chartStatusHouse.options[chartStatusHouse.selectedIndex].value,
            function (response) {
                var Total = new Array();
                var statusProcess = new Array();
                var Labels = new Array();
                response.forEach(function (dataStatusHouse) {
                    Total.push(dataStatusHouse.total);
                    statusProcess.push(dataStatusHouse.status_process + ' = ' + dataStatusHouse
                        .total);
                        Labels.push(dataStatusHouse.status_process)
                });
                var ctx = document.getElementById("canvas-statusHouse").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Labels,
                        datasets: [{
                            data: Total,
                            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40",
                                "#FF851B", "#7FDBFF", "#e9e9e9"
                            ]
                        }]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'right'
                        },
                        pieceLabel: {
                            render: 'value',
                            fontColor: '#000',
                            position: 'outside',
                            segment: true
                        },
                    }
                });

            })
    })

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

</script>
@endsection
