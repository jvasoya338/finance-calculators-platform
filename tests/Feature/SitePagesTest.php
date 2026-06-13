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
        $response->assertSee('People use FinguruTools for very different reasons.');
        $response->assertSee('EMI Calculator');
        $response->assertSee('Monthly EMI');
        $response->assertSee('Practical reading before bigger money decisions');
        $response->assertSee('Planning updates');
        $response->assertSee('Search all calculators');
        $response->assertSee('Open contact form');
        $response->assertSee('Reviewed formulas');
        $response->assertSee('Updated guide pages');
        $response->assertSee('/build/assets/', false);
        $response->assertDontSee('This section supports finance updates');
        $response->assertDontSee('1 tools');
        $response->assertDontSee('working finance calculators');
        $response->assertDontSee('mailto:', false);
        $response->assertDontSee('fingurutools@gmail.com');
    }

    public function test_production_build_assets_are_available_for_direct_deploys(): void
    {
        $manifest = public_path('build/manifest.json');

        $this->assertFileExists($manifest);

        $assets = json_decode(file_get_contents($manifest), true);

        $this->assertFileExists(public_path('build/'.$assets['resources/css/app.css']['file']));
        $this->assertFileExists(public_path('build/'.$assets['resources/js/app.js']['file']));
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

    public function test_default_country_falls_back_to_india_without_geo_signal(): void
    {
        $this
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Auto detect location')
            ->assertSee('India · INR')
            ->assertSee('₹', false);
    }

    public function test_www_host_redirects_to_canonical_domain(): void
    {
        $this
            ->get('https://www.fingurutools.com/')
            ->assertRedirect('https://fingurutools.com/');
    }

    public function test_robots_txt_points_to_absolute_sitemap_url(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertSee('Sitemap: https://fingurutools.com/sitemap.xml');
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
            ->assertSee('How to compare mortgage offers without focusing on rate alone')
            ->assertSee('By FinguruTools Finance Content Team')
            ->assertSee('Published March 28, 2026')
            ->assertSee('Updated May 25, 2026')
            ->assertSee('Article')
            ->assertSee('How we approach this topic')
            ->assertSee('Before you act on the result');

        $this->get(route('guides.show', ['guide' => 'choosing-loan-term']))
            ->assertOk()
            ->assertSee('How to choose the right loan term without focusing only on the monthly payment');

        $this->get(route('guides.show', ['guide' => 'bitcoin-dca-discipline']))
            ->assertOk()
            ->assertSee('How Bitcoin DCA helps reduce timing pressure in a volatile market');

        $this->get(route('guides.show', ['guide' => 'monthly-budget-framework']))
            ->assertOk()
            ->assertSee('Choose a framework that is simple enough to repeat')
            ->assertSee('Why this budgeting framework works in real life');
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

    public function test_about_page_has_stronger_team_and_trust_content(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Our process is intentionally practical.')
            ->assertSee('We also pay attention to trust signals that matter for finance content.')
            ->assertSee('That team includes people who think about calculators from multiple angles:')
            ->assertSee('Our aim over time is simple: make FinguruTools more useful with every revision.');
    }
}
