<?php

namespace Tests\Unit;

use App\Services\Calculators\CountryTaxService;
use Tests\TestCase;

class CountryTaxServiceTest extends TestCase
{
    public function test_country_specific_income_tax_models_return_country_labels(): void
    {
        $service = app(CountryTaxService::class);

        $us = $service->calculateIncomeTax('us', 90000, 5000, 'single');
        $uk = $service->calculateIncomeTax('uk', 90000, 0, 'single');
        $india = $service->calculateIncomeTax('in', 1800000, 150000, 'single');

        $this->assertSame('United States', $us['country']);
        $this->assertSame('United Kingdom', $uk['country']);
        $this->assertSame('India', $india['country']);
    }
}
