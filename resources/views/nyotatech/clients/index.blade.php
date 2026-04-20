@extends('nyotatech.layout_app')

@section('title', 'Clients — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Clients</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.clients.create') }}">New client</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($clients as $client)
                <tr>
                    <td class="fw-semibold">{{ $client->company_name }}</td>
                    <td>{{ $client->contact_name }}</td>
                    <td>{{ $client->email }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.clients.show', $client) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-secondary">No clients yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $clients->links() }}</div>
@endsection
