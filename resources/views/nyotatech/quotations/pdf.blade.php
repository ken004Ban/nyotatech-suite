<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Quotation {{ $quotation->number }}</title>
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
<h1>Quotation {{ $quotation->number }}</h1>
<div class="muted">NyotaTech Business Suite</div>

<table>
    <tr>
        <td>
            <div class="box">
                <div><strong>Client</strong></div>
                <div>{{ $quotation->client->company_name }}</div>
                @if($quotation->client->email)<div class="muted">{{ $quotation->client->email }}</div>@endif
            </div>
        </td>
        <td class="right">
            <div><strong>Status:</strong> {{ $quotation->status }}</div>
            @if($quotation->issued_at)<div><strong>Issued:</strong> {{ $quotation->issued_at->format('Y-m-d') }}</div>@endif
            @if($quotation->valid_until)<div><strong>Valid until:</strong> {{ $quotation->valid_until->format('Y-m-d') }}</div>@endif
        </td>
    </tr>
</table>

@if($quotation->project)
    <p class="muted" style="margin-top: 10px;"><strong>Project:</strong> {{ $quotation->project->name }}</p>
@endif

@if($quotation->notes)
    <h2 style="font-size: 14px; margin: 16px 0 6px;">Notes</h2>
    <div>{!! nl2br(e($quotation->notes)) !!}</div>
@endif

<h2 style="font-size: 14px; margin: 16px 0 6px;">Totals</h2>
<table>
    <tr><td>Subtotal</td><td class="right">{{ $quotation->currency }} {{ number_format((float) $quotation->subtotal, 2) }}</td></tr>
    <tr><td>Tax ({{ $quotation->tax_rate }}%)</td><td class="right">{{ $quotation->currency }} {{ number_format((float) $quotation->tax_amount, 2) }}</td></tr>
    <tr><td><strong>Total</strong></td><td class="right"><strong>{{ $quotation->currency }} {{ number_format((float) $quotation->total, 2) }}</strong></td></tr>
</table>
</body>
</html>
