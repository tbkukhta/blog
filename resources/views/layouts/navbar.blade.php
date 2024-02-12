<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/site/images/blog-logo.png') }}" alt="Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.create') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.create') }}">Register</a>
                        </li>
                    @else
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}" target="_blank">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <span role="button" class="nav-link" onclick="$('#profile').trigger('click')">Profile</span>
                            <form method="post" action="{{ route('profile') }}">
                                @csrf
                                <input name="id" type="hidden" value="{{ encrypt(auth()->user()->id) }}">
                                <button id="profile" type="submit" style="display: none"></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endguest
                </ul>
                <form class="form-inline" method="get" action="{{ route('search') }}">
                    <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search posts" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" role="button">Search</button>
                </form>
            </div>
        </nav>
    </div>
</header>
