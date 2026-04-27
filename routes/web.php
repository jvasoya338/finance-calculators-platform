<?php

use App\Http\Controllers\Web\CalculatorController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\GuideController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RegionalPageController;
use App\Http\Controllers\Web\SiteMapController;
use App\Http\Controllers\Web\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/calculators', [CalculatorController::class, 'index'])->name('calculators.index');
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
Route::get('/guides/{guide}', [GuideController::class, 'show'])
    ->whereIn('guide', array_keys(config('guides')))
    ->name('guides.show');
Route::get('/{region}', [RegionalPageController::class, 'show'])
    ->whereIn('region', array_keys(config('finance.regional_pages')))
    ->name('regional.show');

Route::get('/category/{category}', [CategoryController::class, 'show'])
    ->whereIn('category', array_keys(config('finance.categories')))
    ->name('categories.show');

Route::get('/about', [StaticPageController::class, 'show'])
    ->defaults('page', 'about')
    ->name('about');
Route::get('/contact', [StaticPageController::class, 'show'])
    ->defaults('page', 'contact')
    ->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/country', [CountryController::class, 'update'])->name('country.update');
Route::get('/privacy-policy', [StaticPageController::class, 'show'])
    ->defaults('page', 'privacy-policy')
    ->name('privacy');
Route::get('/terms-and-conditions', [StaticPageController::class, 'show'])
    ->defaults('page', 'terms-and-conditions')
    ->name('terms');
Route::get('/disclaimer', [StaticPageController::class, 'show'])
    ->defaults('page', 'disclaimer')
    ->name('disclaimer');
Route::get('/editorial-policy', [StaticPageController::class, 'show'])
    ->defaults('page', 'editorial-policy')
    ->name('editorial-policy');
Route::get('/calculation-methodology', [StaticPageController::class, 'show'])
    ->defaults('page', 'calculation-methodology')
    ->name('calculation-methodology');

Route::get('/sitemap.xml', SiteMapController::class)->name('sitemap');

Route::get('/{calculator}', [CalculatorController::class, 'show'])
    ->whereIn('calculator', array_keys(config('calculators')))
    ->name('calculators.show');
