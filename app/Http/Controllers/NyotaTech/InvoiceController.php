<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    private function rules(?Invoice $invoice = null): array
    {
        return [
            'quotation_id' => ['nullable', 'exists:quotations,id'],
            'client_id' => ['required', 'exists:clients,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('invoices', 'number')->ignore($invoice?->id),
            ],
            'status' => ['required', Rule::in(['draft', 'sent', 'partial', 'paid', 'overdue', 'void'])],
            'issued_at' => ['nullable', 'date'],
            'due_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'currency' => ['nullable', 'string', 'max:8'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'line_items' => ['nullable', 'array'],
            'line_items.*.description' => ['required_with:line_items', 'string', 'max:255'],
            'line_items.*.quantity' => ['required_with:line_items', 'numeric', 'min:0'],
            'line_items.*.unit_price' => ['required_with:line_items', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }

    private function applyTotals(array &$data): void
    {
        $subtotal = (float) $data['subtotal'];
        $rate = (float) $data['tax_rate'];
        $data['tax_amount'] = round($subtotal * ($rate / 100), 2);
        $data['total'] = round($subtotal + $data['tax_amount'], 2);

        if (! empty($data['line_items']) && is_array($data['line_items'])) {
            foreach ($data['line_items'] as &$row) {
                $row['amount'] = round(((float) $row['quantity']) * ((float) $row['unit_price']), 2);
            }
            unset($row);
        }
    }

    public function index(): View
    {
        $invoices = Invoice::query()
            ->with(['client', 'project', 'quotation'])
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.invoices.index', compact('invoices'));
    }

    public function create(Request $request): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $projects = Project::query()->with('client')->orderBy('name')->get();
        $quotations = Quotation::query()->with('client')->orderByDesc('id')->limit(100)->get();

        $prefillQuotation = null;
        if ($request->filled('quotation_id')) {
            $prefillQuotation = Quotation::query()->find($request->integer('quotation_id'));
        }

        return view('nyotatech.invoices.create', compact('clients', 'projects', 'quotations', 'prefillQuotation'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $this->applyTotals($data);

        $invoice = Invoice::create($data);

        return redirect()
            ->route('nyotatech.invoices.show', $invoice)
            ->with('success', 'Invoice saved.');
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['client', 'project', 'quotation', 'receipts']);

        return view('nyotatech.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $projects = Project::query()->with('client')->orderBy('name')->get();
        $quotations = Quotation::query()->with('client')->orderByDesc('id')->limit(100)->get();

        return view('nyotatech.invoices.edit', compact('invoice', 'clients', 'projects', 'quotations'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $request->validate($this->rules($invoice));
        $this->applyTotals($data);

        $invoice->update($data);

        return redirect()
            ->route('nyotatech.invoices.show', $invoice)
            ->with('success', 'Invoice updated.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['client', 'project', 'quotation']);

        $pdf = app('dompdf.wrapper')->loadView('nyotatech.invoices.pdf', [
            'invoice' => $invoice,
        ]);

        return $pdf->download('invoice-'.$invoice->number.'.pdf');
    }
}
