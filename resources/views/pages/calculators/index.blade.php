@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="grid gap-8 lg:grid-cols-[0.8fr,1.2fr] lg:items-end">
            <div>
                <p class="eyebrow">All calculators</p>
                <h1 class="section-title mt-4">Explore the full finance tools library</h1>
                <p class="section-copy mt-4">
                    Browse loan, investment, tax, salary, credit, and budgeting calculators with clear inputs, worked examples, and practical planning help.
                </p>
            </div>
            <div class="surface-panel p-5 sm:p-6">
                <div class="grid gap-4 sm:grid-cols-[1fr,240px]">
                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-[#0B2A4A]">Search calculators</span>
                        <input type="search" name="q" value="{{ $searchQuery ?? '' }}" class="form-input" placeholder="Search EMI, SIP, salary, mortgage..." data-calculator-search>
                    </label>
                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-[#0B2A4A]">Filter by category</span>
                        <select class="form-input" data-category-filter>
                            <option value="">All categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['slug'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3" data-calculator-grid>
            @foreach($calculators as $calculator)
                <x-calculator.card :calculator="$calculator" />
            @endforeach
        </div>

        <div class="mt-8 hidden rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-6 text-sm text-[rgba(11,42,74,0.72)]" data-empty-state>
            No calculators matched that search. Try a broader term or switch the category filter.
        </div>

        <section class="mt-12 surface-panel p-6 sm:p-8">
            <p class="eyebrow">Regional search paths</p>
            <h2 class="section-title mt-4">Popular calculator searches for the U.S., Europe, UK, and India</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.35)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">U.S. finance calculators</h3>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Mortgage calculator, income tax calculator, take-home pay, credit card payoff, loan payment, and monthly budget tools.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.35)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">Europe finance calculators</h3>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">VAT calculator, tax-inclusive pricing, salary planning, savings projection, mortgage estimate, and household budget tools.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.35)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">UK finance calculators</h3>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">UK mortgage planning, salary calculator, take-home pay estimates, budget planning, savings, and debt payoff workflows.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.35)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">India finance calculators</h3>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">EMI calculator, SIP calculator, GST calculator, take-home salary, FD, RD, loan affordability, and budget planning tools.</p>
                </a>
            </div>
        </section>
    </section>
@endsection
