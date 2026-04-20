@extends('nyotatech.layout_app')

@section('title', 'Receipts — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Receipts</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.receipts.create') }}">Record receipt</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Paid</th>
                <th>Invoice</th>
                <th>Client</th>
                <th class="text-end">Amount</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($receipts as $r)
                <tr>
                    <td>{{ $r->paid_at->format('Y-m-d') }}</td>
                    <td class="fw-semibold">{{ $r->invoice->number }}</td>
                    <td>{{ $r->invoice->client->company_name }}</td>
                    <td class="text-end">{{ number_format((float) $r->amount, 2) }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.receipts.show', $r) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary">No receipts yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $receipts->links() }}</div>
@endsection
