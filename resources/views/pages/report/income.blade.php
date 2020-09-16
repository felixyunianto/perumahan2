@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pemasukan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pemasukan</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('income') }}" method="get">
            <div class="input-group mb-3 col-md-6 float-right">
                <input type="text" id="range-income" name="date" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                </div>
                <a target="_blank" class="btn btn-primary ml-2" id="exportpdf"><i class="fa fa-file-pdf"></i> Export PDF</a>
                <a target="_blank" class="btn btn-primary ml-2" id="exportexcel"><i class="fa fa-file-excel"></i> Export Excel</a>
            </div>
        </form>

        <div class="table-responsive">
            <table id="income-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($incomes as $income)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $income->name }}</td>
                        <td>{{ date('d F Y', strtotime($income->date)) }}</td>
                        <td>Rp. {{ number_format($income->price,0,'','.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td style="text-align: center"><b>TOTAL</b></td>
                        <td></td>
                        <td></td>
                        <td>Rp. {{ number_format($total,0,'','.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#income-table').DataTable({});

</script>
@endsection
@section('link')
<link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">

@endsection
@section('script')

<script src="{{asset('assets/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>

<script>
    $(function () {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $('#range-income').daterangepicker({
            opens: (isRtl ? 'left' : 'right'),
            showWeekNumbers: true
        });
    });

    $(document).ready(function () {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

        $('#exportpdf').attr('href', '/pdf-income/' + start.format('YYYY-MM-DD') + '+' +
            end.format('YYYY-MM-DD'))

        $('#exportexcel').attr('href', '/excel-income/' + start.format(
                'YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        $('#range-income').daterangepicker({
            startDate: start,
            endDate: end
        }, function (first, last) {
            $('#exportpdf').attr('href', '/pdf-income/' + first.format(
                'YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            $('#exportexcel').attr('href', '/excel-income/' + start.format(
                'YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))
        })
    })

</script>

@endsection
