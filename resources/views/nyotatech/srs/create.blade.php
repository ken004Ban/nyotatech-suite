@extends('nyotatech.layout_app')

@section('title', 'New SRS — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Generate Software Requirement Specification</h1>
    <p class="text-secondary mb-4">Capture structured requirements text. Export a PDF for sharing; iterate the template in <code>resources/views/nyotatech/srs/pdf.blade.php</code>.</p>

    <form method="POST" action="{{ route('nyotatech.srs.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="product_name">Product / system name</label>
                <input class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
            </div>
            <div class="row g-3">
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
                <div class="col-md-6">
                    <label class="form-label" for="document_id">Technical document (optional)</label>
                    <select class="form-select" id="document_id" name="document_id">
                        <option value="">—</option>
                        @foreach ($documents as $doc)
                            <option value="{{ $doc->id }}" @selected(old('document_id') == $doc->id)>
                                {{ $doc->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label" for="stakeholders">Stakeholders</label>
                <textarea class="form-control" id="stakeholders" name="stakeholders" rows="4">{{ old('stakeholders') }}</textarea>
            </div>
            <div class="mt-3">
                <label class="form-label" for="functional_requirements">Functional requirements</label>
                <textarea class="form-control" id="functional_requirements" name="functional_requirements" rows="6">{{ old('functional_requirements') }}</textarea>
            </div>
            <div class="mt-3">
                <label class="form-label" for="non_functional_requirements">Non-functional requirements</label>
                <textarea class="form-control" id="non_functional_requirements" name="non_functional_requirements" rows="5">{{ old('non_functional_requirements') }}</textarea>
            </div>
            <div class="mt-3">
                <label class="form-label" for="assumptions">Assumptions &amp; constraints</label>
                <textarea class="form-control" id="assumptions" name="assumptions" rows="4">{{ old('assumptions') }}</textarea>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Save draft</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.srs.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
