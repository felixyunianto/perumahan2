@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pelanggan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pelanggan</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Laporan Pelanggan</h5>
            </div>
            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-md-2 col-xs-6 border-right">
                        <h3>{{ $customers->count('id') }}</h3>
                        <span class="">Total Pelanggan</span>
                    </div>
                    <div class="col-md-2 col-xs-6 border-right">
                        @if ($confirmed)
                        <h3>{{ $confirmed }}</h3>
                        @else
                        <h3>0</h3>
                        @endif
                        <span class="text-success">Sudah Isi Pemberkasan</span>
                    </div>
                    <div class="col-md-2 col-xs-6 border-right">
                        @if ($not_yet_confirmed)
                        <h3>{{ $not_yet_confirmed }}</h3>
                        @else
                        <h3>0</h3>
                        @endif
                        <span class="text-danger">Belum Pemberkasan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center m-l-0">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{route('customer.create')}}" class="btn btn-success btn-sm mb-3">Tambah Pelanggan</a>
                    </div>
                </div>
                <div class="table-responsive text-center">
                    <table id="report-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Handphone</th>
                                <th>Marketing</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->no_hp }}</td>
                                <td>{{ $customer->user->name }}</td>
                                <td>
                                    <form action="{{route('customer.destroy', $customer->id)}}" method="post"
                                        class="sa-remove" id="data-{{$customer->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    @if($customer->utj_status !== NULL)
                                    <a href="" class="btn btn-success btn-sm  btn-round">Sudah UTJ</a>
                                    @else
                                    <button type="button" class="btn btn-danger btn-sm id_customer btn-round" data-toggle="modal"
                                        data-target="#modals-utj" data-id="{{ $customer->id }}" id="id_customer" >Belum UTJ</button>

                                    @endif
                                    @if($customer->utj_status !== 0)
                                    <a href="{{ route('choose_house', $customer->id) }}"
                                        class="btn btn-sm btn-info btn-round">Pilih Rumah</a>
                                    @else
                                    <a href="javascript: void(0)"
                                        class="btn btn-sm btn-info btn-round" onclick="return chooseHouse()">Pilih Rumah</a>
                                    @endif
                                    @if ($customer->akad_status == 0)
                                    <button class="btn btn-primary btn-sm btn-round fail_customer" data-toggle="modal"
                                    data-target="#modals-fail" data-id="{{ $customer->id }}" id="fail_customer">Gagal</button>    
                                    @endif
                                    
                                    <a href="{{ route('customer.edit', $customer->id) }}"
                                        class="btn btn-warning btn-sm btn-round"> <i class="feather icon-edit"></i>Ubah</a>
                                    <button onclick="deleteRow({{$customer->id}})" class="btn btn-danger btn-sm btn-round"><i
                                            class="feather icon-trash"></i>&nbsp;Hapus</button>
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
<div class="modal fade" id="modals-utj">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.pay') }}">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran
                    <span class="font-weight-light">Uang Tanda Jadi</span>
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" id="id_customer_input" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <label class="form-label">Total UTJ</label>
                        <input type="text" class="form-control input-utj" name="total-utj">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modals-fail">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.fail') }}">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title">Nomimal
                    <span class="font-weight-light">yang dikembalikan</span>
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" id="id_customer_fail" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <label class="form-label">Total refund</label>
                        <input type="text" class="form-control input-fail" name="total-fail">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#report-table').DataTable({});
    
    $(document).ready(function () {
        $(".input-utj").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
    });
    $(document).ready(function () {
        $(".input-fail").maskMoney({
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 0
        });
    });

</script>
<script src="{{ asset('assets/js/money.js') }}"></script>
<script>
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

    function chooseHouse() {
        swal({
            title: "Pemberitahuan",
            text: "Mohon maaf anda belum membayar UTJ",
            icon: "warning",
        })
    }

    
    $(document).on("click",".id_customer", function(){
        var idCustomer = $(this).data('id');
        $('#id_customer_input').val(idCustomer);

    })

    $(document).on("click",".fail_customer", function(){
        var idCustomer = $(this).data('id');
        console.log(idCustomer);
        $('#id_customer_fail').val(idCustomer);

    })
    
</script>
@endsection
