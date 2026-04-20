@extends('nyotatech.layout_app')

@section('title', $project->name.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">{{ $project->name }}</h1>
            <div class="text-secondary">{{ $project->client->company_name }} · <span class="badge text-bg-light border">{{ $project->status }}</span></div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.projects.edit', $project) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('nyotatech.quotations.create', ['project_id' => $project->id, 'client_id' => $project->client_id]) }}">New quotation</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="fw-semibold mb-2">Description</div>
            <div class="text-secondary">{!! nl2br(e($project->description ?: '—')) !!}</div>
        </div>
    </div>
@endsection
