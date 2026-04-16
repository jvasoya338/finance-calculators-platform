<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use App\Support\CalculatorEditorial;
use App\Support\SeoData;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $category): View
    {
        $page = CalculatorCatalog::findCategory($category);

        abort_unless($page, 404);

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Calculators', 'url' => route('calculators.index')],
            ['label' => $page['name'], 'url' => route('categories.show', ['category' => $page['slug']])],
        ];

        return view('pages.calculators.category', [
            'seo' => SeoData::forCategory($page, $breadcrumbs),
            'category' => $page,
            'editorial' => CalculatorEditorial::forCategory($page),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
