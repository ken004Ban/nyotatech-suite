@extends('nyotatech.layout_public')

@section('title', 'Contact — NyotaTech Business Suite')

@section('content')
    <h1 class="h3 mb-3">Contact</h1>
    <p class="text-secondary mb-4">Send a quick message. This starter implementation validates input and flashes a confirmation (no outbound mail yet).</p>

    <form method="POST" action="{{ route('nyotatech.contact.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
@endsection
