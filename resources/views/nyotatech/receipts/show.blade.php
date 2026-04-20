@extends('nyotatech.layout_app')

@section('title', 'Receipt — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">Receipt</h1>
            <div class="text-secondary">Invoice {{ $receipt->invoice->number }} · {{ $receipt->invoice->client->company_name }}</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('nyotatech.invoices.show', $receipt->invoice) }}">View invoice</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-secondary small">Amount</div>
                    <div class="fs-4 fw-bold">{{ number_format((float) $receipt->amount, 2) }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-secondary small">Paid on</div>
                    <div class="fw-semibold">{{ $receipt->paid_at->format('Y-m-d') }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-secondary small">Method</div>
                    <div class="fw-semibold">{{ $receipt->payment_method ?: '—' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-secondary small">Reference</div>
                    <div>{{ $receipt->reference ?: '—' }}</div>
                </div>
                <div class="col-12">
                    <div class="text-secondary small">Notes</div>
                    <div>{!! nl2br(e($receipt->notes ?: '—')) !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
