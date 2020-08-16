@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pemasukan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Laporan</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pemasukan</a></li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{route('spending')}}" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="date_start" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="date_end" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""></label>
                            <button type="submit" class="btn btn-success btn-sm form-control">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
            <table id="income-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($spendings as $spending)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $spending->name }}</td>
                            <td>{{ date('d M Y', strtotime($spending->date)) }}</td>
                            <td>Rp. {{ number_format($spending->price,0,'','.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        
                        <td  style="text-align: left"><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td><b>Rp. {{ number_format($total_spending,0,'','.') }}</b></td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <table border width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($incomes as $income)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $income->name }}</td>
                <td>{{ date('d M Y', strtotime($income->date,)) }}</td>
                <td>Rp. {{ number_format($income->price,2,',','.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center"><b>Total</b></td>
            <td><b>Rp. {{ number_format($total_income,2,',','.') }}</b></td>
            
            
        </tr>
    </tbody>
</table> --}}
<script>
    $('#income-table').DataTable({});
</script>
@endsection
