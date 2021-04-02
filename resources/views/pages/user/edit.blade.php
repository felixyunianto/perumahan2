@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Edit User</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Edit User</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-header">
        <h5>Edit User</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('user.update', $users->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="">Nama User</label>
            <input type="hidden" value="{{$users->id}}" name="user_id">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$users->name}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$users->username}}">
            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$users->email}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Konfirmassi Password</label>
            <input type="password" class="form-control @error('c_password') is-invalid @enderror" name="c_password" value="{{old('c_password')}}">
            @error('c_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <select name="role_id" id="" class="form-control form-control-sm">
                <option value="">Pilih Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"{{ $role->id == $users->role_id ? 'selected':'' }} >{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Simpan" class="btn btn-primary">
        </div>
        </form>
    </div>
</div>
@endsection