<?php

namespace App\Providers;

use App\Support\CalculatorCatalog;
use App\Support\CountryContext;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $countryContext = app(CountryContext::class);

            $view->with('siteBrand', config('finance.brand'));
            $view->with('siteCategories', CalculatorCatalog::categories());
            $view->with('siteFeaturedCalculators', CalculatorCatalog::featured(5));
            $view->with('siteCountry', $countryContext->current());
            $view->with('siteCountries', $countryContext->all());
            $view->with('siteCountryMode', $countryContext->mode());
        });
    }
}
