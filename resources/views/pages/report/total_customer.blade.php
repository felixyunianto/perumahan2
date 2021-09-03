@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Total Pemasukan Customer</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Total Pemasukan Customer</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('report.total-customer') }}" method="get">
            <div class="row">
                <div class="col-sm-8">
                    <select name="block_id" id="block_id" class="form-control">
                        <option value="">-- Pilih Perumahan --</option>
                        @foreach ($blocks as $block)
                        <option value="{{ $block->id }}" @if($selected==$block->id) selected @endif
                            >{{ $block->name_block }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-6"><button type="submit"
                                class="btn btn-secondary form-control ">Filter</button></div>
                        <div class="col-sm-6"><a href="{{route('report.total-customer')}}"
                                class="btn btn-primary form-control">Refresh</a></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="customer-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>
                            {{-- @foreach ($customer->akunting as $cusakun) --}}
                            Rp.
                            {{ number_format($customer->akunting->where('status', 1)->sum('price') - $customer->akunting->where('status', 0)->sum('price'),0,"",".") }}
                            {{-- @endforeach --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('#customer-table').DataTable({})
    </script>
@endsection