<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\SeoData;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function show(string $page): View
    {
        $content = config("finance.static_pages.{$page}");

        abort_unless($content, 404);

        $routeName = match ($page) {
            'about' => 'about',
            'contact' => 'contact',
            'privacy-policy' => 'privacy',
            'terms-and-conditions' => 'terms',
            'disclaimer' => 'disclaimer',
        };

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => $content['title'], 'url' => route($routeName)],
        ];

        return view('pages.static.show', [
            'seo' => SeoData::forStatic($content, $routeName, $breadcrumbs),
            'page' => $content,
            'breadcrumbs' => $breadcrumbs,
            'pageKey' => $page,
        ]);
    }
}
