@extends('nyotatech.layout_public')

@section('title', 'NyotaTech Business Suite — Home')

@section('content')
    <div class="p-4 p-md-5 mb-4 bg-white border rounded-3 shadow-sm">
        <div class="text-uppercase small fw-bold text-primary mb-2">Operations • Finance • Delivery</div>
        <h1 class="display-6 fw-bold mb-3">NyotaTech Business Suite</h1>
        <p class="lead text-secondary mb-4">
            A Laravel + Blade workspace for proposals, billing, delivery tracking, and structured documentation—aligned with the same MVC + session patterns you already use.
        </p>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Create account</a>
            <a class="btn btn-outline-dark btn-lg" href="{{ route('login') }}">Business owner login</a>
            <a class="btn btn-outline-primary btn-lg" href="{{ route('nyotatech.services') }}">Explore services</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Commercial workflow</div>
                    <p class="text-secondary small mb-0">Clients, projects, quotations, invoices, and receipts in one place.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Reporting</div>
                    <p class="text-secondary small mb-0">A reports dashboard aggregates operational signals for quick review.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Documentation</div>
                    <p class="text-secondary small mb-0">Upload technical documents and generate SRS exports as PDF.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
