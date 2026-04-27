<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use Illuminate\Http\Response;

class SiteMapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect([
            route('home'),
            route('calculators.index'),
            route('guides.index'),
            route('about'),
            route('contact'),
            route('privacy'),
            route('terms'),
            route('disclaimer'),
            route('editorial-policy'),
            route('calculation-methodology'),
        ])->merge(
            collect(array_keys(config('guides')))->map(fn (string $guide) => route('guides.show', ['guide' => $guide]))
        )->merge(
            collect(array_keys(config('finance.regional_pages')))->map(fn (string $region) => route('regional.show', ['region' => $region]))
        )->merge(
            CalculatorCatalog::categories()->map(fn (array $category) => route('categories.show', ['category' => $category['slug']]))
        )->merge(
            CalculatorCatalog::indexable()->map(fn (array $calculator) => route('calculators.show', ['calculator' => $calculator['slug']]))
        )->values();

        return response()
            ->view('pages.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
