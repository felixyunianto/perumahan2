@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Blok Rumah</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Blok Rumah</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Edt Blok</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('money-setting.update', $moneySetting->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="">Nama Harga</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $moneySetting->name }}">
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="text" name="price" class="form-control price-input" id="price" value="{{$price }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".price-input").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
    });

</script>

<script src="{{ asset('public/assets/js/money.js') }}"></script>
@endsection
