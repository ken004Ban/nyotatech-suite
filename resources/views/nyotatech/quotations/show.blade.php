@extends('nyotatech.layout_app')

@section('title', $quotation->number.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">Quotation {{ $quotation->number }}</h1>
            <div class="text-secondary">{{ $quotation->client->company_name }} · <span class="badge text-bg-light border">{{ $quotation->status }}</span></div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.quotations.edit', $quotation) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('nyotatech.quotations.pdf', $quotation) }}">Download PDF</a>
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.invoices.create', ['quotation_id' => $quotation->id]) }}">Create invoice</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Summary</div>
                    <div class="text-secondary">{!! nl2br(e($quotation->notes ?: '—')) !!}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between"><span class="text-secondary">Subtotal</span><span>{{ $quotation->currency }} {{ number_format((float) $quotation->subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between mt-2"><span class="text-secondary">Tax ({{ $quotation->tax_rate }}%)</span><span>{{ $quotation->currency }} {{ number_format((float) $quotation->tax_amount, 2) }}</span></div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>{{ $quotation->currency }} {{ number_format((float) $quotation->total, 2) }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
