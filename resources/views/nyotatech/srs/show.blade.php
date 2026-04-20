@extends('nyotatech.layout_app')

@section('title', $spec->title.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">{{ $spec->title }}</h1>
            <div class="text-secondary">{{ $spec->product_name ?: 'Software system' }}</div>
        </div>
        <a class="btn btn-primary" href="{{ route('nyotatech.srs.pdf', $spec) }}">Download PDF</a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="fw-semibold mb-2">Stakeholders</div>
            <div class="text-secondary">{!! nl2br(e($spec->stakeholders ?: '—')) !!}</div>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="fw-semibold mb-2">Functional requirements</div>
            <div class="text-secondary">{!! nl2br(e($spec->functional_requirements ?: '—')) !!}</div>
        </div>
    </div>
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="fw-semibold mb-2">Non-functional requirements</div>
            <div class="text-secondary">{!! nl2br(e($spec->non_functional_requirements ?: '—')) !!}</div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="fw-semibold mb-2">Assumptions &amp; constraints</div>
            <div class="text-secondary">{!! nl2br(e($spec->assumptions ?: '—')) !!}</div>
        </div>
    </div>
@endsection
