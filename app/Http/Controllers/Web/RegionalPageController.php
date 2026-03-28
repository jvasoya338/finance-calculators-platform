<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use App\Support\SeoData;
use Illuminate\View\View;

class RegionalPageController extends Controller
{
    public function show(string $region): View
    {
        $page = config("finance.regional_pages.{$region}");

        abort_unless($page, 404);

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => $page['title'], 'url' => route('regional.show', ['region' => $region])],
        ];

        $categories = collect($page['related_categories'])
            ->map(fn (string $slug) => CalculatorCatalog::findCategory($slug))
            ->filter()
            ->values();

        $featuredCalculators = collect($page['featured_calculators'])
            ->map(fn (string $slug) => CalculatorCatalog::find($slug))
            ->filter()
            ->values();

        return view('pages.regional.show', [
            'seo' => SeoData::forRegional($page, $breadcrumbs),
            'page' => $page,
            'breadcrumbs' => $breadcrumbs,
            'categories' => $categories,
            'featuredCalculators' => $featuredCalculators,
        ]);
    }
}
