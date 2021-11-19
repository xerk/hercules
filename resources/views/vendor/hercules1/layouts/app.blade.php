<!doctype html>
<html lang="zxx">

<head>

    @include('vendor.hercules.shared.header')
    <title>Hercules Projects - Professional Programming Agency @yield('title')</title>

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
