@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Pemberkasan</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Pemberkasan</a></li>
    </ol>
</div>
<div class="card">
    <div class="card-header">
        <h5>Tabel User</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive text-center">
            <table id="filing-table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$customer->name}}</td>
                            <td>
                                @foreach($customer->detail_house as $cd)
                                    {{ $cd->house->status_process }}
                                @endforeach
                            </td>
                            <td>
                                @if ($customer->dp_status !== NULL)
                                <a href="" class="btn btn-success btn-sm btn-round">Sudah DP</a>
                                @else
                                <button type="button" class="btn btn-danger btn-sm id_customer btn-round" data-toggle="modal"
                                data-target="#modals-dp" data-id="{{ $customer->id }}" id="id_customer" >Pelunasan DP</button>
                                @endif
                                @if ($customer->file_status == 1)
                                <button type="button" class="btn btn-info btn-sm id_customer_bank btn-round" data-toggle="modal"
                                data-target="#modals-bank" data-id="{{ $customer->id }}" id="" >Pilih Bank</button>
                                @endif
                                @if ($customer->sp3_status !== NULL)
                                    @if ($customer->lpa_status == NULL)
                                        <button type="button" class="btn btn-info btn-sm id_customer_lpa btn-round" data-toggle="modal"
                                        data-target="#modals-lpa" data-id="{{ $customer->id }}" id="" >Bayar LPA</button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm btn-round" id="" >Sudah LPA</button>
                                    @endif    
                                @else
                                <button type="button" class="btn btn-info btn-sm btn-round" onclick="return payLPA()" >Bayar LPA</button>
                                @endif
                                
                                @if ($customer->dp_status !== NULL)
                                <a href="{{ route('filling', $customer->id) }}" class="btn btn-warning btn-sm btn-round">Pemberkasan</a>
                                @else
                                <a href="javascript: void(0)"
                                        class="btn btn-sm btn-primary btn-round" onclick="return filingCustomer()">Pemberkasan</a>
                                @endif
                                
                                <a href="{{ route('pemberkasan.show', $customer->id) }}" class="btn btn-primary btn-sm btn-round">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modals-bank">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.chooseBank') }}">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title">Isikan Bank yang dituju
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="id_customer_bank" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <label class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" name="bank">
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
<div class="modal fade" id="modals-dp">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.payDP') }}">
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
                        <input type="hidden" class="form-control" id="id_customer_input" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <label class="form-label">Total Uang Muka</label>
                        <input type="text" class="form-control input-dp" name="total_dp">
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
<div class="modal fade" id="modals-lpa">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.payLPA') }}">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran
                    <span class="font-weight-light">LPA</span>
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <input type="hidden" class="form-control" id="id_customer_lpa" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <label class="form-label">Total Uang LPA</label>
                        <input type="text" class="form-control input-lpa" name="total_lpa">
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
<script src="{{ asset('assets/js/money.js') }}"></script>

<script>
    $('#filing-table').DataTable({});

    

    

    
</script>
@endsection