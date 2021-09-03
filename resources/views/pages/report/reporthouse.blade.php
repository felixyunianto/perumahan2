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
        <form action="{{ route('report.house') }}" method="get">
            <div class="row">
                <div class="col-md-8">
                    <select name="block_id" id="block_id" class="form-control">
                        <option value="">-- Pilih Perumahan --</option>
                        @foreach ($blocks as $block)
                        <option value="{{ $block->id }}" @if($selected == $block->id)  selected @endif >{{ $block->name_block }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                    <a href="" target="_blank" id="exportPDF" class="btn btn-primary ml-2"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>
                
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('report.house') }}" method="get">
            <div class="row">
                <div class="col-md-8">
                    <select name="house_id" id="house_id" class="form-control">
                        <option value="">-- Pilih Blok --</option>
                        @foreach ($houses as $house)
                        <option value="{{ $house->id }}" @if($selected == $house->id)  selected @endif >{{ $house->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                    <a href="" target="_blank" id="exportPDFById" class="btn btn-primary ml-2"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>
                
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <table width="30%" border="1pt" style="text-align: center">
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
    </div>
</div>
<script>
    $('#report-table').DataTable({})
</script>
@endsection
@section('script')
    <script>
        let blockID = $('#block_id').val();
        // $('#exportPDF').attr('href','/pdf-house/')
        $('#block_id').change(function(){
            $('#exportPDF').attr('href','/pdf-house/'+ this.value);
        })
        
        $('#house_id').change(function(){
            $('#exportPDFById').attr('href', '/pdf-house-by-id/'+ this.value);
        })

        $('#exportPDF').attr('href','/pdf-house/'+ $('#block_id').val());
    </script>
@endsection
