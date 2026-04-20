@extends('nyotatech.layout_app')

@section('title', 'SRS — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Software Requirement Specifications</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.srs.create') }}">Generate SRS</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Title</th>
                <th>Product</th>
                <th>Project</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($specs as $spec)
                <tr>
                    <td class="fw-semibold">{{ $spec->title }}</td>
                    <td>{{ $spec->product_name ?: '—' }}</td>
                    <td class="text-secondary small">{{ $spec->project?->name ?? '—' }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.srs.show', $spec) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-secondary">No SRS drafts yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $specs->links() }}</div>
@endsection
