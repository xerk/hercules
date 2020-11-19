<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="//db.onlinewebfonts.com/c/c36ae25995bf2b3f70549cfd6fdf0b42?family=SF+Pro+AR+Display+Black" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-apple antialiased">
    @inertia
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v9.0'
        });
      };

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
      attribution=setup_tool
      page_id="923976101122315"
theme_color="#0A7CFF">
    </div>
    @php
    $newTrans = [];
    $translations = resource_path('lang/vendor/jetstream/'.app()->getLocale().'.json');
        if (is_string($translations)) {
            if (! is_readable($translations)) {
                return $newTrans;
            }

            $translations = json_decode(file_get_contents($translations), true);
        }

        $newTrans = array_merge($newTrans, $translations);
    @endphp
    <script>
        window.config = @json([
            'translations' => $newTrans
        ]);
    </script>
</body>

</html>
