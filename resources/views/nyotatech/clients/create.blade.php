@extends('nyotatech.layout_app')

@section('title', 'New client — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">New client</h1>

    <form method="POST" action="{{ route('nyotatech.clients.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            @include('nyotatech.clients._form', ['client' => null])
            <button class="btn btn-primary" type="submit">Save</button>
            <a class="btn btn-outline-secondary" href="{{ route('nyotatech.clients.index') }}">Cancel</a>
        </div>
    </form>
@endsection
