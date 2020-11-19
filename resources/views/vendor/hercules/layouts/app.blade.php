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
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v9.0'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=install_email page_id="923976101122315" theme_color="#0A7CFF">
    </div>
</body>

</html>
