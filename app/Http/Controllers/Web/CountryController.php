<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'country' => ['required', 'in:auto,'.implode(',', array_keys(config('countries.supported')))],
        ]);

        if ($validated['country'] === 'auto') {
            $request->session()->forget('country');
            $request->session()->put('country_mode', 'auto');

            return back();
        }

        $request->session()->put('country', $validated['country']);
        $request->session()->put('country_mode', 'manual');

        return back();
    }
}
