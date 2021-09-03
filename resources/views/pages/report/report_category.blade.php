@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Laba Rugi</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Laba Rugi</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('report.laba-rugi') }}" method="get">
            <div class="input-group mb-3 col-md-6 float-right">
                <input type="text" id="range-date" name="date" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                </div>
                <a target="_blank" class="btn btn-primary ml-2" id="exportpdf"><i class="fa fa-file-pdf"></i> Export PDF</a>
            </div>
        </form>
        <div class="table-responsive">
            <table id="report-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Uraian</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A. Pendapatan / Penjualan</td>
                        <td>Rp. {{ number_format($income,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>B. Harga Pokok Penjualan</td>
                        <td>Rp. {{ number_format($cost_of_goods_sold,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>C. Laba Kotor (A-B)</td>
                        <td>Rp. {{ number_format($income - $cost_of_goods_sold,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>D. Beban Usaha</td>
                        <td>Rp. {{ number_format($business_expenses,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>E. Laba (Rugi) Usaha (C-D)</td>
                        <td>Rp. {{ number_format(($income-$cost_of_goods_sold)-$business_expenses,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>F. Pendapatan lain-lain</td>
                        <td>Rp. {{ number_format($other_income,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>G. Beban lain-lain</td>
                        <td>Rp. {{ number_format($other_expenses,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>H. Jumlah Pendapatan & Beban (F-G)</td>
                        <td>Rp. {{ number_format($other_income - $other_expenses,0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>I. Laba Sebelum Pajak (E+H)</td>
                        <td>Rp. {{ number_format((($income-$cost_of_goods_sold)-$business_expenses) + ($other_income - $other_expenses),0,'','.') }}</td>
                    </tr>
                    <tr>
                        <td>J. Estimasi Beban Pajak Sebelum Penghasilan</td>
                        <td>Rp. {{ number_format($estimated_income,0,'','.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // $('#report-table').DataTable({})
</script>
@endsection
@section('link')
<link rel="stylesheet" href="public/assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">

@endsection
@section('script')

<script src="{{asset('public/assets/libs/moment/moment.js')}}"></script>
<script src="{{asset('public/assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>

<script>
    $(function () {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $('#range-date').daterangepicker({
            opens: (isRtl ? 'left' : 'right'),
            showWeekNumbers: true
        });
    });

    $(document).ready(function () {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

        $('#exportpdf').attr('href', '/pdf-category-transaction/' + start.format('YYYY-MM-DD') + '+' +
            end.format('YYYY-MM-DD'))

        $('#range-date').daterangepicker({
            startDate: start,
            endDate: end
        }, function (first, last) {
            $('#exportpdf').attr('href', '/pdf-category-transaction/' + first.format(
                'YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })

</script>

@endsection
