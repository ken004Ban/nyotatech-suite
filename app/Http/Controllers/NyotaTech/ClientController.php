<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    private function rules(?Client $client = null): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address_line' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function index(): View
    {
        $clients = Client::query()
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('nyotatech.clients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        $client = Client::create($validated);

        return redirect()
            ->route('nyotatech.clients.show', $client)
            ->with('success', 'Client created.');
    }

    public function show(Client $client): View
    {
        return view('nyotatech.clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('nyotatech.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate($this->rules($client));

        $client->update($validated);

        return redirect()
            ->route('nyotatech.clients.show', $client)
            ->with('success', 'Client updated.');
    }
}
