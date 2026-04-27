<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CalculatorCatalog
{
    public static function all(): Collection
    {
        return collect(config('calculators'))
            ->map(fn (array $calculator) => self::enrichCalculator($calculator))
            ->sortBy('title')
            ->values();
    }

    public static function find(string $slug): ?array
    {
        $calculator = config("calculators.{$slug}");

        return $calculator ? self::enrichCalculator($calculator) : null;
    }

    public static function categories(): Collection
    {
        return collect(config('finance.categories'))
            ->map(function (array $category) {
                $category['calculator_count'] = self::forCategory($category['slug'])->count();

                return $category;
            })
            ->values();
    }

    public static function findCategory(string $slug): ?array
    {
        $category = config("finance.categories.{$slug}");

        if (! $category) {
            return null;
        }

        $category['calculators'] = self::forCategory($slug)->values()->all();
        $category['calculator_count'] = count($category['calculators']);

        return $category;
    }

    public static function forCategory(string $slug): Collection
    {
        return self::indexable()
            ->filter(fn (array $calculator) => $calculator['category'] === $slug)
            ->values();
    }

    public static function featured(int $limit = 6): Collection
    {
        return self::indexable()
            ->filter(fn (array $calculator) => Arr::get($calculator, 'featured'))
            ->take($limit)
            ->values();
    }

    public static function indexable(): Collection
    {
        return self::all()
            ->filter(fn (array $calculator) => $calculator['indexable'] ?? true)
            ->values();
    }

    public static function popular(int $limit = 8): Collection
    {
        return self::indexable()
            ->filter(fn (array $calculator) => Arr::get($calculator, 'popular'))
            ->take($limit)
            ->values();
    }

    public static function recent(int $limit = 6): Collection
    {
        return self::indexable()
            ->sortByDesc(fn (array $calculator) => array_search($calculator['slug'], array_keys(config('calculators')), true))
            ->take($limit)
            ->values();
    }

    public static function related(array $calculator): Collection
    {
        return collect($calculator['related'] ?? [])
            ->map(fn (string $slug) => self::find($slug))
            ->filter(fn (?array $item) => $item && ($item['indexable'] ?? true))
            ->values();
    }

    protected static function enrichCalculator(array $calculator): array
    {
        $category = config('finance.categories.'.$calculator['category']);

        $calculator['url'] = route('calculators.show', ['calculator' => $calculator['slug']], false);
        $calculator['route_name'] = 'calculators.show';
        $calculator['category_name'] = $category['name'] ?? 'Calculators';
        $calculator['category_url'] = route('categories.show', ['category' => $calculator['category']], false);
        $calculator['indexable'] = $calculator['indexable'] ?? true;

        return $calculator;
    }
}
