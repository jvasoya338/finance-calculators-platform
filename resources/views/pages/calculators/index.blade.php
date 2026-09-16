@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between border-b border-slate-200 pb-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
                    Directory
                </span>
                <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                    Financial Calculators Library
                </h1>
                <p class="mt-2 text-sm leading-relaxed text-slate-600 sm:text-base">
                    Browse loans, investing, tax, salary, credit, and budgeting tools with transparent formulas, worked examples, and verified calculation models.
                </p>
            </div>

            <!-- Search & Filter Bar -->
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-xs lg:w-96">
                <div class="space-y-3">
                    <div>
                        <label for="calc-search" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Search</label>
                        <input id="calc-search" type="search" name="q" value="{{ $searchQuery ?? '' }}" class="form-input mt-1" placeholder="Filter by name or keyword..." data-calculator-search>
                    </div>
                    <div>
                        <label for="category-filter" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Category</label>
                        <select id="category-filter" class="form-input mt-1" data-category-filter>
                            <option value="">All Categories ({{ count($calculators) }})</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['slug'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calculators Grid -->
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" data-calculator-grid>
            @foreach($calculators as $calculator)
                <x-calculator.card :calculator="$calculator" />
            @endforeach
        </div>

        <div class="mt-8 hidden rounded-xl border border-slate-200 bg-white p-8 text-center text-sm text-slate-600" data-empty-state>
            No calculators matched your search criteria. Try clearing filters or using broader terms.
        </div>

        <!-- Regional Planning Links -->
        <div class="mt-14 border-t border-slate-200 pt-10">
            <h2 class="font-display text-xl font-bold text-slate-900">Dedicated Regional Financial Hubs</h2>
            <p class="mt-1 text-xs text-slate-500">Explore financial calculation tools calibrated to specific national tax and lending systems</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-white p-4.5 shadow-xs transition hover:border-[#1F4E8C]">
                    <span class="text-lg">🇺🇸</span>
                    <h3 class="mt-2 font-display text-sm font-bold text-slate-900 group-hover:text-[#1F4E8C]">U.S. finance calculators</h3>
                    <p class="mt-1 text-[11px] leading-relaxed text-slate-500">Mortgage APR, standard tax deductions, take-home pay, and debt payoff.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-white p-4.5 shadow-xs transition hover:border-[#1F4E8C]">
                    <span class="text-lg">🇬🇧</span>
                    <h3 class="mt-2 font-display text-sm font-bold text-slate-900 group-hover:text-[#1F4E8C]">UK finance calculators</h3>
                    <p class="mt-1 text-[11px] leading-relaxed text-slate-500">PAYE salary, UK mortgage payments, ISA savings, and council tax budgeting.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-white p-4.5 shadow-xs transition hover:border-[#1F4E8C]">
                    <span class="text-lg">🇮🇳</span>
                    <h3 class="mt-2 font-display text-sm font-bold text-slate-900 group-hover:text-[#1F4E8C]">India finance calculators</h3>
                    <p class="mt-1 text-[11px] leading-relaxed text-slate-500">EMI reducing balance, SIP mutual fund wealth, and GST calculation workflows.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-white p-4.5 shadow-xs transition hover:border-[#1F4E8C]">
                    <span class="text-lg">🇪🇺</span>
                    <h3 class="mt-2 font-display text-sm font-bold text-slate-900 group-hover:text-[#1F4E8C]">Europe finance calculators</h3>
                    <p class="mt-1 text-[11px] leading-relaxed text-slate-500">Standard European VAT, cross-border savings, and net salary calculations.</p>
                </a>
            </div>
        </div>
    </div>
@endsection
