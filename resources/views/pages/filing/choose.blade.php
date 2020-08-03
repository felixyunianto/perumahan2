@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pemberkasan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pilih Rumah</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('store_house') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Pilih Rumah</label>
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <select name="house_id" id="" class="form-control">
                    <option value="" selected>-- Pilih Rumah --</option>
                    @foreach ($houses as $house)
                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Proses</label>
                <div class="row">
                    <div class="col-md-4">
                    <select name="status_process" id="" class="form-control">
                    <option value="Cash">Cash</option>
                    <option value="Process">Process</option>
                </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('customer.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Daftar Rumah
    </div>
    <div class="card-body">
        <div class="table-responsive text-center">
            <table id="filing-table" class="table table-striped table-hover">
                @foreach ($detail_house as $dp)
                <tr>
                    <td>Rumah</td>
                    <td>{{ $dp->house->block->name_block.' Blok '.$dp->house->name }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
