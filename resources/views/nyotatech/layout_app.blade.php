<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NyotaTech — Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root { --nt-accent: #0d6efd; --nt-ink: #0b1220; }
        body.bg-nt { background: linear-gradient(180deg, #f6f8fc 0%, #eef2f8 100%); }
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
        .table > :not(caption) > * > * { padding: .75rem .85rem; }
        .form-label { font-weight: 700; }
    </style>
    @stack('styles')
</head>
<body class="bg-nt">
<nav class="navbar navbar-expand-lg navbar-dark nt-nav">
    <div class="container-fluid">
        <a class="navbar-brand nt-brand text-white" href="{{ route('nyotatech.dashboard') }}">
            <span class="mark"></span> NyotaTech
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#appNav"
                aria-controls="appNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="appNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.clients.index') }}">Clients</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.projects.index') }}">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.quotations.index') }}">Quotations</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.invoices.index') }}">Invoices</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.receipts.index') }}">Receipts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.reports.dashboard') }}">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.documents.index') }}">Documents</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nyotatech.srs.index') }}">SRS</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <span class="text-white-50 small d-none d-md-inline">{{ auth()->user()->email }}</span>
                <a class="btn btn-sm btn-outline-light" href="{{ route('nyotatech.home') }}">Site</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-primary" type="submit">Logout</button>
                </form>
            </div>
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
@stack('scripts')
</body>
</html>
