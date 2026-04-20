@extends('nyotatech.layout_app')

@section('title', 'Edit client — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Edit client</h1>

    <form method="POST" action="{{ route('nyotatech.clients.update', $client) }}" class="card shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            @include('nyotatech.clients._form', ['client' => $client])
            <button class="btn btn-primary" type="submit">Update</button>
            <a class="btn btn-outline-secondary" href="{{ route('nyotatech.clients.show', $client) }}">Cancel</a>
        </div>
    </form>
@endsection
