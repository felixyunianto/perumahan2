 @extends('layouts.app')
 @section('content')
 <h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
 <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
         <li class="breadcrumb-item active"><a href="#!">Dashboard</a></li>
     </ol>
 </div>

 <div class="row">
     <div class="col-sm-12">
         <div class="card">
             <div class="card-header">
                 <h5>Laporan Pelanggan</h5>
             </div>
             <div class="card-body">

                 <div class="row">
                     <div class="col-md-2 col-xs-6 border-right">
                         <h3>0</h3>
                         <span class="">Total SP3</span>
                     </div>
                     <div class="col-md-2 col-xs-6 border-right">
                         <h3>0</h3>
                         <span class="text-success">Total Proses</span>
                     </div>
                     <div class="col-md-2 col-xs-6 border-right">
                         <h3>0</h3>
                         <span class="text-danger">Total Akad</span>
                     </div>
                     <div class="col-md-2 col-xs-6 border-right">
                         <h3>0</h3>
                         <span class="text-info">Total Cash</span>
                     </div>
                     <div class="col-md-2  col-xs-6 border-right">
                         <h3>0</h3>
                         <span class="text-danger">Total</span>
                     </div>
                     <div class="col-md-2 col-xs-6">
                         <h3>0</h3>
                         <span class="text-primary">Kosong</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-12">
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
     </div>
     <div class="col-md-12">
         <div class="card">
             <div class="card-header">
                 <h5>Laporan Hutang / Piutang</h5>
             </div>
             <div class="card-body">
                 <div class="row justify-content-center text-center">
                     <div class="col-md-4 col-xs-12 border-right">
                         <h3>Rp. 10.000.000</h3>
                         <span class="text-success">Total Hutang</span>
                     </div>
                     <div class="col-md-4 col-xs-12 border-right">
                         <h3>Rp. 20.000.000</h3>
                         <span class="text-danger">Total Piutang</span>
                     </div>
                     <div class="col-md-4 col-xs-12 border-right">
                         <h3>Rp. 10.000.000</h3>
                         <span class="text-info">Total</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endsection
