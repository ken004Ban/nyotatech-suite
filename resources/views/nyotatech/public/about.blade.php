@extends('nyotatech.layout_public')

@section('title', 'About — NyotaTech Business Suite')

@section('content')
    <h1 class="h3 mb-3">About</h1>
    <p class="text-secondary">
        NyotaTech Business Suite is a <strong>separate application tree</strong> generated alongside the existing Mystery Report project.
        It intentionally reuses the same Laravel + Blade + Bootstrap + SQLite + DomPDF conventions, while introducing authentication and a broader business module set.
    </p>
    <p class="text-secondary mb-0">
        This page is static Blade content; authenticated features live under <code>/app</code>.
    </p>
@endsection
