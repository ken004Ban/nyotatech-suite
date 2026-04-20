@extends('nyotatech.layout_app')

@section('title', $invoice->number.' — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">Invoice {{ $invoice->number }}</h1>
            <div class="text-secondary">{{ $invoice->client->company_name }} · <span class="badge text-bg-light border">{{ $invoice->status }}</span></div>
            @if($invoice->quotation)
                <div class="small text-secondary mt-1">Linked quotation: {{ $invoice->quotation->number }}</div>
            @endif
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.invoices.edit', $invoice) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('nyotatech.invoices.pdf', $invoice) }}">Download PDF</a>
            <a class="btn btn-outline-primary" href="{{ route('nyotatech.receipts.create', ['invoice_id' => $invoice->id]) }}">Record receipt</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Notes</div>
                    <div class="text-secondary">{!! nl2br(e($invoice->notes ?: '—')) !!}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between"><span class="text-secondary">Subtotal</span><span>{{ $invoice->currency }} {{ number_format((float) $invoice->subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between mt-2"><span class="text-secondary">Tax ({{ $invoice->tax_rate }}%)</span><span>{{ $invoice->currency }} {{ number_format((float) $invoice->tax_amount, 2) }}</span></div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>{{ $invoice->currency }} {{ number_format((float) $invoice->total, 2) }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="fw-semibold mb-2">Receipts</div>
        @if($invoice->receipts->isEmpty())
            <div class="text-secondary">No receipts yet.</div>
        @else
            <div class="table-responsive card shadow-sm">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>Paid</th>
                        <th class="text-end">Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoice->receipts as $r)
                        <tr>
                            <td>{{ $r->paid_at->format('Y-m-d') }}</td>
                            <td class="text-end">{{ number_format((float) $r->amount, 2) }}</td>
                            <td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.receipts.show', $r) }}">Open</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
