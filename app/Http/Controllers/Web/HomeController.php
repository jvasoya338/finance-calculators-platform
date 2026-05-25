<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Calculators\CalculatorService;
use App\Support\CalculatorCatalog;
use App\Support\CountryContext;
use App\Support\SeoData;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function __invoke(CalculatorService $calculatorService, CountryContext $countryContext)
    {
        $featuredEmiPayload = [
            'principal' => 2500000,
            'rate' => 8.5,
            'tenure' => 20,
            'tenure_type' => 'years',
        ];
        $featuredEmiResult = $calculatorService->calculate('emi-calculator', $featuredEmiPayload);
        $allCalculators = CalculatorCatalog::indexable();
        $guidePreviews = collect(config('guides'))
            ->only(['monthly-budget-framework', 'compounding-time-horizons', 'debt-payoff-strategy'])
            ->values();

        return view('pages.home', [
            'seo' => SeoData::forHome(),
            'categories' => CalculatorCatalog::categories(),
            'featuredCalculators' => CalculatorCatalog::featured(),
            'popularCalculators' => CalculatorCatalog::popular(),
            'recentCalculators' => CalculatorCatalog::recent(),
            'calculatorCount' => $allCalculators->count(),
            'guideCount' => count(config('guides')),
            'guidePreviews' => $guidePreviews,
            'featuredEmi' => [
                'monthly_payment' => Arr::get($featuredEmiResult, 'summary.0.value'),
                'total_interest' => Arr::get($featuredEmiResult, 'summary.1.value'),
                'total_repayment' => Arr::get($featuredEmiResult, 'summary.2.value'),
                'principal' => $countryContext->formatCurrency($featuredEmiPayload['principal']),
                'rate' => $featuredEmiPayload['rate'],
                'tenure' => $featuredEmiPayload['tenure'],
            ],
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
            ],
        ]);
    }
}
