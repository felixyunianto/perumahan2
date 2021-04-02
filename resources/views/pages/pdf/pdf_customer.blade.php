<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Customer</title>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}
    <style>
        @page {
            size: A4;
            font-size: 10pt,
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
        <p style="text-align: right"></h3>
        <table width="100%" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Alamat</th>
                    <th>No Handphone</th>
                    <th>Marketing</th>
                    <th>Perumahan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($customers as $customer)
                <tr>
                    <td style="text-align: center;">{{ $no++ }}</td>
                    <td style="text-align: center;">{{ $customer->name }}</td>
                    <td style="text-align: center;">{{ $customer->address }}</td>
                    <td style="text-align: center;">{{ $customer->no_hp }}</td>
                    <td style="text-align: center;">{{ $customer->user->name }}</td>
                    <td style="text-align: center;">
                        @foreach ($customer->detail_house as $dh)
                            {{ $dh->house->block->name_block }}
                        @endforeach    
                    </td>
                </tr>
                    
                @endforeach
            </tbody>
        </table>
    {{-- </section> --}}

</body>

</html>
