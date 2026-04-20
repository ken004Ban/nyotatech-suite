<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NyotaTech Business Suite')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --nt-accent: #0d6efd;
            --nt-ink: #0b1220;
            --nt-muted: #5b6475;
        }
        body.bg-nt {
            background: radial-gradient(900px 420px at 10% -10%, rgba(13, 110, 253, .14), rgba(13, 110, 253, 0) 60%),
                linear-gradient(180deg, #f6f8fc 0%, #eef2f8 100%);
        }
        .navbar.nt-nav {
            background: linear-gradient(90deg, rgba(13, 110, 253, .18), rgba(13, 110, 253, 0) 40%), var(--nt-ink) !important;
            border-bottom: 2px solid rgba(13, 110, 253, .45);
        }
        .nt-brand { letter-spacing: .3px; font-weight: 800; }
        .nt-brand .mark {
            display: inline-block; width: .55rem; height: .55rem; border-radius: 999px;
            background: var(--nt-accent); margin-right: .5rem;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .22);
        }
        .nav-link.active::after {
            content: ""; position: absolute; left: .35rem; right: .35rem; bottom: .2rem; height: 2px;
            background: var(--nt-accent); border-radius: 999px;
        }
        .nav-link { position: relative; }
    </style>
    @stack('styles')
</head>
<body class="bg-nt">
<nav class="navbar navbar-expand-lg navbar-dark nt-nav">
    <div class="container">
        <a class="navbar-brand nt-brand text-white" href="{{ route('nyotatech.home') }}">
            <span class="mark"></span> NyotaTech Business Suite
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pubNav"
                aria-controls="pubNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="pubNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nyotatech.home') ? 'active' : '' }}"
                       href="{{ route('nyotatech.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nyotatech.services') ? 'active' : '' }}"
                       href="{{ route('nyotatech.services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nyotatech.about') ? 'active' : '' }}"
                       href="{{ route('nyotatech.about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('nyotatech.contact') ? 'active' : '' }}"
                       href="{{ route('nyotatech.contact') }}">Contact</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Business owner login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('nyotatech.dashboard') }}">App</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="fw-semibold mb-1">Please fix the errors below.</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
