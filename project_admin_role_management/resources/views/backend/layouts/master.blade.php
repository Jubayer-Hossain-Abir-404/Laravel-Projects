<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('backend/assets/images/icon/favicon.ico') }}">
    {{-- @yield('css-content') --}}
    @include('backend.layouts.partials.style')
</head>

<body>
    
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        {{-- @yield('sidebar-content') --}}
        @include('backend.layouts.partials.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            {{-- @yield('header-content') --}}
            @include('backend.layouts.partials.header')
            <!-- header area end -->
            <div class="main-content-inner">
                @yield('admin-content')
                
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        {{-- @yield('footer-content') --}}
        @include('backend.layouts.partials.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    {{-- @yield('offset-section') --}}
    @include('backend.layouts.partials.offset')
    <!-- offset area end -->
    <!-- jquery latest version -->
    
    {{-- @yield('script-section') --}}
    @include('backend.layouts.partials.scripts')
</body>

</html>
