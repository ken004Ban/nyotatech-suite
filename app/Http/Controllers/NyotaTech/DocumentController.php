<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'file' => ['required', 'file', 'max:10240'],
        ];
    }

    public function index(): View
    {
        $documents = Document::query()
            ->with(['client', 'project', 'uploader'])
            ->where('user_id', auth()->id())
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('nyotatech.documents.index', compact('documents'));
    }

    public function create(): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $projects = Project::query()->with('client')->orderBy('name')->get();

        return view('nyotatech.documents.create', compact('clients', 'projects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        $upload = $request->file('file');
        $path = $upload->store('nyotatech/documents', 'local');

        $document = Document::create([
            'user_id' => $request->user()->id,
            'client_id' => $validated['client_id'] ?? null,
            'project_id' => $validated['project_id'] ?? null,
            'title' => $validated['title'],
            'original_filename' => $upload->getClientOriginalName(),
            'stored_path' => $path,
            'mime_type' => $upload->getClientMimeType(),
            'size' => $upload->getSize(),
            'is_technical' => $request->boolean('is_technical'),
        ]);

        return redirect()
            ->route('nyotatech.documents.show', $document)
            ->with('success', 'Document uploaded.');
    }

    public function show(Document $document): View
    {
        $this->authorizeDocument($document);

        $document->load(['client', 'project']);

        return view('nyotatech.documents.show', compact('document'));
    }

    public function download(Document $document): StreamedResponse
    {
        $this->authorizeDocument($document);

        return Storage::disk('local')->download($document->stored_path, $document->original_filename);
    }

    private function authorizeDocument(Document $document): void
    {
        abort_unless($document->user_id === auth()->id(), 403);
    }
}
