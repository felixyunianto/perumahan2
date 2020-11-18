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
        <table width="600px">
            <tr>
                <td colspan="4" style="font-size: 20px"><b>Penjualan</b></td>
            </tr>
            <tr>
                <td colspan="2">a. Perumahan</td>
                <td>:</td>
                <td>Rp. {{number_format($order_house,0,'','.') }}</td>
            </tr>
            {{-- HPP --}}
            <tr>
                <td colspan="4" style="font-size: 20px; padding-top: 10px"><b>HPP</b></td>
            </tr>
            {{-- Perolehan Tanah --}}
            <tr>
                <td colspan="2">a. Perolehan Tanah</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Harga Tanah</td>
                <td>:</td>
                <td>Rp. {{number_format($land_price, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- BPHTB</td>
                <td>:</td>
                <td>Rp. {{number_format($bphtb, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Pengukuran</td>
                <td>:</td>
                <td>Rp. {{number_format($measurement, 0,'','.') }}</td>
            </tr>
            {{-- End Perolehan Tanah --}}
            {{-- Perijinan --}}

            <tr>
                <td colspan="2">b. Perijinan</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Ijin Kedinasan</td>
                <td>:</td>
                <td>Rp. {{number_format($official_license, 0,'','.') }}</td>
            </tr>

            <tr>
                <td colspan="2" style="padding-left: 20px">- Ijin BPN</td>
                <td>:</td>
                <td>Rp. {{number_format($bpn_license, 0,'','.') }}</td>
            </tr>

            {{-- End Perijinan --}}

            {{-- Pengolahan Lahan --}}
            <tr>
                <td colspan="2">c. Pengolahan Lahan</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Pengurugan</td>
                <td>:</td>
                <td>Rp. {{number_format($dropping, 0,'','.') }}</td>
            </tr>
            {{-- End Pengolahan Lahan --}}

            {{-- Prasarana --}}
            <tr>
                <td colspan="2">d. Prasarana</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Jalan</td>
                <td>:</td>
                <td>Rp. {{number_format($road, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Saluran</td>
                <td>:</td>
                <td>Rp. {{number_format($channel, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Fasum</td>
                <td>:</td>
                <td>Rp. {{number_format($fasum, 0,'','.') }}</td>
            </tr>
            {{-- End Prasarana --}}

            {{-- Legalitas Rumah --}}
            <tr>
                <td colspan="2">e. Legalitas Rumah</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Split</td>
                <td>:</td>
                <td>Rp. {{number_format($split, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- IMB Tiap Unit</td>
                <td>:</td>
                <td>Rp. {{number_format($imb, 0,'','.') }}</td>
            </tr>
            {{-- End Legalitas Rumah --}}
            
            {{-- Sarana Rumah --}}
            <tr>
                <td colspan="2">f. Sarana Rumah</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Listrik KWH</td>
                <td>:</td>
                <td>Rp. {{number_format($listrik_kwh, 0,'','.') }}</td>
            </tr>
            {{-- End Sarana Rumah --}}
            
            {{-- End HPP --}}

            {{-- BEBAN USAHA --}}
            <tr>
                <td colspan="4" style="font-size: 20px; padding-top: 20px"><b>Beban Usaha</b></td>
            </tr>
            <tr>
                <td colspan="2">a. Pemasaran</td>
                <td>:</td>
                <td>Rp. {{number_format($marketing,0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2">b. Karyawan</td>
                <td>:</td>
                <td>Rp. {{number_format($employee,0,'','.') }}</td>
            </tr>

            <tr>
                <td colspan="2">c. Operational</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Peralatan Kantor</td>
                <td>:</td>
                <td>Rp. {{number_format($office_tools, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Perlengkapan Kantor</td>
                <td>:</td>
                <td>Rp. {{number_format($office_supplies, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 20px">- Operasional Kantor</td>
                <td>:</td>
                <td>Rp. {{number_format($office_operational, 0,'','.') }}</td>
            </tr>
            {{-- END BEBAN USAHA --}}

            {{-- PENDAPATAN LAIN-LAIN --}}
            <tr>
                <td colspan="4" style="font-size: 20px; padding-top: 20px"><b>Pendapatan Lain-lain</b></td>
            </tr>
            <tr>
                <td colspan="2">a. Bunga Bank</td>
                <td>:</td>
                <td>Rp. {{number_format($bank_interest, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2">b. Hutang</td>
                <td>:</td>
                <td>Rp. {{number_format($debt, 0,'','.') }}</td>
            </tr>
            {{-- END PENDAPATAN LAIN-LAIN --}}

            {{-- BEBAN LAIN-LAIN --}}
            <tr>
                <td colspan="4" style="font-size: 20px; padding-top: 20px"><b>Beban Lain-lain</b></td>
            </tr>
            <tr>
                <td colspan="2">a. Bunga Pinjaman</td>
                <td>:</td>
                <td>Rp. {{number_format($loan_interest, 0,'','.') }}</td>
            </tr>
            <tr>
                <td colspan="2">b. Bayar Hutang</td>
                <td>:</td>
                <td>Rp. {{number_format($pay_debt, 0,'','.') }}</td>
            </tr>
            {{-- END BEBAN LAIN-LAIN --}}
        </table>
    </div>
</div>

{{-- <div class="card">
    <div class="card-body">
        <h4>1. PENJUALAN</h4>
        <ol type="a" style="font-weight: bold">
            <li><b>Perumahan</b></li>
        </ol>
        <h4>2. HPP</h4>
        <div class="ml-4 mb-2">
            <table width="70%">
                <tr>
                    <td colspan="2">a. Perolehan Tanah</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Harga Tanah</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- BPHTB</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Pengukuran</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">b. Perijinan</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Ijin Kedinasan</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Ijin BPN</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">c. Pengolahan Lahan</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Pengurugan</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">d. Prasarana</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Jalan</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Saluran</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Fasum</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">e. Legalitas Rumah</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Split</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- IMB Tiap Unit</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">f. Legalitas Penjualan Rumah</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Akta Jual Beli</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- BPHTB</td>
                    <td>:</td>
                    <td>Rp. 2000000</td>
                </tr>
            </table>
        </div>
        <h4>3. BEBAN USAHA</h4>
        <div class="ml-4 mb-2">
            <table width="70%">
                <tr>
                    <td style="padding-right: 89px">a. Pemasaran</td>
                    <td style="padding-left: 8px">:</td>
                    <td >Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-right: 89px">b. Karyawan</td>
                    <td style="padding-left: 8px">:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td colspan="2">c. Operasional</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- Akta Jual Beli</td>
                    <td style="padding-left: 8px">:</td>
                    <td>Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px">- BPHTB</td>
                    <td style="padding-left: 8px">:</td>
                    <td>Rp. 2000000</td>
                </tr>
            </table>
        </div>
        <h4>4. BEBAN USAHA</h4>

        <div class="ml-4 mb-2">
            <table width="70%">
                <tr>
                    <td style="padding-right: 89px">a. Bunga Bank</td>
                    <td style="padding-left: 8px">:</td>
                    <td >Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-right: 89px">b. Hutang</td>
                    <td style="padding-left: 8px">:</td>
                    <td>Rp. 2000000</td>
                </tr>
            </table>
        </div>
        <h4>5. BEBAN USAHA</h4>

        <div class="ml-4 mb-2">
            <table width="70%">
                <tr>
                    <td style="padding-right: 80px">a. Bunga Pinjaman</td>
                    <td style="padding-left: 8px">:</td>
                    <td >Rp. 2000000</td>
                </tr>
                <tr>
                    <td style="padding-right: 89px">b. Bayar Hutang</td>
                    <td style="padding-left: 8px">:</td>
                    <td>Rp. 2000000</td>
                </tr>
            </table>
        </div>
        
        
        <h4>6. LABA RUGI</h4>
    </div>
</div> --}}
@endsection
