<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">

    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="{{asset('public/assets/img/logo.png')}}" alt="Brand Logo" class="img-fluid" width="20px">
        </span>
        <a href="index.html" class="app-brand-text demo sidenav-text font-weight-normal ml-2">OASE</a>
        <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>
    <div class="sidenav-divider mt-0"></div>

    <ul class="sidenav-inner py-1">
        <li class="sidenav-item @if(Request::is('/')) active @endif">
            <a href="{{ route('home') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-command"></i>
                <div>Beranda</div>
            </a>
        </li>
        @if(Auth::user()->role->name == 'marketing' || Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'pemberkasan' )
        <li class="sidenav-item @if(Request::is('money-setting')) active @endif">
            <a href="{{ route('money-setting.index') }}" class="sidenav-link">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="sidenav-item"><line x1="10" y1="1" x2="10" y2="23"></line><path d="M14 5H8.5a2.3 2.5 0 0 0 0 7h3a3.3 3.5 0 0 1 0 7H5"></path></svg>
                <div>Atur Uang</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Manajemen Rumah</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{ route('blok.index') }}" class="sidenav-link">
                        <div>Perumahan</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('rumah.index') }}" class="sidenav-link">
                        <div>Blok Rumah</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="sidenav-item @if(Request::is('customer')) active @endif">
            <a href="{{ route('customer.index') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-users"></i>
                <div>Customer</div>
            </a>
        </li>
        @endif
        
        
        @if(Auth::user()->role->name == 'akuntansi' || Auth::user()->role->name == 'admin' )
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-file"></i>
                <div>Transaksi</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{ route('kategori-transaksi.index') }}" class="sidenav-link">
                        <div>Kategori Transaksi</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('sub-kategori-transaksi.index') }}" class="sidenav-link">
                        <div>Sub Kategori Transaksi</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('sub-sub-kategori-transaksi.index') }}" class="sidenav-link">
                        <div>Sub Sub Kategori Transaksi</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('akunting.index') }}" class="sidenav-link">
                        <div>Akuntan</div>
                    </a>
                </li>
            </ul>
        </li>
        
        @endif
        @if (Auth::user()->role->name == 'admin')
        <li class="sidenav-item @if (Request::is('role') || Request::is('user')) active @endif">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-user"></i>
                <div>Manajemen User</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item @if(Request::is('role')) active @endif">
                    <a href="{{route('role.index')}}" class="sidenav-link">
                        <div>Role User</div>
                    </a>
                </li>
                <li class="sidenav-item @if(Request::is('user')) active @endif">
                    <a href="{{ route('user.index') }}" class="sidenav-link">
                        <div>User</div>
                    </a>
                </li>
            </ul>
        </li>    
        @endif
        
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Laporan</div>
            </a>
            <ul class="sidenav-menu">
                @if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'akuntansi')
                <li class="sidenav-item">
                    <a href="{{ route('income') }}" class="sidenav-link">
                        <div>Pemasukan</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('spending') }}" class="sidenav-link">
                        <div>Pengeluaran</div>
                    </a>
                </li>    
                @endif
                
                @if (Auth::user()->role->name == 'marketing' || Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'pemberkasan')
                <li class="sidenav-item">
                    <a href="{{ route('report.house') }}" class="sidenav-link">
                        <div>Laporan Perumahan</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('report.laba-rugi') }}" class="sidenav-link">
                        <div>Laporan Transaksi</div>
                    </a>
                </li>
                @endif
                <li class="sidenav-item">
                    <a href="{{ route('report.total-customer') }}" class="sidenav-link">
                        <div>Laporan Total Customer</div>
                    </a>
                </li>
<<<<<<< HEAD

                <li class="sidenav-item">
                    <a href="{{ route('report.week-profit') }}" class="sidenav-link">
                        <div>Laporan Total Profit</div>
                    </a>
                </li>

                <li class="sidenav-item">
                    <a href="{{ route('report.inout') }}" class="sidenav-link">
                        <div class="">Laporan Pemasukan dan Pengeluaran</div>
                    </a>
                </li>
=======
                <li class="sidenav-item">
                    <a href="{{ route('report.week-profit') }}" class="sidenav-link">
                        <div>Laporan Profit</div>
                    </a>
                </li>
                
>>>>>>> a6fcac09e416e1b4250c9a0ffccab4ecde40d020
            </ul>
        </li>

    </ul>
</div>
