<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculatorInputRequest;
use App\Services\Calculators\CalculatorService;
use App\Support\CalculatorCatalog;
use App\Support\CalculatorEditorial;
use App\Support\CountryContext;
use App\Support\SeoData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculatorController extends Controller
{
    public function index(Request $request): View
    {
        return view('pages.calculators.index', [
            'seo' => SeoData::base([
                'title' => 'All Finance Calculators | FinguruTools',
                'description' => 'Browse all loan, mortgage, investment, tax, salary, credit, and budgeting calculators on FinguruTools.',
                'canonical' => route('calculators.index'),
                'json_ld' => [SeoData::websiteSchema()],
            ]),
            'calculators' => CalculatorCatalog::all(),
            'categories' => CalculatorCatalog::categories(),
            'searchQuery' => trim((string) $request->query('q')),
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Calculators', 'url' => route('calculators.index')],
            ],
        ]);
    }

    public function show(
        CalculatorInputRequest $request,
        CalculatorService $calculatorService,
        CountryContext $countryContext,
        string $calculator
    ): View {
        $page = CalculatorCatalog::find($calculator);

        abort_unless($page, 404);

        $payload = $request->validatedPayload();
        $hasResult = $request->query() !== [];
        $result = $hasResult ? $calculatorService->calculate($calculator, $payload) : null;
        $examplePayload = collect($page['fields'])
            ->mapWithKeys(function (array $field, string $name) use ($countryContext) {
                $default = $field['default'] ?? null;

                if ($name === 'country') {
                    $default = $countryContext->current()['tax_model'] ?? $default;
                }

                return [$name => $default];
            })
            ->all();
        $exampleResult = $calculatorService->calculate($calculator, $examplePayload);

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Calculators', 'url' => route('calculators.index')],
            ['label' => $page['category_name'], 'url' => route('categories.show', ['category' => $page['category']])],
            ['label' => $page['title'], 'url' => route('calculators.show', ['calculator' => $page['slug']])],
        ];

        return view('pages.calculators.show', [
            'seo' => SeoData::forCalculator($page, $breadcrumbs),
            'calculator' => $page,
            'editorial' => CalculatorEditorial::forCalculator($page),
            'exampleResult' => $exampleResult,
            'formValues' => array_merge([
                'country' => $countryContext->current()['tax_model'] ?? null,
            ], $payload),
            'result' => $result,
            'relatedCalculators' => CalculatorCatalog::related($page),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
