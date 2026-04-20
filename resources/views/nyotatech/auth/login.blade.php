@extends('nyotatech.layout_public')

@section('title', 'Login — NyotaTech')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Sign in</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </form>
                    <p class="small text-secondary mt-3 mb-0">
                        No account? <a href="{{ route('register') }}">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
