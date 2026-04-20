@extends('nyotatech.layout_app')

@section('title', 'Reports — NyotaTech')

@section('content')
    <h1 class="h3 mb-3">Reports dashboard</h1>
    <p class="text-secondary mb-4">Lightweight aggregates suitable for SQLite-backed prototypes. Swap in warehouse queries when you scale out.</p>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Receipts recorded (sum)</div>
                    <div class="fs-3 fw-bold">{{ number_format((float) $receiptsSum, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Outstanding (sent/partial/overdue totals)</div>
                    <div class="fs-3 fw-bold">{{ number_format((float) $outstandingApprox, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-secondary small">Documents + quotations</div>
                    <div class="fs-3 fw-bold">{{ $documentCount }} / {{ $quotationCount }}</div>
                    <div class="small text-secondary">docs / quotes</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Invoices by status</div>
                    @if($invoiceTotals->isEmpty())
                        <div class="text-secondary">No invoices yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                <tr><th>Status</th><th class="text-end">Count</th><th class="text-end">Sum total</th></tr>
                                </thead>
                                <tbody>
                                @foreach ($invoiceTotals as $row)
                                    <tr>
                                        <td>{{ $row->status }}</td>
                                        <td class="text-end">{{ $row->c }}</td>
                                        <td class="text-end">{{ number_format((float) $row->sum_total, 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="fw-semibold mb-2">Projects by status</div>
                    @if($projectsByStatus->isEmpty())
                        <div class="text-secondary">No projects yet.</div>
                    @else
                        <ul class="mb-0">
                            @foreach ($projectsByStatus as $row)
                                <li><strong>{{ $row->status }}</strong>: {{ $row->c }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <div class="fw-semibold mb-2">Top clients by invoiced total</div>
            @if($topClients->isEmpty())
                <div class="text-secondary">No clients yet.</div>
            @else
                <ol class="mb-0">
                    @foreach ($topClients as $c)
                        <li>{{ $c->company_name }} — {{ number_format((float) ($c->invoices_sum_total ?? 0), 2) }}</li>
                    @endforeach
                </ol>
            @endif
        </div>
    </div>
@endsection
