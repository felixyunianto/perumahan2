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
                <h5>Tambah Harga Baru</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control @error('block_name') is-invalid @enderror" id="block_name" placeholder="Masukan Nama Harga">
                        @error('block_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="price" class="form-control @error('block_name') is-invalid @enderror price-input" id="block_name" placeholder="Masukan Total Harga">
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
                <h5>Tabel Harga</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="block-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($moneySettings as $moneySetting)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $moneySetting->name }}</td>
                                <td>Rp. {{ number_format($moneySetting->price,0,'','.') }}</td>
                                <td>
                                    <form action="{{ route('money-setting.destroy', $moneySetting->id) }}" method="post"
                                        id="data-{{$moneySetting->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <a href="{{ route('money-setting.edit',$moneySetting->id) }}" class="btn btn-warning btn-sm btn-round"><i
                                            class="feather icon-edit"></i>Edit</a>
                                    <button class="btn btn-danger btn-sm btn-round" onclick="deleteRow({{$moneySetting->id}})"><i
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

    $(document).ready(function () {
        $(".price-input").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
    });

</script>

<script src="{{ asset('assets/js/money.js') }}"></script>
@endsection
