@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        <div class="surface-panel p-8 text-center sm:p-12">
            <p class="eyebrow">Page not found</p>
            <h1 class="mt-4 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A] sm:text-6xl">We could not find that page.</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-[rgba(11,42,74,0.72)]">
                The page may have moved, the link may be outdated, or the address may be incorrect. You can return to the homepage or continue browsing the calculator library.
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3.5 text-sm font-semibold transition">
                    Go to homepage
                </a>
                <a href="{{ route('calculators.index') }}" class="inline-flex items-center justify-center rounded-full border border-[rgba(31,78,140,0.14)] bg-white px-6 py-3.5 text-sm font-semibold text-[#0B2A4A] transition hover:border-[rgba(31,78,140,0.3)] hover:bg-[rgba(31,78,140,0.04)]">
                    Browse calculators
                </a>
            </div>
        </div>
    </section>
@endsection
