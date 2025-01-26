<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @csrf
    <title>@yield('title', 'Laravel Project')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/main.css') }}" />
    <script src="{{ url('/js/main.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="show-message-div" style="" >
            @if(session()->has('success'))
                <div class="alert alert-success alert-message" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if($errors->has('message'))
                <div class="alert alert-danger alert-message" role="alert">
                    {{ $errors->first('message') }}
                </div>
            @endif
        </div>
            <a class="navbar-brand"
               href="{{ auth()->guard('admin')->check() ? route('admin.dashboard') : route('dashboard') }}">
                My Project
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    @if(!auth()->guard('admin')->check())
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">User Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">User Register</a></li>
                    @endif
                @endguest
                @auth

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
                        @if(auth()->guard('admin')->check())
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    Logout
                                </a>
                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                    @endif


            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
