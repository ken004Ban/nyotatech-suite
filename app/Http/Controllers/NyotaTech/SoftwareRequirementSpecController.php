<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Project;
use App\Models\SoftwareRequirementSpec;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SoftwareRequirementSpecController extends Controller
{
    private function rules(): array
    {
        return [
            'project_id' => ['nullable', 'exists:projects,id'],
            'document_id' => ['nullable', 'exists:documents,id'],
            'title' => ['required', 'string', 'max:255'],
            'product_name' => ['nullable', 'string', 'max:255'],
            'stakeholders' => ['nullable', 'string'],
            'functional_requirements' => ['nullable', 'string'],
            'non_functional_requirements' => ['nullable', 'string'],
            'assumptions' => ['nullable', 'string'],
        ];
    }

    public function index(): View
    {
        $specs = SoftwareRequirementSpec::query()
            ->with(['project', 'document'])
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.srs.index', compact('specs'));
    }

    public function create(): View
    {
        $projects = Project::query()->with('client')->orderBy('name')->get();
        $documents = Document::query()
            ->where('user_id', auth()->id())
            ->where('is_technical', true)
            ->orderByDesc('id')
            ->limit(100)
            ->get();

        return view('nyotatech.srs.create', compact('projects', 'documents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $data['generated_at'] = now();

        if (! empty($data['document_id'])) {
            $doc = Document::query()->findOrFail($data['document_id']);
            abort_unless($doc->user_id === $request->user()->id(), 403);
        }

        $spec = SoftwareRequirementSpec::create($data);

        return redirect()
            ->route('nyotatech.srs.show', $spec)
            ->with('success', 'SRS draft saved. You can export PDF when ready.');
    }

    public function show(SoftwareRequirementSpec $software_requirement_spec): View
    {
        $software_requirement_spec->load(['project.client', 'document']);

        return view('nyotatech.srs.show', ['spec' => $software_requirement_spec]);
    }

    public function downloadPdf(SoftwareRequirementSpec $software_requirement_spec)
    {
        $software_requirement_spec->load(['project.client', 'document']);

        $pdf = app('dompdf.wrapper')->loadView('nyotatech.srs.pdf', [
            'spec' => $software_requirement_spec,
        ]);

        $slug = \Illuminate\Support\Str::slug($software_requirement_spec->title ?: 'srs');

        return $pdf->download($slug.'-'.$software_requirement_spec->id.'.pdf');
    }
}
