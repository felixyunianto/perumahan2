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
      <a href="{{ route('rumah.create') }}" class="btn btn-success btn-sm float-right">Tambah</a>
    </div><br><br>
    <hr>
    <div class="table-responsive text-center">
        <table id="house-table" class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Harga</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($houses as $house)
            <tr>
              <td>{{ $house->name }}</td>
              <td>{{ $house->address }}</td>
              <td>Rp. {{ number_format($house->price , 2, ',','.' ) }}</td>
              <td>
                <form class="" action="{{ route('rumah.destroy', $house->id) }}" method="post" id="data-{{$house->id}}">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                </form>
                <a href="{{ route('rumah.edit', $house->id) }}" class="btn btn-warning btn-sm"><i class="feather icon-edit"></i>Edit</a>
                <button class="btn btn-danger btn-sm" onclick="deleteRow({{$house->id}})"><i class="feather icon-trash"></i>Hapus</button>
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
