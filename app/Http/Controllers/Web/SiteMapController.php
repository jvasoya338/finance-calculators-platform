<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use App\Support\GuideEditorial;
use Illuminate\Http\Response;

class SiteMapController extends Controller
{
    public function __invoke(): Response
    {
        $coreLastModified = '2026-07-18';
        $entry = fn (string $loc, string $lastmod, string $changefreq = 'monthly', string $priority = '0.6') => [
            'loc' => $loc,
            'lastmod' => $lastmod,
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];

        $urls = collect([
            $entry(route('home'), $coreLastModified, 'weekly', '1.0'),
            $entry(route('calculators.index'), $coreLastModified, 'weekly', '0.9'),
            $entry(route('guides.index'), $coreLastModified, 'weekly', '0.9'),
            $entry(route('about'), $coreLastModified, 'monthly', '0.5'),
            $entry(route('contact'), $coreLastModified, 'monthly', '0.4'),
            $entry(route('privacy'), $coreLastModified, 'yearly', '0.3'),
            $entry(route('terms'), $coreLastModified, 'yearly', '0.3'),
            $entry(route('disclaimer'), $coreLastModified, 'yearly', '0.3'),
            $entry(route('editorial-policy'), $coreLastModified, 'monthly', '0.4'),
            $entry(route('calculation-methodology'), $coreLastModified, 'monthly', '0.5'),
        ])->merge(
            collect(config('guides'))->map(function (array $guide) use ($entry) {
                $metadata = GuideEditorial::metadata($guide);

                return $entry(route('guides.show', ['guide' => $guide['slug']]), $metadata['updated'], 'monthly', '0.7');
            })
        )->merge(
            collect(config('finance.regional_pages'))->map(fn (array $region) => $entry(route('regional.show', ['region' => $region['slug']]), '2026-07-18', 'weekly', '0.8'))
        )->merge(
            CalculatorCatalog::categories()->map(fn (array $category) => $entry(route('categories.show', ['category' => $category['slug']]), $coreLastModified, 'weekly', '0.7'))
        )->merge(
            CalculatorCatalog::indexable()->map(fn (array $calculator) => $entry(route('calculators.show', ['calculator' => $calculator['slug']]), $coreLastModified, 'monthly', '0.8'))
        )->values();

        return response()
            ->view('pages.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
