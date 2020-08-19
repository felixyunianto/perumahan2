@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Laporan Perumahan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Laporan Perumahan</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ route('report.house') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <select name="block_id" id="" class="form-control">
                            @foreach ($blocks as $block)
                            <option value="{{ $block->id }}">{{ $block->name_block }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary form-control">Cari</button>
                    </div>
                </div>

            </form>
            <table id="report-table" class="table table-striped table-hover">
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
                    @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->name }}</td>
                        @if ($report->detail_house->isEmpty())
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                            <td></td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#report-table').DataTable({})

</script>
@endsection
