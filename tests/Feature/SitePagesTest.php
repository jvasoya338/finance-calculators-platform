<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitePagesTest extends TestCase
{
    public function test_home_page_loads_with_key_sections(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Premium finance tools for smarter everyday decisions.');
        $response->assertSee('Browse all calculators');
    }

    public function test_calculator_page_renders_results_for_valid_input(): void
    {
        $response = $this->get(route('calculators.show', [
            'calculator' => 'emi-calculator',
            'principal' => 100000,
            'rate' => 10,
            'tenure' => 10,
            'tenure_type' => 'years',
        ]));

        $response->assertOk();
        $response->assertSee('Results');
        $response->assertSee('Monthly payment');
    }

    public function test_geo_country_header_detects_india(): void
    {
        $response = $this->withHeader('X-Country-Code', 'IN')
            ->get(route('calculators.show', [
                'calculator' => 'emi-calculator',
                'principal' => 100000,
                'rate' => 10,
                'tenure' => 10,
                'tenure_type' => 'years',
            ]));

        $response->assertOk();
        $response->assertSee('India');
        $response->assertSee('INR', false);
    }

    public function test_default_country_falls_back_to_united_states_without_geo_signal(): void
    {
        $this
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Auto detect · US default')
            ->assertDontSee('selected>IN');
    }

    public function test_category_and_sitemap_pages_are_available(): void
    {
        $this->get(route('categories.show', ['category' => 'investment-calculators']))
            ->assertOk()
            ->assertSee('Investment calculators');

        $this->get(route('categories.show', ['category' => 'crypto-calculators']))
            ->assertOk()
            ->assertSee('Crypto calculators');

        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('content-type', 'application/xml')
            ->assertSee(route('calculators.show', ['calculator' => 'emi-calculator']), false)
            ->assertDontSee(route('calculators.show', ['calculator' => 'currency-converter']), false);
    }

    public function test_contact_page_renders_form(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('Send message')
            ->assertSee('Support email');
    }

    public function test_unknown_page_uses_custom_404_view(): void
    {
        $this->get('/this-page-does-not-exist')
            ->assertNotFound()
            ->assertSee('We could not find that page.');
    }

    public function test_regional_finance_pages_and_disclaimer_are_available(): void
    {
        $this->get(route('regional.show', ['region' => 'india-finance-tools']))
            ->assertOk()
            ->assertSee('India finance calculators and money planning tools');

        $this->get(route('regional.show', ['region' => 'uk-finance-tools']))
            ->assertOk()
            ->assertSee('UK finance calculators and planning pages');

        $this->get(route('regional.show', ['region' => 'us-finance-tools']))
            ->assertOk()
            ->assertSee('US finance calculators and planning tools');

        $this->get(route('regional.show', ['region' => 'eu-finance-tools']))
            ->assertOk()
            ->assertSee('EU finance calculators and money planning pages');

        $this->get(route('disclaimer'))
            ->assertOk()
            ->assertSee('Important disclaimer');

        $this->get(route('editorial-policy'))
            ->assertOk()
            ->assertSee('How FinguruTools creates finance content and keeps pages useful.');

        $this->get(route('calculation-methodology'))
            ->assertOk()
            ->assertSee('How FinguruTools approaches formulas, assumptions, and calculator results.');
    }

    public function test_guide_pages_are_available(): void
    {
        $this->get(route('guides.index'))
            ->assertOk()
            ->assertSee('Guide article');

        $this->get(route('guides.show', ['guide' => 'mortgage-offers']))
            ->assertOk()
            ->assertSee('How to compare mortgage offers without focusing on rate alone');

        $this->get(route('guides.show', ['guide' => 'choosing-loan-term']))
            ->assertOk()
            ->assertSee('How to choose the right loan term without focusing only on the monthly payment');

        $this->get(route('guides.show', ['guide' => 'bitcoin-dca-discipline']))
            ->assertOk()
            ->assertSee('How Bitcoin DCA helps reduce timing pressure in a volatile market');
    }

    public function test_overlapping_calculators_are_noindexed(): void
    {
        $this->get(route('calculators.show', ['calculator' => 'currency-converter']))
            ->assertOk()
            ->assertSee('noindex,follow', false);

        $this->get(route('calculators.show', ['calculator' => 'emi-calculator']))
            ->assertOk()
            ->assertSee('index,follow', false);
    }
}
