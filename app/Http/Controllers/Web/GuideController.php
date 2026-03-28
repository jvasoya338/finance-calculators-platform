<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoData;
use Illuminate\View\View;

class GuideController extends Controller
{
    public function index(): View
    {
        return view('pages.guides.index', [
            'seo' => SeoData::base([
                'title' => 'Finance Guides, US Finance Pages & EU Money Planning | FinguruTools',
                'description' => 'Explore finance guides and regional landing pages from FinguruTools covering worldwide, U.S., and EU financial planning topics.',
                'canonical' => route('guides.index'),
            ]),
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Guides', 'url' => route('guides.index')],
            ],
        ]);
    }
}
