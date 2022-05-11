<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex flex-column splash">
            <div class="brand d-flex justify-content-center align-items-center flex-fill">
                <h1 class="display-4 bg-white px-3 py-2 border border-3 border-dark">TheComm</h1>
            </div>

            <div class="d-grid gap-2 col-8 mx-auto py-4">
                <a href="{{route('login')}}" class="btn btn-dark font-weight-bolder">LOGIN</a>
            </div>
        </div>
    </body>
</html>