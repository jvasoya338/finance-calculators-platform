<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectCanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        $canonical = parse_url(config('app.url'), PHP_URL_HOST);
        $host = $request->getHost();

        if ($canonical && $host !== $canonical && preg_replace('/^www\./', '', $host) === $canonical) {
            $target = rtrim(config('app.url'), '/').$request->getRequestUri();

            return redirect()->away($target, 301);
        }

        return $next($request);
    }
}
