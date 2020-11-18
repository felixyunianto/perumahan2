<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Tanggal</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}
    <style>
        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }
        
        
    </style>
</head>

<body>
    {{-- <section class="sheet padding-10mm"> --}}
        <h1>PERUMAHAN OASE PEMALANG</h1>
        {{-- <p style="text-align: right">Laporan Tanggal {{ date('d F Y', strtotime($date[0])) }} - {{ date('d F Y', strtotime($date[1])) }}</h3> --}}
        <table width="100%" class="table">
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
    {{-- </section> --}}

</body>

</html>
