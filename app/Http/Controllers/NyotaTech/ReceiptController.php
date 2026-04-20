<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Receipt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    private function rules(): array
    {
        return [
            'invoice_id' => ['required', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['required', 'date'],
            'payment_method' => ['nullable', 'string', 'max:100'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function index(): View
    {
        $receipts = Receipt::query()
            ->with('invoice.client')
            ->orderByDesc('paid_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.receipts.index', compact('receipts'));
    }

    public function create(Request $request): View
    {
        $invoices = Invoice::query()->with('client')->orderByDesc('id')->limit(200)->get();
        $selectedInvoiceId = $request->integer('invoice_id') ?: null;

        return view('nyotatech.receipts.create', compact('invoices', 'selectedInvoiceId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        $receipt = Receipt::create($validated);

        return redirect()
            ->route('nyotatech.receipts.show', $receipt)
            ->with('success', 'Receipt recorded.');
    }

    public function show(Receipt $receipt): View
    {
        $receipt->load('invoice.client');

        return view('nyotatech.receipts.show', compact('receipt'));
    }
}
