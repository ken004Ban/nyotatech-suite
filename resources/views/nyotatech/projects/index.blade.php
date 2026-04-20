@extends('nyotatech.layout_app')

@section('title', 'Projects — NyotaTech')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Projects</h1>
        <a class="btn btn-primary" href="{{ route('nyotatech.projects.create') }}">New project</a>
    </div>

    <div class="table-responsive card shadow-sm">
        <table class="table table-striped mb-0">
            <thead>
            <tr>
                <th>Project</th>
                <th>Client</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td class="fw-semibold">{{ $project->name }}</td>
                    <td>{{ $project->client->company_name }}</td>
                    <td><span class="badge text-bg-light border">{{ $project->status }}</span></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('nyotatech.projects.show', $project) }}">Open</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-secondary">No projects yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $projects->links() }}</div>
@endsection
