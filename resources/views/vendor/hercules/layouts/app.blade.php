<!doctype html>
<html lang="zxx">

<!-- Mirrored from templates.envytheme.com/plamb/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Oct 2020 21:54:23 GMT -->

<head>

    @include('vendor.hercules.shared.header')
    <title>Hercules - @yield('title')</title>

    {{-- Add CSS code  --}}
    @yield('css')

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="shadow"></div>
            <div class="box"></div>
        </div>
    </div>
    <!-- End Preloader -->

    @include('vendor.hercules.shared.nav')


    {{-- Content Website  --}}
    @yield('content')

    {{-- Shard includes  --}}
    @include('vendor.hercules.shared.footer')
    @include('vendor.hercules.shared.go-top')
    @include('vendor.hercules.shared.js')

    {{-- Add JS code --}}
    @yield('js')
</body>

</html>
