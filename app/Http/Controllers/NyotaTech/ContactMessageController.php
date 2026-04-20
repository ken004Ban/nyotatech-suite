<?php

namespace App\Http\Controllers\NyotaTech;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        return redirect()
            ->route('nyotatech.contact')
            ->with('success', 'Thanks — we received your message. This demo stores it in the session flash only.');
    }
}
