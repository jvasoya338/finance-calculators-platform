<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo.head :seo="$seo ?? []" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-R8LF3P9Z37"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-R8LF3P9Z37');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9988246089680161" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="{{ asset('brand/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('brand/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|space-grotesk:500,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-50/50 text-slate-900 antialiased flex flex-col">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-[#1F4E8C] focus:px-4 focus:py-2 focus:text-white focus:shadow-md">
        Skip to main content
    </a>

    @include('partials.header')

    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
