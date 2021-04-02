@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Kategori Transaksi</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Kategori Transaksi</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-header">
        <h5>Edit Kategori</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori-transaksi.update', $category_transaction->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="">Nama Kategori</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ ucfirst(trans($category_transaction->name)) }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('kategori-transaksi.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection