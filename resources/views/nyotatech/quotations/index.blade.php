@extends('nyotatech.layout_app')

@section('title', 'Quotations — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Quotations</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.quotations.create') }}">New quotation</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Number</th>
                <th>Client</th>
                <th>Status</th>
                <th class="text-end">Total</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($quotations as $q)
                <tr>
                    <td class="fw-semibold">{{ $q->number }}</td>
                    <td>{{ $q->client->company_name }}</td>
                    <td><span class="badge text-bg-light border">{{ $q->status }}</span></td>
                    <td class="text-end">{{ $q->currency }} {{ number_format((float) $q->total, 2) }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.quotations.show', $q) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary">No quotations yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $quotations->links() }}</div>
@endsection
