<?php

namespace App\Support;

class SeoData
{
    public static function base(array $overrides = []): array
    {
        $brand = config('finance.brand');
        $title = $overrides['title'] ?? $brand['name'];
        $description = $overrides['description'] ?? $brand['description'];
        $canonical = $overrides['canonical'] ?? url()->current();

        return array_merge([
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'keywords' => [],
            'robots' => 'index,follow',
            'og_type' => 'website',
            'twitter_card' => 'summary_large_image',
            'json_ld' => [],
        ], $overrides);
    }

    public static function forCalculator(array $calculator, array $breadcrumbs = []): array
    {
        $profile = CalculatorEditorial::seoProfileForCalculator($calculator);
        $jsonLd = [
            self::websiteSchema(),
            self::breadcrumbSchema($breadcrumbs),
            self::calculatorSchema($calculator, $profile),
            self::faqSchema($calculator['faqs'] ?? []),
        ];

        return self::base([
            'title' => $profile['title'] ?? $calculator['meta_title'],
            'description' => $profile['description'] ?? $calculator['meta_description'],
            'keywords' => $profile['keywords'] ?? [],
            'canonical' => route('calculators.show', ['calculator' => $calculator['slug']]),
            'robots' => ($calculator['indexable'] ?? true) ? 'index,follow' : 'noindex,follow',
            'json_ld' => array_filter($jsonLd),
        ]);
    }

    public static function forCategory(array $category, array $breadcrumbs = []): array
    {
        $profile = CalculatorEditorial::seoProfileForCategory($category);

        return self::base([
            'title' => $profile['title'],
            'description' => $profile['description'],
            'keywords' => $profile['keywords'],
            'canonical' => route('categories.show', ['category' => $category['slug']]),
            'json_ld' => [
                self::websiteSchema(),
                self::breadcrumbSchema($breadcrumbs),
                self::categoryCollectionSchema($category, $profile),
            ],
        ]);
    }

    public static function forStatic(array $page, string $routeName, array $breadcrumbs = []): array
    {
        return self::base([
            'title' => $page['title'].' | FinguruTools',
            'description' => $page['description'],
            'canonical' => route($routeName),
            'json_ld' => [
                self::websiteSchema(),
                self::breadcrumbSchema($breadcrumbs),
            ],
        ]);
    }

    public static function forHome(): array
    {
        return self::base([
            'title' => 'Finance Calculators for US, Europe, UK & India | FinguruTools',
            'description' => 'Use finance calculators for U.S. mortgage, Europe VAT, UK salary, India EMI, income tax, loans, investments, debt payoff, and monthly budgeting.',
            'canonical' => route('home'),
            'keywords' => ['finance calculators', 'mortgage calculator us', 'vat calculator europe', 'salary calculator', 'budget calculator'],
            'json_ld' => [
                self::organizationSchema(),
                self::websiteSchema(),
            ],
        ]);
    }

    public static function forRegional(array $page, array $breadcrumbs = []): array
    {
        $regionalPages = config('finance.regional_pages', []);
        $alternates = collect($regionalPages)
            ->map(function (array $alternate) {
                return [
                    'hreflang' => $alternate['hreflang'] ?? 'en',
                    'href' => route('regional.show', ['region' => $alternate['slug']]),
                ];
            })
            ->values()
            ->all();

        $jsonLd = [
            self::websiteSchema(),
            self::breadcrumbSchema($breadcrumbs),
            self::collectionPageSchema($page),
            self::itemListSchema($page['featured_calculators'] ?? []),
            self::faqSchema($page['faqs'] ?? []),
        ];

        $alternates[] = [
            'hreflang' => 'x-default',
            'href' => route('regional.show', ['region' => 'us-finance-tools']),
        ];

        return self::base([
            'title' => $page['meta_title'],
            'description' => $page['meta_description'],
            'keywords' => $page['popular_searches'] ?? [],
            'canonical' => route('regional.show', ['region' => $page['slug']]),
            'alternates' => $alternates,
            'json_ld' => array_filter($jsonLd),
        ]);
    }

    public static function breadcrumbSchema(array $breadcrumbs): ?array
    {
        if (count($breadcrumbs) < 2) {
            return null;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect($breadcrumbs)->values()->map(function (array $crumb, int $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $crumb['label'],
                    'item' => $crumb['url'],
                ];
            })->all(),
        ];
    }

    public static function faqSchema(array $faqs): ?array
    {
        if ($faqs === []) {
            return null;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqs)->map(fn (array $faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ])->all(),
        ];
    }

    public static function collectionPageSchema(array $page): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $page['title'],
            'url' => route('regional.show', ['region' => $page['slug']]),
            'inLanguage' => $page['hreflang'] ?? 'en',
            'description' => $page['meta_description'] ?? $page['intro'] ?? config('finance.brand.description'),
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => config('finance.brand.name'),
                'url' => url('/'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('finance.brand.company', config('finance.brand.name')),
                'url' => config('finance.brand.website', url('/')),
            ],
            'audience' => [
                '@type' => 'Audience',
                'audienceType' => $page['title'].' visitors',
            ],
            'about' => collect($page['popular_searches'] ?? [])
                ->take(6)
                ->map(fn (string $topic) => ['@type' => 'Thing', 'name' => $topic])
                ->values()
                ->all(),
        ];
    }

    public static function itemListSchema(array $calculatorSlugs): ?array
    {
        if ($calculatorSlugs === []) {
            return null;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            'itemListElement' => collect($calculatorSlugs)->values()->map(function (string $slug, int $index) {
                $calculator = CalculatorCatalog::find($slug);

                if (! $calculator) {
                    return null;
                }

                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $calculator['title'],
                    'url' => route('calculators.show', ['calculator' => $calculator['slug']]),
                ];
            })->filter()->values()->all(),
        ];
    }

    public static function calculatorSchema(array $calculator, array $profile): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => $calculator['title'],
            'url' => route('calculators.show', ['calculator' => $calculator['slug']]),
            'description' => $profile['description'] ?? $calculator['meta_description'],
            'applicationCategory' => 'FinanceApplication',
            'operatingSystem' => 'Web',
            'isAccessibleForFree' => true,
            'keywords' => implode(', ', $profile['keywords'] ?? []),
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('finance.brand.company', config('finance.brand.name')),
                'url' => config('finance.brand.website', url('/')),
            ],
        ];
    }

    public static function categoryCollectionSchema(array $category, array $profile): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $profile['title'],
            'url' => route('categories.show', ['category' => $category['slug']]),
            'description' => $profile['description'],
            'keywords' => implode(', ', $profile['keywords'] ?? []),
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => config('finance.brand.name'),
                'url' => url('/'),
            ],
        ];
    }

    public static function articleSchema(array $page, array $metadata): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $page['headline'],
            'description' => $page['meta_description'],
            'datePublished' => $metadata['published'],
            'dateModified' => $metadata['updated'],
            'author' => [
                '@type' => 'Organization',
                'name' => $metadata['author_name'],
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('finance.brand.company', config('finance.brand.name')),
                'url' => config('finance.brand.website', url('/')),
            ],
            'mainEntityOfPage' => route('guides.show', ['guide' => $page['slug']]),
        ];
    }

    public static function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('finance.brand.name'),
            'url' => url('/'),
            'description' => config('finance.brand.description'),
        ];
    }

    public static function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('finance.brand.company', config('finance.brand.name')),
            'url' => config('finance.brand.website', url('/')),
            'description' => config('finance.brand.description'),
        ];
    }
}
