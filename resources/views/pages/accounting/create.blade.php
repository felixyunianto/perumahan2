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
        <form action="{{ route('akunting.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Status <span style="color:red">*</span> </label>
                <select name="status" id="" class="form-control">
                    <option value="" disabled selected>-- Pilih --</option>
                    <option value="1">Masuk</option>
                    <option value="0">Keluar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kategori <span style="color:red">*</span> </label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled selected>-- Pilih --</option>
                    @foreach ($category_transaction as $ct)
                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Sub Kategori</label>
                <select name="sub_category_id" id="show-sub" class="form-control">
                    <option value="">--Pilih --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Sub Sub Kategori</label>
                <select name="sub_sub_category_id" id="show-sub-sub" class="form-control">
                    <option value="">--Pilih --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Uraian <span style="color:red">*</span> </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jumlah Uang <span style="color:red">*</span> </label>
                <input type="text" class="form-control money-input @error('price') is-invalid @enderror" name="price">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="description" id="" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>

    const url = 'http://localhost:8000/api/';
    const showSub = document.querySelector('#show-sub');
    const showSubSub = document.querySelector('#show-sub-sub');
    const chooseCategory = document.querySelector('#category_id');

    chooseCategory.addEventListener('change', async function() {
        const subCategory = await search(chooseCategory.value);
        // option = '';
        for(i = showSub.options.length-1; i >= 0; i--){
            showSub.options[i] = null
        }
        subCategory.forEach((b) => {
            
            option = document.createElement("OPTION");
            const name = document.createTextNode(b.name);
            option.value = b.id;
            option.appendChild(name);
            showSub.append(option)
        })

        
    })

    showSub.addEventListener('change', async function(){
        const subSubCategory = await searchSub(showSub.value);

        for(i = showSubSub.options.length-1; i >= 0; i--){
            showSubSub.options[i] = null;
        }

        subSubCategory.forEach((b) => {
            option = document.createElement('OPTION');
            const name = document.createTextNode(b.name)
            option.value = b.id;
            option.appendChild(name);
            showSubSub.append(option)
        })

        console.log(subSubCategory);
    })

    $(document).ready(function () {
        $(".money-input").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
    });

    function search(keyword){
        return fetch(url + 'json-sub-kategori/' + keyword).then(res => res.json()).then(res => res.results)
    }

    function searchSub(keyword){
        return fetch(url + 'json-sub-sub-kategori/' + keyword).then(res => res.json()).then(res => res.results)
    }

</script>
<script src="{{ asset('assets/js/money.js') }}"></script>

@endsection
