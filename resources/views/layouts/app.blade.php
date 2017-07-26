<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beetroot</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="https://beetroot.se/wp-content/uploads/2016/04/cropped-favicon-150x150.png"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="https://beetroot.se/wp-content/uploads/2016/04/logo.svg" alt="Beetroot">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('home') }}">
                                            <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users') }}">
                                            <i class="fa fa-id-card-o fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Users
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('clients') }}">
                                            <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Clients
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('offices') }}">
                                            <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Offices
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.edit', Auth::id()) }}">
                                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
            <div class="container">
                <p class="text-muted text-center">© 2017 Beetroot. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
