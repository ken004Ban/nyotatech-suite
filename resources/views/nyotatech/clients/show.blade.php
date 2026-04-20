@extends('nyotatech.layout_app')

@section('title', $client->company_name.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">{{ $client->company_name }}</h1>
            <div class="text-secondary">{{ $client->email }} @if($client->phone) · {{ $client->phone }} @endif</div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.clients.edit', $client) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('nyotatech.projects.create', ['client_id' => $client->id]) }}">New project</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="fw-semibold mb-2">Details</div>
            <div class="text-secondary">{!! nl2br(e($client->notes ?: '—')) !!}</div>
            @if($client->address_line)
                <hr>
                <div class="fw-semibold mb-1">Address</div>
                <div>{{ $client->address_line }}</div>
            @endif
        </div>
    </div>
@endsection
