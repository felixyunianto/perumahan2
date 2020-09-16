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
    <div class="card-body">
        <div>
            <form action="{{ route('rumah.index') }}" method="get">
                <div class="input-group">
                    <select class="custom-select flex-grow-1" name="block_id">
                        @foreach ($blocks as $block)
                            <option value="{{$block->id}}"@if($selected == $block->id) selected @endif>{{ $block->name_block }}</option>
                        @endforeach
                    </select>
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                        <a href="{{ route('rumah.create') }}" class="btn btn-success ml-2">Tambah</a>
                    </span>
                </div>
            </form>
            
        </div><br><br>
        <hr>
        <div class="table-responsive text-center">
            <table id="house-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Perumahan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Harga</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($houses as $house)
                    <tr>
                        <td>{{ $house->block->name_block }}</td>
                        <td>{{ $house->name }}</td>
                        <td>{{ $house->address }}</td>
                        <td>Rp. {{ number_format($house->price , 2, ',','.' ) }}</td>
                        <td>
                            <form class="" action="{{ route('rumah.destroy', $house->id) }}" method="post"
                                id="data-{{$house->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                            <a href="{{ route('rumah.edit', $house->id) }}" class="btn btn-warning btn-sm btn-round"><i
                                    class="feather icon-edit"></i>Edit</a>
                            <button class="btn btn-danger btn-sm btn-round" onclick="deleteRow({{$house->id}})"><i
                                    class="feather icon-trash"></i>Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#house-table').DataTable({})

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
