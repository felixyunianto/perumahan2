<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

<head>
    @include('layouts.partials.__head')
</head>
<body>
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            @include('layouts.partials.__sidebar')
            <div class="layout-container">
                @include('layouts.partials.__header')
                <div class="layout-content">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('layouts.partials.__footer')
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    @include('layouts.partials.__script')
    @include('sweet::alert')
</body>

</html>