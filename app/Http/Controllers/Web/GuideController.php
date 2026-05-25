<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use App\Support\GuideEditorial;
use App\Support\SeoData;
use Illuminate\View\View;

class GuideController extends Controller
{
    public function index(): View
    {
        return view('pages.guides.index', [
            'seo' => SeoData::base([
                'title' => 'Finance Guides, US Finance Pages & EU Money Planning | FinguruTools',
                'description' => 'Explore finance guides and regional hubs from FinguruTools covering loans, budgeting, investing, salary planning, and practical money decisions.',
                'canonical' => route('guides.index'),
            ]),
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Guides', 'url' => route('guides.index')],
            ],
            'guides' => collect(config('guides'))->values(),
        ]);
    }

    public function show(string $guide): View
    {
        $page = config("guides.{$guide}");

        abort_unless($page, 404);

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Guides', 'url' => route('guides.index')],
            ['label' => $page['title'], 'url' => route('guides.show', ['guide' => $guide])],
        ];

        $relatedCalculators = collect($page['related_calculators'] ?? [])
            ->map(fn (string $slug) => CalculatorCatalog::find($slug))
            ->filter()
            ->values();
        $editorial = GuideEditorial::forGuide($page);
        $metadata = GuideEditorial::metadata($page);
        $faqs = array_merge($page['faqs'] ?? [], $editorial['extra_faqs'] ?? []);

        return view('pages.guides.show', [
            'seo' => SeoData::base([
                'title' => $page['meta_title'],
                'description' => $page['meta_description'],
                'canonical' => route('guides.show', ['guide' => $guide]),
                'json_ld' => [
                    SeoData::websiteSchema(),
                    SeoData::breadcrumbSchema($breadcrumbs),
                    SeoData::articleSchema($page, $metadata),
                    SeoData::faqSchema($faqs),
                ],
            ]),
            'page' => $page,
            'editorial' => $editorial,
            'metadata' => $metadata,
            'faqs' => $faqs,
            'breadcrumbs' => $breadcrumbs,
            'relatedCalculators' => $relatedCalculators,
        ]);
    }
}
