@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">User</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">User</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-header">
        <h5>Tabel User</h5>
    </div>
    <div class="card-body">
        <div class="row align-items-center m-l-0">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('user.create')}}" class="btn btn-success btn-sm mb-3">Tambah User</a>
            </div>
        </div>
        <div class="table-responsive text-center">
            <table id="user-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role User</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->role_name }}</td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post" id="data-{{$user->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-round"><i class="feather icon-edit"></i> Edit</a>
                            <button class="btn btn-danger btn-round" onclick="deleteRow({{$user->id}})"><i class="feather icon-trash"></i>Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#user-table').DataTable({})
</script>
<script>
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