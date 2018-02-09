<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.svg') }}" height="40" width="112" alt="Beetroot">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item @routeis('dashboard') active @endrouteis">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Dashboard
                            @routeis('dashboard')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('users.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            Employees
                            @routeis('users.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('clients.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            Clients
                            @routeis('clients.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('offices.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('offices.index') }}">
                            Offices
                            @routeis('offices.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    @admin
                        <li class="nav-item dropdown">
                            <a href="#"
                               id="navbarDropdown"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Admin
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users.create') }}">Add Employee</a>
                                <a class="dropdown-item" href="{{ route('clients.create') }}">Add Client</a>
                                <a class="dropdown-item" href="{{ route('offices.create') }}">Add Office</a>
                            </div>
                        </li>
                    @endadmin
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#"
                           class="nav-link dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                                <i class="fas fa-cog fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                Logout
                            </a>

                            <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>