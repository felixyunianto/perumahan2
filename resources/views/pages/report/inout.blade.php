@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">LABA RUGI</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Laba Rugi</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <h3>Pemasukan</h3>
        <table width="60%">
            <tbody>
                <tr>
                    <td colspan="3">Pendapatan / Penjualan</td>
                </tr>
                @php
                    $no = 1;
                @endphp
                @foreach ($incomes as $income)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $income->block->name_block }}</td>
                        <td style="text-align: right">{{ number_format($income->total_price, 0,'',',') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot style="border-top: 1px solid black">
                <tr>
                    <td colspan="2">TOTAL (A)</td>
                    <td style="text-align: right"> {{ number_format($incomes->sum('total_price'), 0, '', ',') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection