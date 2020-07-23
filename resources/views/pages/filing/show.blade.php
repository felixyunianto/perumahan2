@extends('layouts.app')
@section('content')
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pemberkasan</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>{{ $customers->name }}</h5>
    </div>
    <div class="card-body">
        <ul>
            <table class="table table-bordered">
                @foreach ($detail_house as $dp)
                    <tr>
                        <td>Rumah</td>
                        <td style="text-align:center">{{ $dp->house->name }}</td>
                    </tr>
                @endforeach
                @foreach ($filings as $filing)
                <tr>
                    <td>Pas Foto</td>
                    <td class="text-center">
                        @if($filing->photos !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>KTP</td>
                    <td class="text-center">
                        @if($filing->fc_id_card !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fotocopy Kartu Keluarga</td>
                    <td class="text-center">
                        @if($filing->fc_family_card !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fotocopy Surat Nikah</td>
                    <td class="text-center">
                        @if($filing->fc_marriage_certificate !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Optional</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fotocopy NPWP</td>
                    <td class="text-center">
                        @if($filing->fc_taxpayer_identification !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fotocopy Surat Kerja</td>
                    <td class="text-center">
                        @if($filing->tax_status !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Penghasilan 3 Bulan Terakhir</td>
                    <td class="text-center">
                        @if($filing->income !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Rekening Koran</td>
                    <td class="text-center">
                        @if($filing->current_account !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Tabungan BTN</td>
                    <td class="text-center">
                        @if($filing->saving !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>SK Tidak Mempunyai Rumah</td>
                    <td class="text-center">
                        @if($filing->ls_havent_house !== NULL)
                        <div class="badge badge-success">Sudah</div>
                        @else
                        <div class="badge badge-danger">Belum</div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </ul>
        <a href="{{ route('pemberkasan.index') }}" class="btn btn-primary btn-sm float-right">Kembali</a>
    </div>
</div>
@endsection
