@extends('nyotatech.layout_app')

@section('title', $document->title.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">{{ $document->title }}</h1>
            <div class="text-secondary">{{ $document->original_filename }} · {{ $document->mime_type ?? 'unknown type' }}</div>
        </div>
        <a class="btn btn-primary" href="{{ route('nyotatech.documents.download', $document) }}">Download</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-secondary small">Technical</div>
                    <div class="fw-semibold">{{ $document->is_technical ? 'Yes' : 'No' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-secondary small">Client</div>
                    <div class="fw-semibold">{{ $document->client?->company_name ?? '—' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-secondary small">Project</div>
                    <div class="fw-semibold">{{ $document->project?->name ?? '—' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
