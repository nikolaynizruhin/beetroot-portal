<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beetroot Family Portal</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <div id="app">
        @include('partials.nav')

        <main class="py-4">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <!-- Scripts -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
