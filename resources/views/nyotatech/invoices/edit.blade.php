@extends('nyotatech.layout_app')

@section('title', 'Edit invoice — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Edit invoice {{ $invoice->number }}</h1>

    <form method="POST" action="{{ route('nyotatech.invoices.update', $invoice) }}" class="card shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="number">Invoice #</label>
                    <input class="form-control" id="number" name="number" value="{{ old('number', $invoice->number) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        @foreach (['draft', 'sent', 'partial', 'paid', 'overdue', 'void'] as $st)
                            <option value="{{ $st }}" @selected(old('status', $invoice->status) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="currency">Currency</label>
                    <input class="form-control" id="currency" name="currency" value="{{ old('currency', $invoice->currency) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="quotation_id">Linked quotation (optional)</label>
                    <select class="form-select" id="quotation_id" name="quotation_id">
                        <option value="">—</option>
                        @foreach ($quotations as $q)
                            <option value="{{ $q->id }}" @selected(old('quotation_id', $invoice->quotation_id) == $q->id)>
                                {{ $q->number }} · {{ $q->client->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="client_id">Client</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected(old('client_id', $invoice->client_id) == $client->id)>
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
                            <option value="{{ $project->id }}" @selected(old('project_id', $invoice->project_id) == $project->id)>
                                {{ $project->name }} ({{ $project->client->company_name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="issued_at">Issued</label>
                    <input class="form-control" id="issued_at" name="issued_at" type="date"
                           value="{{ old('issued_at', optional($invoice->issued_at)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="due_at">Due</label>
                    <input class="form-control" id="due_at" name="due_at" type="date"
                           value="{{ old('due_at', optional($invoice->due_at)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="subtotal">Subtotal</label>
                    <input class="form-control" id="subtotal" name="subtotal" type="number" step="0.01" min="0"
                           value="{{ old('subtotal', $invoice->subtotal) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="tax_rate">Tax rate (%)</label>
                    <input class="form-control" id="tax_rate" name="tax_rate" type="number" step="0.01" min="0" max="100"
                           value="{{ old('tax_rate', $invoice->tax_rate) }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label" for="notes">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $invoice->notes) }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Update</button>
                <a class="btn btn-outline-secondary" href="{{ route('nyotatech.invoices.show', $invoice) }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
