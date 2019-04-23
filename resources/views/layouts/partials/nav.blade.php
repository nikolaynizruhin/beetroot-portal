<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.svg') }}" height="50" width="140" alt="Beetroot">
        </a>

        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
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
                            Beetroots
                            @routeis('users.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('clients.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('clients.index') }}">
                            Teams
                            @routeis('clients.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('offices.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('offices.index') }}">
                            Locations
                            @routeis('offices.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item @routeis('birthdays.index') active @endrouteis">
                        <a class="nav-link" href="{{ route('birthdays.index') }}">
                            Birthdays
                            @routeis('birthdays.index')
                                <span class="sr-only">(current)</span>
                            @endrouteis
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#"
                           id="navbarDropdown"
                           class="nav-link dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                            More
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('calendar') }}">Calendar</a>
                            <a class="dropdown-item" href="https://docs.google.com/spreadsheets/d/1EZoCCLXrQS2_w1SdDudUfKuFwiaddaBmtemGabIsIjo/edit#gid=0" target="_blank">Discounts</a>
                            <a class="dropdown-item" href="{{ route('tags.index') }}">Skills</a>
                            <a class="dropdown-item" href="{{ route('info') }}">Info</a>
                            <a class="dropdown-item" href="{{ route('privacy') }}">Privacy Policy</a>
                            @admin
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('users.create') }}">Add Beetroot</a>
                                <a class="dropdown-item" href="{{ route('clients.create') }}">Add Team</a>
                                <a class="dropdown-item" href="{{ route('offices.create') }}">Add Location</a>
                                <a class="dropdown-item" href="{{ route('tags.create') }}">Add Skill</a>
                            @endadmin
                        </div>
                    </li>
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
                            <img src="{{ asset('storage/'.Auth::user()->avatar) }}"
                                 class="rounded-circle"
                                 height="35"
                                 width="35"
                                 alt="Avatar">
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <h6 class="dropdown-header">
                                {{ Auth::user()->name }}
                            </h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                                <i class="fas fa-cog fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                Settings
                            </a>
                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                Logout
                            </a>

                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  class="hidden">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
