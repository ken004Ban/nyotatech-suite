@extends('nyotatech.layout_app')

@section('title', 'New invoice — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">New invoice</h1>

    @if($prefillQuotation)
        <div class="alert alert-info">
            Prefilling from quotation <strong>{{ $prefillQuotation->number }}</strong>.
        </div>
    @endif

    <form method="POST" action="{{ route('nyotatech.invoices.store') }}" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="number">Invoice #</label>
                    <input class="form-control" id="number" name="number" value="{{ old('number') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach (['draft', 'sent', 'partial', 'paid', 'overdue', 'void'] as $st)
                            <option value="{{ $st }}" @selected(old('status', 'draft') === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="currency">Currency</label>
                    <input class="form-control" id="currency" name="currency"
                           value="{{ old('currency', $prefillQuotation?->currency ?: 'USD') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="quotation_id">Linked quotation (optional)</label>
                    <select class="form-select" id="quotation_id" name="quotation_id">
                        <option value="">—</option>
                        @foreach ($quotations as $q)
                            <option value="{{ $q->id }}" @selected(old('quotation_id', $prefillQuotation?->id) == $q->id)>
                                {{ $q->number }} · {{ $q->client->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="client_id">Client</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="">Select…</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id', $prefillQuotation?->client_id) == $client->id)>
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
                            <option value="{{ $project->id }}" @selected(old('project_id', $prefillQuotation?->project_id) == $project->id)>
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
                    <label class="form-label" for="due_at">Due</label>
                    <input class="form-control" id="due_at" name="due_at" type="date" value="{{ old('due_at') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="subtotal">Subtotal</label>
                    <input class="form-control" id="subtotal" name="subtotal" type="number" step="0.01" min="0"
                           value="{{ old('subtotal', $prefillQuotation?->subtotal ?? '0') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tax_rate">Tax rate (%)</label>
                    <input class="form-control" id="tax_rate" name="tax_rate" type="number" step="0.01" min="0" max="100"
                           value="{{ old('tax_rate', $prefillQuotation?->tax_rate ?? '0') }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label" for="notes">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.invoices.index') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
