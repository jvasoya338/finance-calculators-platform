<?php

namespace App\Support;

use Illuminate\Http\Request;
use NumberFormatter;
use RuntimeException;

class CountryContext
{
    public function current(?Request $request = null): array
    {
        $request ??= request();

        $code = $this->resolveCountryCode($request);

        return config("countries.supported.{$code}", config('countries.supported.'.config('countries.default')));
    }

    public function all(): array
    {
        return array_values(config('countries.supported', []));
    }

    public function mode(?Request $request = null): string
    {
        $request ??= request();

        try {
            if ($request->hasSession()) {
                return $request->session()->get('country_mode', 'auto');
            }
        } catch (RuntimeException) {
            //
        }

        return 'auto';
    }

    public function resolveCountryCode(?Request $request = null): string
    {
        $request ??= request();

        $requested = strtolower((string) $request->query('country'));

        if (isset(config('countries.supported')[$requested])) {
            return $requested;
        }

        $sessionCountry = null;
        $mode = 'auto';

        try {
            if ($request->hasSession()) {
                $sessionCountry = strtolower((string) $request->session()->get('country'));
                $mode = $request->session()->get('country_mode', 'auto');
            }
        } catch (RuntimeException) {
            $sessionCountry = null;
            $mode = 'auto';
        }

        if ($mode === 'manual' && isset(config('countries.supported')[$sessionCountry])) {
            return $sessionCountry;
        }

        $headerCountry = strtoupper((string) ($request->header('CF-IPCountry')
            ?: $request->header('X-Country-Code')
            ?: $request->server('GEOIP_COUNTRY_CODE')
            ?: ''));

        if ($headerCountry !== '') {
            return config("countries.region_map.{$headerCountry}", config('countries.default'));
        }

        return config('countries.default', 'us');
    }

    public function formatCurrency(float $amount, ?string $countryCode = null, bool $withCode = false): string
    {
        $country = $countryCode
            ? config("countries.supported.{$countryCode}", $this->current())
            : $this->current();

        if (class_exists(NumberFormatter::class)) {
            $formatter = new NumberFormatter($country['locale'], NumberFormatter::CURRENCY);
            $formatted = $formatter->formatCurrency($amount, $country['currency']);

            if ($formatted !== false) {
                return $withCode ? $formatted.' '.$country['currency'] : $formatted;
            }
        }

        $fallback = $country['symbol'].number_format($amount, 2);

        return $withCode ? $fallback.' '.$country['currency'] : $fallback;
    }
}
