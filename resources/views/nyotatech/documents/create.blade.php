@extends('nyotatech.layout_app')

@section('title', 'Upload document — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Upload document</h1>

    <form method="POST" action="{{ route('nyotatech.documents.store') }}" enctype="multipart/form-data" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="file">File (max 10MB in this starter)</label>
                <input class="form-control" id="file" name="file" type="file" required>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="client_id">Client (optional)</label>
                    <select class="form-select" id="client_id" name="client_id">
                        <option value="">—</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>{{ $client->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="project_id">Project (optional)</label>
                    <select class="form-select" id="project_id" name="project_id">
                        <option value="">—</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                                {{ $project->name }} ({{ $project->client->company_name }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" value="1" id="is_technical" name="is_technical"
                    @checked(old('is_technical'))>
                <label class="form-check-label" for="is_technical">Mark as technical document (recommended for SRS inputs)</label>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Upload</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.documents.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
