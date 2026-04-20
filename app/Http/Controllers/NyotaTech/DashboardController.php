<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('nyotatech.dashboard', [
            'clientCount' => Client::query()->count(),
            'projectCount' => Project::query()->count(),
            'openInvoiceCount' => Invoice::query()->where('status', '!=', 'paid')->count(),
            'quotationCount' => Quotation::query()->count(),
        ]);
    }
}
