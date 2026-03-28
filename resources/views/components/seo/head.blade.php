@props(['seo' => []])

@php
    $title = $seo['title'] ?? config('app.name');
    $description = $seo['description'] ?? config('finance.brand.description');
    $canonical = $seo['canonical'] ?? url()->current();
    $image = $seo['image'] ?? asset('brand/social-preview.png');
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ $seo['robots'] ?? 'index,follow' }}">
<link rel="canonical" href="{{ $canonical }}">
@foreach(($seo['alternates'] ?? []) as $alternate)
    <link rel="alternate" hreflang="{{ $alternate['hreflang'] }}" href="{{ $alternate['href'] }}">
@endforeach
<meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ config('app.name') }} social preview">
<meta name="twitter:card" content="{{ $seo['twitter_card'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
@foreach(($seo['json_ld'] ?? []) as $schema)
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endforeach
