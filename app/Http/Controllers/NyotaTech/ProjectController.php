<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProjectController extends Controller
{
    private function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'active', 'on_hold', 'completed'])],
            'description' => ['nullable', 'string'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }

    public function index(): View
    {
        $projects = Project::query()
            ->with('client')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $selectedClientId = request()->integer('client_id') ?: null;

        return view('nyotatech.projects.create', compact('clients', 'selectedClientId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        $project = Project::create($validated);

        return redirect()
            ->route('nyotatech.projects.show', $project)
            ->with('success', 'Project created.');
    }

    public function show(Project $project): View
    {
        $project->load('client');

        return view('nyotatech.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $clients = Client::query()->orderBy('company_name')->get();

        return view('nyotatech.projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        $project->update($validated);

        return redirect()
            ->route('nyotatech.projects.show', $project)
            ->with('success', 'Project updated.');
    }
}
