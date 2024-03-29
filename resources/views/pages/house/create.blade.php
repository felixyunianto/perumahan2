@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Rumah</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Rumah</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Tambah Rumah Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('rumah.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Blok <span style="color:red">*</span> </label>
                <select class="form-control form-control-sm  @error('block_id') is-invalid @enderror" name="block_id">
                    <option value="">Pilih</option>
                    @foreach ($blocks as $block)
                    <option value="{{$block->id}}" {{ old('block_id') == "$block->id" ? 'selected' : '' }}>
                        {{$block->name_block}}</option>
                    @endforeach
                </select>
                @error('block_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama <span style="color:red">*</span> </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Alamat <span style="color:red">*</span> </label>
                <textarea name="address" rows="8" id="address"
                    class="form-control @error('address') is-invalid @enderror"> {{ old('address') }}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga <span style="color:red">*</span> </label>
                <input type="text" name="price" class="form-control price-input  @error('price') is-invalid @enderror"
                    value="{{ old('price') }}" id="price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
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
