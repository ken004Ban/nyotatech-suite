@extends('nyotatech.layout_public')

@section('title', 'Register — NyotaTech')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-3">Create account</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm password</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Register</button>
                    </form>
                    <p class="small text-secondary mt-3 mb-0">
                        Already registered? <a href="{{ route('login') }}">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
