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
            <table>
                <tr>
                    <td style="width: 10%">A</td>
                    <td colspan="6">PEMASUKAN</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="6">Pendapatan/Penjualan</td>
                </tr>
                @foreach ($housing_incomes as $housing_income)
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2">{{ $housing_income->name_block }}</td>
                        <td style="width: 10%"></td>
                        <td style="width: 10%"></td>
                        <td style="width: 30%; text-align: right">
                            {{ number_format($housing_income->accountings->sum('price'), 0, '', '.') }}</td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black">
                    <td></td>
                    <td colspan="2">TOTAL (A)</td>
                    <td colspan="3">&nbsp;</td>
                    <td style="width: 30%; text-align: right">{{ number_format($total_income, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 10%">B</td>
                    <td colspan="6">PENGELUARAN</td>
                </tr>
                @php
                    $no_outcome = 1;
                @endphp
                @foreach ($housing_outcomes as $housing_outcome)
                    <tr>
                        <td></td>
                        <td colspan="2">{{ $housing_outcome->block->name_block }}</td>
                        <td colspan="2">{{ $housing_outcome->subCategory->name }}</td>
                        <td colspan="2" style="text-align: right">{{ number_format($housing_outcome->price,0,'','.') }}</td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black">
                    <td colspan="7">&nbsp;</td>
                </tr>
                @foreach ($total_per_blocks as $total_per_block)
                <tr>
                    <td></td>
                    <td colspan="3">{{ $total_per_block->block->name_block }}</td>
                    <td colspan="3" style="text-align: right">{{ number_format($total_per_block->price,0,'','.') }}</td>
                </tr>
                @endforeach
                <tr >
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="border-top: 1px solid black">
                    <td></td>
                    <td colspan="2">TOTAL (B)</td>
                    <td colspan="3">&nbsp;</td>
                    <td style="width: 30%; text-align: right">{{ number_format($total_outcome, 0, '', '.') }}</td>
                </tr>               
            </table>
        </div>
    </div>
@endsection
