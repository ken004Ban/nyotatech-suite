<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 8px; }
        .muted { color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        td { padding: 6px 0; vertical-align: top; }
        .right { text-align: right; }
        .box { border: 1px solid #ddd; padding: 10px; border-radius: 6px; }
    </style>
</head>
<body>
<h1>Invoice {{ $invoice->number }}</h1>
<div class="muted">NyotaTech Business Suite</div>

<table>
    <tr>
        <td>
            <div class="box">
                <div><strong>Bill to</strong></div>
                <div>{{ $invoice->client->company_name }}</div>
                @if($invoice->client->email)<div class="muted">{{ $invoice->client->email }}</div>@endif
            </div>
        </td>
        <td class="right">
            <div><strong>Status:</strong> {{ $invoice->status }}</div>
            @if($invoice->issued_at)<div><strong>Issued:</strong> {{ $invoice->issued_at->format('Y-m-d') }}</div>@endif
            @if($invoice->due_at)<div><strong>Due:</strong> {{ $invoice->due_at->format('Y-m-d') }}</div>@endif
        </td>
    </tr>
</table>

@if($invoice->quotation)
    <p class="muted" style="margin-top: 10px;"><strong>Quotation:</strong> {{ $invoice->quotation->number }}</p>
@endif
@if($invoice->project)
    <p class="muted" style="margin-top: 6px;"><strong>Project:</strong> {{ $invoice->project->name }}</p>
@endif

@if($invoice->notes)
    <h2 style="font-size: 14px; margin: 16px 0 6px;">Notes</h2>
    <div>{!! nl2br(e($invoice->notes)) !!}</div>
@endif

<h2 style="font-size: 14px; margin: 16px 0 6px;">Totals</h2>
<table>
    <tr><td>Subtotal</td><td class="right">{{ $invoice->currency }} {{ number_format((float) $invoice->subtotal, 2) }}</td></tr>
    <tr><td>Tax ({{ $invoice->tax_rate }}%)</td><td class="right">{{ $invoice->currency }} {{ number_format((float) $invoice->tax_amount, 2) }}</td></tr>
    <tr><td><strong>Total</strong></td><td class="right"><strong>{{ $invoice->currency }} {{ number_format((float) $invoice->total, 2) }}</strong></td></tr>
</table>
</body>
</html>
