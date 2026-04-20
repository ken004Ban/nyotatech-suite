<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QuotationController extends Controller
{
    private function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'number' => ['required', 'string', 'max:50', 'unique:quotations,number'],
            'status' => ['required', Rule::in(['draft', 'sent', 'accepted', 'rejected', 'expired'])],
            'issued_at' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:issued_at'],
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
        $quotations = Quotation::query()
            ->with(['client', 'project'])
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.quotations.index', compact('quotations'));
    }

    public function create(Request $request): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $projects = Project::query()->with('client')->orderBy('name')->get();
        $selectedClientId = $request->integer('client_id') ?: null;
        $selectedProjectId = $request->integer('project_id') ?: null;

        return view('nyotatech.quotations.create', compact('clients', 'projects', 'selectedClientId', 'selectedProjectId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $this->applyTotals($data);

        $quotation = Quotation::create($data);

        return redirect()
            ->route('nyotatech.quotations.show', $quotation)
            ->with('success', 'Quotation saved.');
    }

    public function show(Quotation $quotation): View
    {
        $quotation->load(['client', 'project']);

        return view('nyotatech.quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $projects = Project::query()->with('client')->orderBy('name')->get();

        return view('nyotatech.quotations.edit', compact('quotation', 'clients', 'projects'));
    }

    public function update(Request $request, Quotation $quotation): RedirectResponse
    {
        $rules = $this->rules();
        $rules['number'] = ['required', 'string', 'max:50', Rule::unique('quotations', 'number')->ignore($quotation->id)];

        $data = $request->validate($rules);
        $this->applyTotals($data);

        $quotation->update($data);

        return redirect()
            ->route('nyotatech.quotations.show', $quotation)
            ->with('success', 'Quotation updated.');
    }

    public function downloadPdf(Quotation $quotation)
    {
        $quotation->load(['client', 'project']);

        $pdf = app('dompdf.wrapper')->loadView('nyotatech.quotations.pdf', [
            'quotation' => $quotation,
        ]);

        return $pdf->download('quotation-'.$quotation->number.'.pdf');
    }
}
