<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo.head :seo="$seo ?? []" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9PKNCG7LHE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-9PKNCG7LHE');
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
<body class="min-h-screen bg-white text-[#0B2A4A] antialiased">
    <div class="page-shell">
        @include('partials.header')

        <main id="main-content" class="relative z-10">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
