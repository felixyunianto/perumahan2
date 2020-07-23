@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Tambah Customer</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Project</a></li>
        <li class="breadcrumb-item"><a href="#!">Customer</a></li>
        <li class="breadcrumb-item"><a href="#!">Tambah Customer</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Tambah Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('customer.store') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <label for="">Nama Pelanggan <span style="color:red">*</span> </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">NIK Pelanggan <span style="color:red">*</span> </label>
                <input type="number" class="form-control  @error('nik') is-invalid @enderror" name="nik"  value="{{old('nik')}}" min="1">
                @error('nik')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat Pelanggan <span style="color:red">*</span> </label>
                <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email Pelanggan <span style="color:red">*</span> </label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"  value="{{old('email')}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">No Handphone Pelanggan <span style="color:red">*</span> </label>
                <input type="text" class="form-control  @error('no_hp') is-invalid @enderror" name="no_hp" value="{{old('no_hp')}}">
                @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Pekerjaan Pelanggan <span style="color:red">*</span> </label>
                <input type="text" class="form-control  @error('job_status') is-invalid @enderror" name="job_status" value="{{old('job_status')}}">
                @error('job_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary float-right">
            </div>
        </form>
    </div>
</div>
@endsection
