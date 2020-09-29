<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Tanggal Rumah</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}
    <style>
        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table.table {
            border-collapse: collapse;
            width: 100%;
        }

        table.table-status {
            border-collapse: collapse;
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

        .table-status td {
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }


    </style>
</head>

<body>
    {{-- <section class="sheet padding-10mm"> --}}
    <h1>PERUMAHAN OASE PEMALANG {{ strtoupper($block->name_block) }}</h1>
    <h3 style="text-align: right">Laporan Rumah</h3>
    <table width="100%" class="table">
        <thead style="text-align: center">
            <tr>
                <th>Blok</th>
                <th>Nama</th>
                <th>UTJ</th>
                <th>Berkas Masuk</th>
                <th>SP3</th>
                <th>Pekerjaan</th>
                <th>Keterangan</th>
                <th>Bank</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @forelse ($reports as $report)
            <tr>
                <td>{{ $report->name }}</td>
                @if ($report->detail_house->isEmpty())
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$report->status_process}}</td>
                <td></td>
                @else
                @foreach ($report->detail_house as $rdh)
                <td>{{ $rdh->customer->name }}</td>
                <td>{{ $rdh->customer->utj_status}}</td>
                <td>{{ $rdh->customer->filing->updated_at }}</td>
                <td>{{ $rdh->customer->sp3_status }}</td>
                <td>{{ $rdh->customer->job_status }}</td>
                @endforeach
                <td>{{ $report->status_process }}</td>

                @if ($rdh->customer->bank == NULL)
                <td>Belum ada</td>
                @else
                <td>{{ $rdh->customer->bank }}</td>
                @endif
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="8">Tidak ada Data</td>
            </tr>
            @endforelse
        </tbody>

    </table>

    <br>

    <table width="30%" class="table-status" style="text-align: center;">
        <tr>
            <td width="40%">Total SP3</td>
            <td>{{ $sp3->count('id') }}</td>
        </tr>
        <tr>
            <td>Total Akad</td>
            <td>{{ $akad->count('id') }}</td>
        </tr>
        <tr>
            <td>Proses</td>
            <td>{{ $proses->count('id') }}</td>
        </tr>
        <tr>
            <td>Cash</td>
            <td>{{ $cash->count('id') }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ $total->count('id') }}</td>
        </tr>
        <tr>
            <td>Kosong</td>
            <td>{{ $kosong->count('id') }}</td>
        </tr>
    </table>
</body>

</html>
