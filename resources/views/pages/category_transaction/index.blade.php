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

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Kategori Transaksi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori-transaksi.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Transaksi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Isikan nama kategori">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Tabel Kategori Transaksi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="kt-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Kategori</td>
                                <td>Opsi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($category_transaction as $ct)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $ct->name }}</td>
                                    <td>
                                        <form action="{{ route('kategori-transaksi.destroy', $ct->id) }}" method="post" id="data-{{$ct->id}}" >
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        <a href="{{ route('kategori-transaksi.edit', $ct->id) }}" class="btn btn-warning btn-sm"><i class="feather icon-edit"></i>Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteRow({{$ct->id}})"><i class="feather icon-trash"></i>Hapus</button>
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

    function deleteRow(id){
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