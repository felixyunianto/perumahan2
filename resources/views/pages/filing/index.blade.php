@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pemberkasan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pemberkasan</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Tabel User</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive text-center">
            <table id="filing-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$customer->name}}</td>
                            <td>
                                @foreach($customer->detail_house as $cd)
                                    {{ $cd->house->status_process }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('filling', $customer->id) }}" class="btn btn-primary">Pemberkasan</a>
                                <a href="{{ route('pemberkasan.show', $customer->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#filing-table').DataTable({});
</script>
@endsection