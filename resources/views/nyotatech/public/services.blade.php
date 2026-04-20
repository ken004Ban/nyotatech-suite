@extends('nyotatech.layout_public')

@section('title', 'Services — NyotaTech Business Suite')

@section('content')
    <h1 class="h3 mb-3">Services</h1>
    <p class="text-secondary mb-4">NyotaTech Business Suite is structured as modular Laravel controllers and Blade views—mirroring a conventional web stack with server-rendered pages and session flash messaging.</p>

    <div class="list-group shadow-sm">
        <div class="list-group-item">
            <div class="fw-semibold">Client &amp; project management</div>
            <div class="small text-secondary">Maintain client records and link active work as projects.</div>
        </div>
        <div class="list-group-item">
            <div class="fw-semibold">Quotations &amp; invoicing</div>
            <div class="small text-secondary">Create quotations, convert to invoices, and export PDFs with DomPDF.</div>
        </div>
        <div class="list-group-item">
            <div class="fw-semibold">Receipts</div>
            <div class="small text-secondary">Record payments against invoices for a simple cash-reconciliation trail.</div>
        </div>
        <div class="list-group-item">
            <div class="fw-semibold">Document management &amp; SRS</div>
            <div class="small text-secondary">Upload technical files and generate Software Requirements Specification documents.</div>
        </div>
    </div>
@endsection
