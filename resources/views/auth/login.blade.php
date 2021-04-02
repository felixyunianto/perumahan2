<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

<head>
    <title>OASE PEMALANG</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/x-icon" href="public/assets/img/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/open-iconic.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/fonts/feather.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-material.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/shreerang-material.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/uikit.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('public/assets/libs/perfect-scrollbar/perfect-scrollbar.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('public/assets/css/pages/authentication.css')}}">
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>


    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">


            <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5"
                style="background-image: url('public/assets/img/bg/21.jpg');">
                <div class="ui-bg-overlay bg-dark opacity-50"></div>

                <div class="w-100 text-white px-5">
                    <h1 class="display-2 font-weight-bolder mb-4">PT. OMAH AGENG SENTOSA</h1>
                    <div class="text-large font-weight-light">
                        Selamat Datang di website Omah Ageng Sentosa Pemalang
                    </div>
                </div>

            </div>
            <div class="d-flex col-lg-4 align-items-center bg-white p-5">
                <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                    <div class="w-100">

                        <div class="d-flex justify-content-center align-items-center">
                            <div class="ui-w-60">
                                <div class="w-100 position-relative">
                                    <img src="public/assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">Login to Your Account</h4>

                        <form class="my-5" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Email or Username</label>
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label d-flex justify-content-between align-items-end">
                                    <span>Password</span>
                                </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="clearfix"></div>
                            </div>
                            <a href="pages_authentication_password-reset.html" class="d-block small">Forgot
                                password?</a>
                            <div class="d-flex justify-content-between align-items-center m-0">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label">Remember me</span>
                                </label>
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>

                        <div class="text-center text-muted">
                            Don't have an account yet?
                            <a href="pages_authentication_register-v3.html">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    


    {{-- <script src="{{asset('public/assets/js/pace.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/jquery-3.3.1.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/libs/popper/popper.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/bootstrap.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/sidenav.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/layout-helpers.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/material-ripple.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/demo.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/js/analytics.js')}}"></script> --}}
    @include('sweet::alert')
    
</body>

</html>