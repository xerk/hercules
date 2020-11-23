<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script type="text/javascript">
            function callbackThen(response){
                // read HTTP status
                console.log(response.status);
                
                // read Promise object
                response.json().then(function(data){
                    console.log(data);
                });
            }
            function callbackCatch(error){
                console.error('Error:', error)
            }   
        </script> 
        
        {!! htmlScriptTagJsApi([
            'action' => 'homepage',
            'callback_then' => 'callbackThen',
            'callback_catch' => 'callbackCatch'
        ]) !!}

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/ico" href="{{ asset('vendor/hercules/assets/img/favicon.ico') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
