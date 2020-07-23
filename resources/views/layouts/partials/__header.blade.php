<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-dark container-p-x" id="layout-navbar">

    <a href="index.html" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
        <span class="app-brand-logo demo">
            <img src="{{asset('assets/img/logo-dark.png')}}" alt="Brand Logo" class="img-fluid">
        </span>
        <span class="app-brand-text demo font-weight-normal ml-2">OASE</span>
    </a>

    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="layout-navbar-collapse">

        <hr class="d-lg-none w-100 my-2">
        <div class="navbar-nav align-items-lg-center ml-auto">
            <div class="demo-navbar-notifications nav-item dropdown mr-lg-3">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown">
                    <i class="feather icon-bell navbar-icon align-middle"></i>
                    @if($notYet->count()>0)
                    <span class="badge badge-danger badge-dot indicator"></span>
                    @endif
                    <span class="d-lg-none align-middle">&nbsp; Notifications</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="bg-primary text-center text-white font-weight-bold p-3">
                        {{ $notYet->count() }} Notifications
                    </div>

                    @foreach ($notYet as $ny)
                    <div class="list-group list-group-flush">
                        <a href="javascript:"
                            class="list-group-item list-group-item-action media d-flex align-items-center">
                            <div class="ui-icon ui-icon-sm feather icon-user bg-secondary border-0 text-white">
                            </div>
                            <div class="media-body line-height-condenced ml-3">
                                <div class="text-dark">{{ $ny->name }}</div>
                                <div class="text-light small mt-1">
                                    Belum selesai melakukan pengisian berkas.
                                    <br>
                                    (
                                    @if($ny->filing->photos == NULL)
                                    Pas Foto 3x4,
                                    @endif
                                    @if($ny->filing->fc_id_card == NULL)
                                    Fotocopy KTP,
                                    @endif
                                    @if($ny->filing->fc_family_card == NULL)
                                    Fotocopy KK,
                                    @endif
                                    @if($ny->filing->fc_taxpayer_identification == NULL)
                                    Fotocopy NPWP,
                                    @endif
                                    @if($ny->filing->tax_status == NULL)
                                    Surat Keterangan Kerja / Usaha,
                                    @endif
                                    @if($ny->filing->income == NULL)
                                    Surat Penghasilan 3 Bulan,
                                    @endif
                                    @if($ny->filing->current_account == NULL)
                                    Rekening Koran,
                                    @endif
                                    @if($ny->filing->saving == NULL)
                                    Tabungan BTN,
                                    @endif
                                    @if($ny->filing->ls_havent_house == NULL)
                                    Surat Keterangan Tidak Memiliki Rumah, 
                                    @endif
                                    )
                                </div>
                                <div class="text-light small mt-1">{{ $ny->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">
                |</div>
            <div class="demo-navbar-user nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                        <img src="{{asset('assets/img/1.png')}}" alt class="d-block ui-w-30 rounded-circle" style="opacity: 0">
                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:" class="dropdown-item">
                        <i class="feather icon-user text-muted"></i> &nbsp; My profile</a>
                    <a href="javascript:" class="dropdown-item">
                        <i class="feather icon-mail text-muted"></i> &nbsp; Messages</a>
                    <a href="javascript:" class="dropdown-item">
                        <i class="feather icon-settings text-muted"></i> &nbsp; Account settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript: void(0)" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="feather icon-power text-danger"></i> &nbsp; Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
