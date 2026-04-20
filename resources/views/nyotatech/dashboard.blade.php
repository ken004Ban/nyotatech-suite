@extends('nyotatech.layout_app')

@section('title', 'Dashboard — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Dashboard</h1>
    <p class="text-secondary mb-4">Welcome back. This overview is intentionally lightweight—expand with charts when you connect real analytics.</p>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Clients</div>
                    <div class="fs-3 fw-bold">{{ $clientCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Projects</div>
                    <div class="fs-3 fw-bold">{{ $projectCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Open invoices</div>
                    <div class="fs-3 fw-bold">{{ $openInvoiceCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Quotations</div>
                    <div class="fs-3 fw-bold">{{ $quotationCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex flex-wrap gap-2">
        <a class="btn btn-primary" href="{{ route('nyotatech.clients.create') }}">New client</a>
        <a class="btn btn-outline-primary" href="{{ route('nyotatech.invoices.create') }}">New invoice</a>
        <a class="btn btn-outline-primary" href="{{ route('nyotatech.documents.create') }}">Upload document</a>
    </div>
@endsection
