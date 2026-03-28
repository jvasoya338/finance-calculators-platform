<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\CalculatorCatalog;
use App\Support\SeoData;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.home', [
            'seo' => SeoData::forHome(),
            'categories' => CalculatorCatalog::categories(),
            'featuredCalculators' => CalculatorCatalog::featured(),
            'popularCalculators' => CalculatorCatalog::popular(),
            'recentCalculators' => CalculatorCatalog::recent(),
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
            ],
        ]);
    }
}
