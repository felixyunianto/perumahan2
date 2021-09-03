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
                <tr style="font-weight: bold">
                    <td style="width: 5%">A</td>
                    <td colspan="6">PEMASUKAN</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="6">Pendapatan/Penjualan</td>
                </tr>
                @foreach ($housing_incomes as $housing_income)
                    <tr>
                        <td></td>
                        <td colspan="2">{{ $housing_income->name_block }}</td>
                        <td></td>
                        <td style="width: 10%"></td>
                        <td style="width: 10%"></td>
                        <td style="width: 30%; text-align: right">
                            {{ number_format($housing_income->accountings->sum('price'), 0, '', '.') }}</td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black; font-weight: bold">
                    <td></td>
                    <td colspan="2">TOTAL (A)</td>
                    <td colspan="3">&nbsp;</td>
                    <td style="width: 30%; text-align: right">{{ number_format($total_income, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="font-weight: bold">
                    <td style="width: 5%">B</td>
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
                        <td colspan="2" style="text-align: right">{{ number_format($housing_outcome->price, 0, '', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black">
                    <td colspan="7">&nbsp;</td>
                </tr>
                @foreach ($total_per_blocks as $total_per_block)
                    <tr>
                        <td></td>
                        <td colspan="3">{{ $total_per_block->block->name_block }}</td>
                        <td colspan="3" style="text-align: right">{{ number_format($total_per_block->price, 0, '', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="border-top: 1px solid black; font-weight: bold">
                    <td></td>
                    <td colspan="2">TOTAL (B)</td>
                    <td colspan="3">&nbsp;</td>
                    <td style="width: 30%; text-align: right">{{ number_format($total_outcome, 0, '', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="font-weight: bold">
                    <td style="width: 5%">C</td>
                    <td colspan="6">BEBAN USAHA</td>
                </tr>

                @foreach ($operating_exprenses as $operating_exprense)
                    <tr>
                        <td></td>
                        <td colspan="3">{{ $operating_exprense->subcategory->name }}</td>
                        <td colspan="3" style="text-align: right">
                            {{ number_format($operating_exprense->price, 0, '', '.') }}</td>
                    </tr>
                @endforeach
                <tr style="border-top: 1px solid black; font-weight: bold">
                    <td></td>
                    <td colspan="2">TOTAL (C)</td>
                    <td colspan="3">&nbsp;</td>
                    <td style="width: 30%; text-align: right">{{ number_format($total_exprenses, 0, '', '.') }}</td>
                </tr>

                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>

                <tr style="font-weight: bold">
                    <td colspan="3">TOTAL (A-B-C)</td>
                    <td colspan="4" style="text-align: right">{{ number_format($total_income - $total_outcome - $total_exprenses, 0, '','.') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
