@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="grid gap-8 lg:grid-cols-[0.8fr,1.2fr] lg:items-end">
            <div>
                <p class="eyebrow">All calculators</p>
                <h1 class="section-title mt-4">Explore the full finance tools library</h1>
                <p class="section-copy mt-4">
                    Browse loan, investment, tax, salary, credit, and budgeting calculators built with a reusable page and SEO architecture.
                </p>
            </div>
            <div class="surface-panel p-5 sm:p-6">
                <div class="grid gap-4 sm:grid-cols-[1fr,240px]">
                    <label class="space-y-2">
                        <span class="text-sm font-semibold text-[#0B2A4A]">Search calculators</span>
                        <input type="search" class="form-input" placeholder="Search EMI, SIP, salary, mortgage..." data-calculator-search>
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
    </section>
@endsection
