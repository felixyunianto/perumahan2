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
            <input type="hidden" id="sub_cat" value="{{ $akunting->sub_category_id }}"/>
            <input type="hidden" id="sub_sub_cat" value="{{ $akunting->sub_sub_category_id }}"/>
            
            <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="1" {{ 1 == $akunting->status ? 'selected' : '' }}>Masuk</option>
                    <option value="0" {{ 0 == $akunting->status ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kategori <span style="color:red">*</span> </label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled selected>-- Pilih --</option>
                    @foreach ($category_transaction as $ct)
                        <option value="{{ $ct->id }}" {{ $ct->id == $akunting->category_id ? 'selected' : '' }}>{{ ucfirst($ct->name) }}</option>
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
                <label for="">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $akunting->name }}">
            </div>
            <div class="form-group">
                <label for="">Jumlah Uang</label>
                <input type="text" class="form-control money-input" name="price"  value="{{ $price }}">
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
    const chooseCategory = document.querySelector('#category_id');
    const currentSelectedSubCategory = document.querySelector('#sub_cat');
    const currentSelectedSubSubCategory = document.querySelector('#sub_sub_cat');
    const url = 'http://localhost:8000/api/';
    const showSub = document.querySelector('#show-sub');
    const showSubSub = document.querySelector('#show-sub-sub');

    $(document).ready(function(){
        $(".money-input").maskMoney({ thousands:'.', decimal:',', affixesStay: false, precision: 0});     

    });

    document.addEventListener( 'DOMContentLoaded',  async function () {
        const firstOptions = await search(chooseCategory.value);
        clearTheOptions();
        fillTheOptions(firstOptions);

        const firstOptionsSub = await searchSub(showSub.value);
        fillTheOptionsSub(firstOptionsSub);

    });

    chooseCategory.addEventListener('change', async function() {
        const subCategory = await search(chooseCategory.value);
        clearTheOptions();
        fillTheOptions(subCategory);
    })

    showSub.addEventListener('change', async function(){
        const subSubCategory = await searchSub(showSub.value);
        
        for(i = showSubSub.options.length-1; i >= 0; i--){
            showSubSub.options[i] = null
        }

        fillTheOptionsSub(subSubCategory);
    })

    const clearTheOptions = () => {
        for(i = showSub.options.length-1; i >= 0; i--){
            showSub.options[i] = null
        }
    }

    const fillTheOptions = (subCategory) => {
        subCategory.forEach((b) => {
            option = document.createElement("OPTION");
            const name = document.createTextNode(b.name);
            option.value = b.id;
            option.selected = currentSelectedSubCategory.value == b.id ? true: false;
            option.appendChild(name);
            showSub.append(option)
        })
    }

    const fillTheOptionsSub = (subSubCategory) =>{
        subSubCategory.forEach((b) => {
            option = document.createElement('option');
            const name = document.createTextNode(b.name)
            option.value = b.id
            option.selected = currentSelectedSubSubCategory.value == b.id ? true : false
            option.appendChild(name);
            showSubSub.append(option)
        })
    }

    function search(keyword){
        return fetch(url + 'json-sub-kategori/' + keyword).then(res => res.json()).then(res => res.results)
    }
    function searchSub(keyword){
        return fetch(url + 'json-sub-sub-kategori/' + keyword).then(res => res.json()).then(res => res.results)
    }

</script>
<script src="{{ asset('assets/js/money.js') }}"></script>

@endsection