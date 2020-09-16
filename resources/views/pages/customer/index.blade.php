@extends('layouts.app')
@section('content')
<h4 class="font-weight-bold py-3 mb-0">Customer</h4>
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
        <li class="breadcrumb-item"><a href="#!">Projek</a></li>
        <li class="breadcrumb-item active"><a href="#!">Customer</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Laporan Customer</h5>
            </div>
            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-md-2 col-xs-6 border-right">
                        <h3>{{ $customers->count('id') }}</h3>
                        <span class="">Total Customer</span>
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

                    <div class="col-md-2 col-xs-6 border-right">
                        @if ($cash)
                        <h3>{{ $cash }}</h3>
                        @else
                        <h3>0</h3>
                        @endif
                        <span class="text-info">Cash</span>
                    </div>

                    <div class="col-md-2 col-xs-6 border-right">
                        @if ($process)
                        <h3>{{ $process }}</h3>
                        @else
                        <h3>0</h3>
                        @endif
                        <span class="text-info">Proses</span>
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
                        <a href="{{route('customer.create')}}" class="btn btn-success btn-sm mb-3">Tambah Customer</a>
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
                                <th>Perumahan</th>
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
                                    @foreach ($customer->detail_house as $dh)
                                        {{ $dh->house->block->name_block }}
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{route('customer.destroy', $customer->id)}}" method="post"
                                        class="sa-remove" id="data-{{$customer->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    @if($customer->utj_status !== NULL)
                                    <a href="" class="btn btn-success btn-sm  btn-round">Sudah UTJ</a>
                                    @else
                                    <button type="button" class="btn btn-danger btn-sm id_customer btn-round"
                                        data-toggle="modal" data-target="#modals-utj" data-id="{{ $customer->id }}"
                                        id="id_customer">Belum UTJ</button>

                                    @endif
                                    @if($customer->utj_status !== NULL)
                                    <a href="{{ route('choose_house', $customer->id) }}"
                                        class="btn btn-sm btn-info btn-round">Pilih Rumah</a>
                                    @else
                                    <a href="javascript: void(0)" class="btn btn-sm btn-info btn-round"
                                        onclick="return chooseHouse()">Pilih Rumah</a>
                                    @endif
                                    @if ($customer->akad_status == 0)
                                    <button class="btn btn-primary btn-sm btn-round fail_customer" data-toggle="modal"
                                        data-target="#modals-fail" data-id="{{ $customer->id }}"
                                        id="fail_customer">Gagal</button>
                                    @endif

                                    <a href="{{ route('customer.edit', $customer->id) }}"
                                        class="btn btn-warning btn-sm btn-round"> <i
                                            class="feather icon-edit"></i>Ubah</a>
                                    <button onclick="deleteRow({{$customer->id}})"
                                        class="btn btn-danger btn-sm btn-round"><i
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
        <h5>Pemberkasan</h5>
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
                            <form action="{{ route('update.sp3') }}" method="post" id="form-sp3-{{$customer->id}}">
                                @csrf
                                <input type="hidden" value="{{ $customer->id }}" name="id_customer">
                                
                                @if ($customer->sp3_status !== NULL)
                                    <input type="hidden" value="0" name="sp3">
                                @else
                                    <input type="hidden" value="1" name="sp3">
                                @endif
                            </form>

                            <form action="{{ route('update.akad') }}" method="post" id="form-akad-{{$customer->id}}">
                                @csrf
                                <input type="hidden" value="{{ $customer->id }}" name="id_customer">
                                
                                @if ($customer->akad_status !== NULL)
                                    <input type="hidden" value="0" name="akad">
                                @else
                                    <input type="hidden" value="1" name="akad">
                                @endif
                            </form>
                            @if ($customer->dp_status !== NULL)
                            <a href="" class="btn btn-success btn-sm btn-round">Sudah DP</a>
                            @else
                            <button type="button" class="btn btn-danger btn-sm dp_customer btn-round"
                                data-toggle="modal" data-target="#modals-dp" data-id="{{ $customer->id }}"
                                id="dp_customer">Pelunasan DP</button>
                            @endif

                            {{-- @if ($customer->dp_status !== NULL) --}}
                            <a href="{{ route('filling', $customer->id) }}"
                                class="btn btn-warning btn-sm btn-round">Pemberkasan</a>
                            {{-- @else

                            <a href="javascript: void(0)" class="btn btn-sm btn-primary btn-round">Pemberkasan</a>
                            @endif --}}

                            @if ($customer->file_status == 1 && $customer->sp3_status == NULL)
                            <button type="button" class="btn btn-info btn-sm id_customer_bank btn-round"
                                data-toggle="modal" data-target="#modals-bank" data-id="{{ $customer->id }}" id="">Pilih
                                Bank</button>
                            @endif

                            @if ($customer->sp3_status !== NULL)
                                <button class="btn btn-success btn-sm btn-round" onclick="return document.getElementById('form-sp3-{{$customer->id}}').submit()">
                                    Lolos SP3
                                </button>
                            @else    
                                @if ($customer->file_status == 1)
                                <button class="btn btn-danger btn-sm btn-round" onclick="return document.getElementById('form-sp3-{{$customer->id}}').submit()">
                                    SP3
                                </button>
                                @else
                                <button class="btn btn-danger btn-sm btn-round" onclick="return cantSp3()">
                                    SP3
                                </button>
                                @endif
                            @endif

                            @if ($customer->sp3_status !== NULL)
                                @if ($customer->lpa_status == NULL)
                                <button type="button" class="btn btn-info btn-sm id_customer_lpa btn-round"
                                    data-toggle="modal" data-target="#modals-lpa" data-id="{{ $customer->id }}" id="">Bayar
                                    LPA</button>
                                @else
                                <button type="button" class="btn btn-success btn-sm btn-round" id="">Sudah LPA</button>
                                @endif
                            @else
                            <button type="button" class="btn btn-info btn-sm btn-round" onclick="return cantLPA()">Bayar
                                LPA</button>
                            @endif

                            @if ($customer->akad_status !== NULL)
                                <button class="btn btn-success btn-sm btn-round" onclick="return document.getElementById('form-akad-{{$customer->id}}').submit()">
                                    Telah Akad
                                </button>
                            @else
                                @if ($customer->lpa_status !== NULL)
                                    <button class="btn btn-danger btn-sm btn-round id_customer_akad" data-toggle="modal" data-target="#modals-akad" data-id="{{ $customer->id }}">
                                        AKAD
                                    </button>
                                @else
                                <button class="btn btn-danger btn-sm btn-round" onclick="return cantAkad()">
                                    AKAD
                                </button>
                                @endif
                            @endif

                            <a href="{{ route('pemberkasan.show', $customer->id) }}"
                                class="btn btn-primary btn-sm btn-round">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- BANK --}}
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

{{-- DP --}}
<div class="modal fade" id="modals-dp">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('customer.payDP') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran
                    <span class="font-weight-light">DP</span>
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="id_customer_dp" name="id_customer">
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

{{-- LPA --}}
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
                        <input type="text" class="form-control" id="id_customer_lpa" name="id_customer">
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

{{-- AKAD --}}
<div class="modal fade" id="modals-akad">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('update.akad') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Penerimaan
                    <span class="font-weight-light">Akad</span>
                    <br>
                </h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">×</a>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col">
                        <input type="text" class="form-control" id="id_customer_akad" name="id_customer">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col mb-0">
                        <input type="hidden" value="1" name="akad">
                        <label class="form-label">Tanggal Akad</label>
                        <input type="date" class="form-control input-akad" name="date">
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
<script src="{{ asset('assets/js/custom/customer.js') }}"></script>

@endsection
