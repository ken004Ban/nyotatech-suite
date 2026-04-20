@extends('nyotatech.layout_app')

@section('title', 'New quotation — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">New quotation</h1>

    <form method="POST" action="{{ route('nyotatech.quotations.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="number">Quotation #</label>
                    <input class="form-control" id="number" name="number" value="{{ old('number') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach (['draft', 'sent', 'accepted', 'rejected', 'expired'] as $st)
                            <option value="{{ $st }}" @selected(old('status', 'draft') === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="currency">Currency</label>
                    <input class="form-control" id="currency" name="currency" value="{{ old('currency', 'USD') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="client_id">Client</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="">Select…</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id', $selectedClientId) == $client->id)>
                                {{ $client->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="project_id">Project (optional)</label>
                    <select class="form-select" id="project_id" name="project_id">
                        <option value="">—</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" @selected(old('project_id', $selectedProjectId) == $project->id)>
                                {{ $project->name }} ({{ $project->client->company_name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="issued_at">Issued</label>
                    <input class="form-control" id="issued_at" name="issued_at" type="date" value="{{ old('issued_at') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="valid_until">Valid until</label>
                    <input class="form-control" id="valid_until" name="valid_until" type="date" value="{{ old('valid_until') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="subtotal">Subtotal</label>
                    <input class="form-control" id="subtotal" name="subtotal" type="number" step="0.01" min="0"
                           value="{{ old('subtotal', '0') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tax_rate">Tax rate (%)</label>
                    <input class="form-control" id="tax_rate" name="tax_rate" type="number" step="0.01" min="0" max="100"
                           value="{{ old('tax_rate', '0') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label" for="notes">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.quotations.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
