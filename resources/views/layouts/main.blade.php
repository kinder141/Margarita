<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DB Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<div id="root">
    <header class="header">
        <div class="container">
            <div class="header__content">
                <div class="a-side">
                    <a href="{{ route('laptops') }}" class="logo"></a>
                    <ul class="nav">
                        <li>
                            <a href="{{ route('laptops') }}">Laptops</a>
                        </li>
                        <li>
                            <a href="{{ route('smartphones') }}">Smartphones</a>
                        </li>
                        <li>
                            <a href="{{ route('televisions') }}">TV</a>
                        </li>
                    </ul>
                </div>
                <div class="b-side">
                    @guest
                        <ul class="login-box">
                            <li><a href="{{ route('login') }}">Log in</a></li>
                            <li>or</li>
                            <li><a href="{{ route('register') }}">Sing in</a></li>
                        </ul>
                    @else
                        <div class="user-box">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <ul class="user-menu">
                                <li><a href="">Profile</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>
    @yield('content')
</div>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
