<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Receipt;
use Illuminate\View\View;

class ReportsDashboardController extends Controller
{
    public function index(): View
    {
        $invoiceTotals = Invoice::query()
            ->selectRaw('status, COUNT(*) as c, COALESCE(SUM(total), 0) as sum_total')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $receiptsSum = Receipt::query()->sum('amount');
        $outstanding = Invoice::query()
            ->whereIn('status', ['sent', 'partial', 'overdue'])
            ->sum('total');

        $projectsByStatus = Project::query()
            ->selectRaw('status, COUNT(*) as c')
            ->groupBy('status')
            ->get();

        $topClients = Client::query()
            ->withSum('invoices', 'total')
            ->orderByDesc('invoices_sum_total')
            ->limit(5)
            ->get();

        return view('nyotatech.reports.index', [
            'invoiceTotals' => $invoiceTotals,
            'receiptsSum' => $receiptsSum,
            'outstandingApprox' => $outstanding,
            'projectsByStatus' => $projectsByStatus,
            'topClients' => $topClients,
            'documentCount' => Document::query()->count(),
            'quotationCount' => Quotation::query()->count(),
        ]);
    }
}
