@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="grid gap-8 lg:grid-cols-[0.9fr,1.1fr] lg:items-end">
            <div>
                <p class="eyebrow">Guides library</p>
                <h1 class="section-title mt-4">Finance guides and regional planning resources</h1>
                <p class="section-copy mt-4">
                    Explore finance education topics, regional planning hubs, and practical money guidance designed to support calculator journeys with stronger context.
                </p>
            </div>
            <div class="surface-panel p-6 sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">What this library covers</h2>
                <ul class="mt-6 space-y-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    <li>Mortgage affordability explainers and repayment strategy content.</li>
                    <li>Investment planning guides tied to SIP, compound growth, and retirement tools.</li>
                    <li>Tax and salary explainers that branch into country-specific variants for the U.S., UK, India, and Europe.</li>
                    <li>Budgeting frameworks, debt payoff strategies, and credit health content.</li>
                </ul>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="surface-panel p-6 transition hover:border-[rgba(31,174,75,0.45)]">
                <p class="eyebrow">Regional SEO page</p>
                <h2 class="mt-3 text-2xl font-semibold text-[#0B2A4A]">India finance tools</h2>
                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">A focused landing page for EMI, SIP, GST, salary, and practical money-planning searches in India.</p>
            </a>
            <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="surface-panel p-6 transition hover:border-[rgba(31,78,140,0.45)]">
                <p class="eyebrow">Regional SEO page</p>
                <h2 class="mt-3 text-2xl font-semibold text-[#0B2A4A]">UK finance tools</h2>
                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">A dedicated landing page for UK mortgage, salary, tax, savings, and debt planning searches.</p>
            </a>
            <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="surface-panel p-6 transition hover:border-[rgba(31,78,140,0.45)]">
                <p class="eyebrow">Regional SEO page</p>
                <h2 class="mt-3 text-2xl font-semibold text-[#0B2A4A]">US finance tools</h2>
                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">A dedicated landing page for U.S.-focused mortgage, tax, salary, and debt planning searches.</p>
            </a>
            <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="surface-panel p-6 transition hover:border-[rgba(31,174,75,0.45)]">
                <p class="eyebrow">Regional SEO page</p>
                <h2 class="mt-3 text-2xl font-semibold text-[#0B2A4A]">EU finance tools</h2>
                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">A dedicated landing page for VAT, salary, savings, mortgage, and budgeting searches across Europe.</p>
            </a>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($guides as $guide)
                <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="surface-panel p-6 transition hover:border-[rgba(31,78,140,0.35)] hover:bg-[rgba(31,78,140,0.02)]">
                    <p class="eyebrow">Guide article</p>
                    <h2 class="mt-3 text-2xl font-semibold text-[#0B2A4A]">{{ $guide['title'] }}</h2>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $guide['meta_description'] }}</p>
                    <span class="mt-5 inline-flex items-center text-sm font-semibold text-[#1F4E8C]">Read guide →</span>
                </a>
            @endforeach
        </div>
    </section>
@endsection
