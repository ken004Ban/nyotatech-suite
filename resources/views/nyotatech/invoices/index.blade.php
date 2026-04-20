@extends('nyotatech.layout_app')

@section('title', 'Invoices — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Invoices</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.invoices.create') }}">New invoice</a>
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
            @forelse ($invoices as $inv)
                <tr>
                    <td class="fw-semibold">{{ $inv->number }}</td>
                    <td>{{ $inv->client->company_name }}</td>
                    <td><span class="badge text-bg-light border">{{ $inv->status }}</span></td>
                    <td class="text-end">{{ $inv->currency }} {{ number_format((float) $inv->total, 2) }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.invoices.show', $inv) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary">No invoices yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $invoices->links() }}</div>
@endsection
