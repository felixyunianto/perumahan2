@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Tambah Customer</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Project</a></li>
        <li class="breadcrumb-item"><a href="#!">Customer</a></li>
        <li class="breadcrumb-item"><a href="#!">Ubah Customer</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Ubah Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('customer.update', $customers->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="">Nama Pelanggan</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $customers->name }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">NIK Pelanggan</label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ $customers->NIK }}">
                @error('nik')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat Pelanggan</label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ $customers->address }}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email Pelanggan</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customers->email }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">No Handphone Pelanggan</label>
                <input type="text" class="form-control  @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $customers->no_hp }}">
                @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Pekerjaan Pelanggan</label>
                <input type="text" class="form-control @error('job_status') is-invalid @enderror" name="job_status" value="{{ $customers->job_status }}">
                @error('job_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
            </div>
        </form>
    </div>
</div>
@endsection