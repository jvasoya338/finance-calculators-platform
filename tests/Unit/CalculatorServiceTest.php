<?php

namespace Tests\Unit;

use App\Services\Calculators\CalculatorService;
use App\Support\CountryContext;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function test_amortized_loan_results_include_expected_summary_labels(): void
    {
        $result = app(CalculatorService::class)->calculate('emi-calculator', [
            'principal' => 100000,
            'rate' => 12,
            'tenure' => 10,
            'tenure_type' => 'years',
        ]);

        $this->assertSame('Monthly payment', $result['summary'][0]['label']);
        $this->assertNotEmpty($result['summary'][0]['value']);
        $this->assertNotEmpty($result['chart']['segments']);
        $this->assertNotEmpty($result['schedule']['rows']);
    }

    public function test_sip_calculation_returns_maturity_value(): void
    {
        $country = app(CountryContext::class)->current();
        $result = app(CalculatorService::class)->calculate('sip-calculator', [
            'monthly_investment' => 500,
            'rate' => 10,
            'years' => 10,
        ]);

        $this->assertSame('Maturity value', $result['summary'][0]['label']);
        $this->assertStringContainsString($country['symbol'], $result['summary'][0]['value']);
    }
}
