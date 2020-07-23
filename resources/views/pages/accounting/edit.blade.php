@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Akuntan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Akuntan</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('akunting.update', $akunting->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $akunting->name }}">
            </div>
            <div class="form-group">
                <label for="">Jumlah Uang</label>
                <input type="text" class="form-control money-input" name="price"  value="{{ $price }}">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="1" {{ 1 == $akunting->status ? 'selected' : '' }}>Masuk</option>
                    <option value="0" {{ 0 == $akunting->status ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="description" id="" rows="10" class="form-control">{{ $akunting->description }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".money-input").maskMoney({ thousands:'.', decimal:',', affixesStay: false, precision: 0});
    });
</script>
<script src="{{ asset('assets/js/money.js') }}"></script>

@endsection