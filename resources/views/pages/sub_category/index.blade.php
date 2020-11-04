@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Sub Kategori Transaksi</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Kategori Transaksi</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">  
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 d-flex align-items-center"><h5 class="">Tambah Sub Kategori Transaksi</h5></div>
                    <div class="col-md-2"><button class="btn btn-info" onclick="funRefresh()"><i class="feather icon-refresh-ccw"></i></button></div>
                </div> 
            </div>
            <div class="card-body">
                <form action="{{ route('sub-kategori-transaksi.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Transaksi</label>
                        <input type="hidden" id='sub_id' name="id">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Isikan nama kategori">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Kategory Transaksi</label>
                        <select name="category_id" id="category_id" class="form-control  @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-round">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Tabel Sub Kategori Transaksi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt-table" class="table table-hover">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Sub Kategori</td>
                                <td>Kategori</td>
                                <td>Opsi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            {{-- @foreach ($categories as $category)
                                <tr>
                                    <td colspan="3">{{ $category->name }}</td>
                                </tr>
                                @foreach ($category->subCategory as $cs)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $cs->name }}</td>
                                        <td>
                                            <form action="{{ route('sub-kategori-transaksi.destroy', $cs->id) }}" method="post" id="data-{{$cs->id}}" >
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                            <button href="" data-id="{{ $cs->id}}" data-name="{{ $cs->name }}" 
                                                data-category="{{ $cs->category_id}}"class="btn btn-warning btn-sm btn-round btn-edit"><i class="feather icon-edit"></i>Edit</button>
                                            <button class="btn btn-danger btn-sm btn-round" onclick="deleteRow({{$cs->id}})"><i class="feather icon-trash"></i>Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach --}}
                            @foreach ($sub_category_accountings as $sub_category_accounting)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $sub_category_accounting->name }}</td>
                                    <td>{{ $sub_category_accounting->category->name }}</td>
                                    <td>
                                        <form action="{{ route('sub-kategori-transaksi.destroy', $sub_category_accounting->id) }}" method="post" id="data-{{$sub_category_accounting->id}}" >
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        <button href="" data-id="{{ $sub_category_accounting->id}}" data-name="{{ $sub_category_accounting->name }}" 
                                            data-category="{{ $sub_category_accounting->category_id}}"class="btn btn-warning btn-sm btn-round btn-edit"><i class="feather icon-edit"></i>Edit</button>
                                        <button class="btn btn-danger btn-sm btn-round" onclick="deleteRow({{$sub_category_accounting->id}})"><i class="feather icon-trash"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#kt-table').DataTable({})

    btnEdit = document.querySelectorAll('.btn-edit');
    for(i = 0; i < btnEdit.length; i++){
        let id = btnEdit[i].getAttribute('data-id');
        let name = btnEdit[i].getAttribute('data-name');
        let category = btnEdit[i].getAttribute('data-category');
        btnEdit[i].addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#sub_id').value = id;
            document.querySelector('#name').value = name;
            document.querySelector('#category_id').value = category;

        })
    }

    funRefresh = () => {
        document.querySelector('#sub_id').value = null;
        document.querySelector('#name').value = null;
        document.querySelector('#category_id').value = '';
    }

    deleteRow = (id) => {
      swal({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus akan terhapus secara permanen!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if(willDelete){
          $('#data-' + id).submit();
        }
      })
    }
</script>
@endsection