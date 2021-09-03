<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Tanggal {{ date('d F Y', strtotime($date[0])) }} - {{ date('d F Y', strtotime($date[1])) }}</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}
    <style>
        @page {
            size: A4
        }

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
    {{-- <section class="padding-10mm"> --}}
        <h1>PERUMAHAN OASE PEMALANG</h1>
        <p style="text-align: right">Laporan Tanggal {{ date('d F Y', strtotime($date[0])) }} - {{ date('d F Y', strtotime($date[1])) }}</h3>
        <table width="100%" class="table">
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
                    <td style="text-align: center">{{ $no++ }}</td>
                    <td style="text-align: center">{{ $income->name }}</td>
                    <td style="text-align: center">{{ date('d F Y', strtotime($income->date)) }}</td>
                    <td style="text-align: right;">Rp. {{ number_format($income->price,0,'','.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: center"><b>TOTAL</b></td>
                    <td style="text-align: right">Rp. {{ number_format($total,0,'','.') }}</td>
                </tr>
            </tbody>
        </table>
    {{-- </section> --}}

</body>

</html>
