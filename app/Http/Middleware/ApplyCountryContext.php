<?php

namespace App\Http\Middleware;

use App\Support\CountryContext;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ApplyCountryContext
{
    public function __construct(
        protected CountryContext $countryContext
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $countryCode = $this->countryContext->resolveCountryCode($request);
        $country = config("countries.supported.{$countryCode}");

        App::setLocale($country['language'] ?? config('app.locale'));

        return $next($request);
    }
}
