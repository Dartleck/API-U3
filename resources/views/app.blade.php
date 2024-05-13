<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ECOMERCE</title>
    
    <link href="{{asset('css/app.css')}}" rel = "stylesheet">


</head>
<body>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <h3>ECOMERCE</h3>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        @yield('content')
    </div>


</body>
</html>