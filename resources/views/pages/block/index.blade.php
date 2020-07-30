@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Perumahan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Perumahan</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Perumahan Baru</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Perumahan</label>
                        <input type="text" name="block_name" class="form-control @error('block_name') is-invalid @enderror" id="block_name" placeholder="Masukan Nama Perumahan">
                        @error('block_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-round ">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Tabel Perumahan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="block-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perumahan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($blocks as $block)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $block->name_block }}</td>
                                <td>
                                    <form action="{{ route('blok.destroy', $block->id) }}" method="post"
                                        id="data-{{$block->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <a href="{{ route('blok.edit', $block->id) }}" class="btn btn-warning btn-sm"><i
                                            class="feather icon-edit"></i>Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRow({{$block->id}})"><i
                                            class="feather icon-trash"></i>Hapus</button>
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
    $('#block-table').DataTable({})

    function deleteRow(id) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus akan terhapus secara permanen!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#data-' + id).submit();
            }
        })
    }

</script>
@endsection
