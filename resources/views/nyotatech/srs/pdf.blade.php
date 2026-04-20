<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $spec->title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        h2 { font-size: 14px; margin: 16px 0 8px; }
        .muted { color: #555; }
        .box { border: 1px solid #ddd; padding: 10px; border-radius: 6px; margin-top: 10px; }
    </style>
</head>
<body>
<h1>{{ $spec->title }}</h1>
<div class="muted">Software Requirements Specification · NyotaTech Business Suite</div>
@if($spec->product_name)
    <p><strong>Product:</strong> {{ $spec->product_name }}</p>
@endif
@if($spec->project)
    <p class="muted"><strong>Project:</strong> {{ $spec->project->name }}</p>
@endif
@if($spec->document)
    <p class="muted"><strong>Related technical document:</strong> {{ $spec->document->title }}</p>
@endif

<h2>1. Stakeholders</h2>
<div class="box">{!! nl2br(e($spec->stakeholders ?: '—')) !!}</div>

<h2>2. Functional requirements</h2>
<div class="box">{!! nl2br(e($spec->functional_requirements ?: '—')) !!}</div>

<h2>3. Non-functional requirements</h2>
<div class="box">{!! nl2br(e($spec->non_functional_requirements ?: '—')) !!}</div>

<h2>4. Assumptions &amp; constraints</h2>
<div class="box">{!! nl2br(e($spec->assumptions ?: '—')) !!}</div>

<p class="muted" style="margin-top: 18px;">Generated: {{ optional($spec->generated_at)->format('Y-m-d H:i') ?? now()->format('Y-m-d H:i') }}</p>
</body>
</html>
