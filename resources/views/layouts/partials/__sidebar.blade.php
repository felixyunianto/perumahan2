<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">

    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="{{asset('assets/img/logo.png')}}" alt="Brand Logo" class="img-fluid" width="20px">
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
                <i class="sidenav-icon fa fa-tachometer-alt"></i>
                <div>Beranda</div>
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
        @if(Auth::user()->role->name == 'marketing' || Auth::user()->role->name == 'admin' )
        <li class="sidenav-item @if(Request::is('customer')) active @endif">
            <a href="{{ route('customer.index') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-users"></i>
                <div>Pelanggan</div>
            </a>
        </li>
        @endif
        @if(Auth::user()->role->name == 'pemberkasan' || Auth::user()->role->name == 'admin' )
        <li class="sidenav-item @if(Request::is('pemberkasan')) active @endif">
            <a href="{{ route('pemberkasan.index') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-folder"></i>
                <div>Pemberkasan</div>
            </a>
        </li>
        @endif
        <li class="sidenav-item @if (Request::is('customer/sp3') || Request::is('customer/lpa')) active @endif">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon lnr lnr-apartment"></i>
                <div>Bank</div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{ route('sp3') }}" class="sidenav-link">
                        <div>SP3</div>
                    </a>
                </li>
                <li class="sidenav-item ">
                    <a href="{{ route('akad') }}" class="sidenav-link">
                        <div>Akad</div>
                    </a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->role->name == 'akuntansi' || Auth::user()->role->name == 'admin' )
        <li class="sidenav-item">
            <a href="{{ route('kategori-transaksi.index') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-file"></i>
                <div>Kategori Transaksi</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="{{ route('akunting.index') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-file"></i>
                <div>Akuntan</div>
            </a>
        </li>
        @endif
        
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
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Laporan</div>
            </a>
            <ul class="sidenav-menu">
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
            </ul>
        </li>

    </ul>
</div>
