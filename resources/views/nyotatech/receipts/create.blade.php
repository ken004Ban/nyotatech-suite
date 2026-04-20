@extends('nyotatech.layout_app')

@section('title', 'New receipt — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Record receipt</h1>

    <form method="POST" action="{{ route('nyotatech.receipts.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="invoice_id">Invoice</label>
                <select class="form-select" id="invoice_id" name="invoice_id" required>
                    <option value="">Select…</option>
                    @foreach ($invoices as $inv)
                        <option value="{{ $inv->id }}" @selected(old('invoice_id', $selectedInvoiceId) == $inv->id)>
                            {{ $inv->number }} · {{ $inv->client->company_name }} ({{ $inv->currency }} {{ number_format((float) $inv->total, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="amount">Amount</label>
                    <input class="form-control" id="amount" name="amount" type="number" step="0.01" min="0.01"
                           value="{{ old('amount') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="paid_at">Paid on</label>
                    <input class="form-control" id="paid_at" name="paid_at" type="date" value="{{ old('paid_at', now()->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="payment_method">Payment method</label>
                    <input class="form-control" id="payment_method" name="payment_method" value="{{ old('payment_method') }}" placeholder="Bank transfer, card, cash…">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="reference">Reference</label>
                    <input class="form-control" id="reference" name="reference" value="{{ old('reference') }}">
                </div>
                <div class="col-12">
                    <label class="form-label" for="notes">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.receipts.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
