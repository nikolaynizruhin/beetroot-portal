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
    <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>

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
                        <img src="{{ asset('images/logo.svg') }}" alt="Beetroot">
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
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('dashboard') }}">
                                            <i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}">
                                            <i class="fa fa-id-card-o fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Employees
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('clients.index') }}">
                                            <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Clients
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('offices.index') }}">
                                            <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Offices
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.edit', Auth::id()) }}">
                                            <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                                            &nbsp;
                                            Settings
                                        </a>
                                    </li>
                                    @admin
                                        <li>
                                            <a href="{{ route('users.create') }}">
                                                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                                &nbsp;
                                                Add Employee
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('clients.create') }}">
                                                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                                &nbsp;
                                                Add Client
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('offices.create') }}">
                                                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>
                                                &nbsp;
                                                Add Office
                                            </a>
                                        </li>
                                    @endadmin
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
                        @endguest
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
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
