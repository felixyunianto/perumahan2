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
    <div class="card-header">
        <h5>Laporan Akunting</h5>
    </div>
    <div class="card-body">
        <div class="row justify-content-center text-center">
            <div class="col-md-4 col-xs-12 border-right">
                <h3>Rp. {{ number_format($income,0,'','.') }}</h3>
                <span class="text-success">Total Pemasukan</span>
            </div>
            <div class="col-md-4 col-xs-12 border-right">
                <h3>Rp. {{ number_format($out,0,'','.') }}</h3>
                <span class="text-danger">Total Pengeluaran</span>
            </div>
            <div class="col-md-4 col-xs-12 border-right">
                <h3>Rp. {{ number_format($total,0,'','.') }}</h3>
                <span class="text-info">Total</span>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Tabel Pemasukan dan Pengeluaran</h5>
    </div>
    <div class="card-body">
        <div class="float-right">
            <a href="{{ route('akunting.create') }}" class="btn btn-success btn-sm">Tambah</a>
        </div><br><br>
        <div class="table-responsive text-center">
            <table id="akunting-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Sub Sub Kategori</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accountings as $accounting)
                    <tr>
                        <td>{{ $accounting->name }}</td>
                        <td>Rp. {{ number_format($accounting->price,2,',','.') }}</td>
                        <td>{{ $accounting->date }}</td>
                        <td>
                            @if($accounting->status == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="green" d="M16 11h5l-9 10-9-10h5v-11h8v11zm1 11h-10v2h10v-2z" /></svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="red" d="M8 10h-5l9-10 9 10h-5v10h-8v-10zm8 12h-8v2h8v-2z" /></svg>
                            @endif
                        </td>
                        <td>{{ $accounting->ct->name }}</td>
                        <td>{{ $accounting->subCategory->name }}</td>
                        <td>{{ $accounting->subSubCategory->name }}</td>
                        <td>
                            <form action="{{route('akunting.destroy', $accounting->id)}}" method="post"
                                class="sa-remove" id="data-{{$accounting->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                            <a href="{{ route('akunting.edit', $accounting->id) }}" class="btn btn-warning btn-sm btn-round"> <i
                                    class="feather icon-edit"></i>Ubah</a>
                            <button onclick="deleteRow({{$accounting->id}})" class="btn btn-danger btn-sm btn-round"><i
                                    class="feather icon-trash"></i>&nbsp;Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#akunting-table').DataTable();

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
