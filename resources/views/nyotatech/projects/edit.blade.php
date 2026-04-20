@extends('nyotatech.layout_app')

@section('title', 'Edit project — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Edit project</h1>

    <form method="POST" action="{{ route('nyotatech.projects.update', $project) }}" class="card shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="client_id">Client</label>
                <select class="form-select" id="client_id" name="client_id" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" @selected(old('client_id', $project->client_id) == $client->id)>
                            {{ $client->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="name">Project name</label>
                <input class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status" required>
                    @foreach (['draft', 'active', 'on_hold', 'completed'] as $st)
                        <option value="{{ $st }}" @selected(old('status', $project->status) === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="starts_at">Starts</label>
                    <input class="form-control" id="starts_at" name="starts_at" type="date"
                           value="{{ old('starts_at', optional($project->starts_at)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="ends_at">Ends</label>
                    <input class="form-control" id="ends_at" name="ends_at" type="date"
                           value="{{ old('ends_at', optional($project->ends_at)->format('Y-m-d')) }}">
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Update</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.projects.show', $project) }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
