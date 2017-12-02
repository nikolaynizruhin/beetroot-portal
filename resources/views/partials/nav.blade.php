<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#app-navbar-collapse">
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
                @auth
                    <li class="@routeis('dashboard') active @endrouteis">
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                            @routeis('dashboard')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="@routeis('users.index') active @endrouteis">
                        <a href="{{ route('users.index') }}">
                            Employees
                            @routeis('users.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="@routeis('clients.index') active @endrouteis">
                        <a href="{{ route('clients.index') }}">
                            Clients
                            @routeis('clients.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="@routeis('offices.index') active @endrouteis">
                        <a href="{{ route('offices.index') }}">
                            Offices
                            @routeis('offices.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    @admin
                        <li class="dropdown">
                            <a href="#"
                               class="dropdown-toggle"
                               data-toggle="dropdown"
                               role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                Admin
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('users.create') }}">Add Employee</a></li>
                                <li><a href="{{ route('clients.create') }}">Add Client</a></li>
                                <li><a href="{{ route('offices.create') }}">Add Office</a></li>
                            </ul>
                        </li>
                    @endadmin
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('users.edit', Auth::id()) }}">
                                    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                                    &nbsp;
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                                    &nbsp;
                                    Logout
                                </a>

                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      class="hidden">
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