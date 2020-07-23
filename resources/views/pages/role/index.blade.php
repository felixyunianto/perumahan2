@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Role User</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Role User</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Role Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('role.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Role</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Isikan role baru">
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
                <h5>Tabel Role User</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="role-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ ucfirst(trans($role->name)) }}</td>
                                <td>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="post" id="data-{{$role->id}}" >
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="feather icon-edit"></i>Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRow({{$role->id}})"><i class="feather icon-trash"></i>Hapus</button>
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
    $('#role-table').DataTable({})

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