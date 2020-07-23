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
    <div class="card-body">
        <form action="{{ route('pemberkasan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                    <label for="">Pas Foto 3 x 4</label>
                    <input type="hidden" name="customer_id" value="{{ $customers->id }}">
                    <input type="file" name="photos" class="form-control">
                    @if($filings->photos !== NULL)
                    <img src="{{ asset($filings->photos) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Fotocopy KTP</label>
                    <input type="file" name="fc_id_card" class="form-control">
                    @if($filings->fc_id_card !== NULL)
                    <img src="{{ asset($filings->fc_id_card) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Fotocopy KK</label>
                    <input type="file" name="fc_family_card" class="form-control">
                    @if($filings->fc_family_card !== NULL)
                    <img src="{{ asset($filings->fc_family_card) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Fotocopy Surat Nikah <span>( Optional )</span> </label>
                    <input type="file" name="fc_marriage_certificate" class="form-control">
                    @if($filings->fc_marriage_certificate !== NULL)
                    <img src="{{ asset($filings->fc_marriage_certificate) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="">Fotocopy NPWP</label>
                    <input type="file" name="fc_taxpayer_identification" class="form-control">
                    @if($filings->fc_taxpayer_identification !== NULL)
                    <img src="{{ asset($filings->fc_taxpayer_identification) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Surat Keteragan Kerja / SIUP</label>
                    <input type="file" name="tax_status" class="form-control">
                    @if($filings->tax_status !== NULL)
                    <img src="{{ asset($filings->tax_status) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Slip Gaji / Penghasilan</label>
                    <input type="file" name="income" class="form-control">
                    @if($filings->income !== NULL)
                    <img src="{{ asset($filings->income) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="">Rekening Koran</label>
                    <input type="file" name="current_account" class="form-control">
                    @if($filings->current_account !== NULL)
                    <img src="{{ asset($filings->current_account) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Tabungan BTN</label>
                    <input type="file" name="saving" class="form-control">
                    @if($filings->saving !== NULL)
                    <img src="{{ asset($filings->saving) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">SK Tidak Memiliki Rumah</label>
                    <input type="file" name="ls_havent_house" class="form-control">
                    @if($filings->ls_havent_house !== NULL)
                    <img src="{{ asset($filings->ls_havent_house) }}" alt="" width="80px" height="80px">
                    @endif
                </div>
              </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
