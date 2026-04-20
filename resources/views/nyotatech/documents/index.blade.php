@extends('nyotatech.layout_app')

@section('title', 'Documents — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Documents</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.documents.create') }}">Upload</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Title</th>
                <th>Technical</th>
                <th>Linked</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($documents as $doc)
                <tr>
                    <td class="fw-semibold">{{ $doc->title }}</td>
                    <td>{{ $doc->is_technical ? 'Yes' : 'No' }}</td>
                    <td class="text-secondary small">
                        @if($doc->project)
                            {{ $doc->project->name }}
                        @elseif($doc->client)
                            {{ $doc->client->company_name }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.documents.show', $doc) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-secondary">No uploads yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $documents->links() }}</div>
@endsection
