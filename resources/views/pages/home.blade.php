@extends('layouts.app')

@section('content')
    <section class="hero-surface relative overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 py-18 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-[1.08fr,0.92fr]">
                <div>
                    <span class="inline-flex rounded-full border border-[rgba(31,78,140,0.3)] bg-[rgba(31,78,140,0.1)] px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.24em] text-[#1F4E8C]">
                        Worldwide finance calculators
                    </span>
                    <h1 class="mt-6 max-w-4xl font-display text-5xl font-semibold tracking-tight text-[#0B2A4A] sm:text-6xl">
                        Premium finance tools for smarter everyday decisions.
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-[rgba(11,42,74,0.78)]">
                        Explore polished calculators for mortgages, loans, investing, taxes, salaries, debt payoff, and budgeting on FinguruTools. Fast pages, clear explanations, and a product-quality experience on every screen.
                    </p>
                    <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('calculators.index') }}" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3.5 text-sm font-semibold shadow-[0_18px_50px_rgba(31,78,140,0.35)] transition">
                            Browse all calculators
                        </a>
                        <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="inline-flex items-center justify-center rounded-full border border-[rgba(31,78,140,0.16)] bg-white px-6 py-3.5 text-sm font-semibold text-[#0B2A4A] transition hover:border-[rgba(31,78,140,0.3)] hover:bg-[rgba(31,78,140,0.04)]">
                            Try the EMI calculator
                        </a>
                    </div>

                </div>

                <div class="relative">
                    <div class="absolute inset-0 rounded-[2rem] bg-gradient-to-br from-[rgba(31,78,140,0.35)] via-[rgba(11,42,74,0.25)] to-[rgba(31,174,75,0.18)] blur-3xl"></div>
                    <div class="relative rounded-[2rem] border border-[rgba(31,78,140,0.12)] bg-white p-6 shadow-[0_35px_100px_rgba(11,42,74,0.12)] backdrop-blur">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[rgba(11,42,74,0.56)]">Featured calculator</p>
                                <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Mortgage Calculator</h2>
                            </div>
                            <span class="rounded-full border border-[rgba(31,174,75,0.35)] bg-[rgba(31,174,75,0.12)] px-3 py-1 text-xs font-semibold text-[#1FAE4B]">Live</span>
                        </div>
                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                <p class="text-sm text-[rgba(11,42,74,0.56)]">Monthly mortgage</p>
                                <p class="mt-3 text-3xl font-semibold text-[#0B2A4A]">$2,259.67</p>
                                <p class="mt-2 text-sm text-[rgba(11,42,74,0.72)]">Based on a $360,000 financed amount over 30 years at 6.4%.</p>
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                    <p class="text-sm text-[rgba(11,42,74,0.56)]">Total repayment</p>
                                    <p class="mt-2 text-2xl font-semibold text-[#0B2A4A]">$813,481.20</p>
                                </div>
                                <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                    <p class="text-sm text-[rgba(11,42,74,0.56)]">Total interest</p>
                                    <p class="mt-2 text-2xl font-semibold text-[#0B2A4A]">$453,481.20</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('calculators.show', ['calculator' => 'mortgage-calculator']) }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-[#1F4E8C] hover:text-[#1FAE4B]">
                            Explore mortgage tools
                            <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="surface-panel p-6 sm:p-8">
            <div class="grid gap-6 lg:grid-cols-[1fr,1.3fr] lg:items-center">
                <div>
                    <p class="eyebrow">Find a calculator fast</p>
                    <h2 class="section-title mt-4">Search the calculator library</h2>
                    <p class="section-copy mt-4">
                        Start with popular tools or jump straight into the category that matches your next money decision.
                    </p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($popularCalculators->take(4) as $calculator)
                        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.05)]">
                            <p class="text-sm font-semibold text-[#0B2A4A]">{{ $calculator['title'] }}</p>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $calculator['short_description'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-6">
            <div>
                <p class="eyebrow">Categories</p>
                <h2 class="section-title mt-4">Browse by financial goal</h2>
            </div>
            <a href="{{ route('calculators.index') }}" class="hidden text-sm font-semibold text-[#1F4E8C] hover:text-[#1FAE4B] sm:inline-flex">View all tools</a>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', ['category' => $category['slug']]) }}" class="rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_18px_40px_rgba(11,42,74,0.05)] transition hover:-translate-y-1 hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.03)]">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#1F4E8C]">{{ $category['calculator_count'] }} tools</p>
                    <h3 class="mt-4 font-display text-2xl font-semibold text-[#0B2A4A]">{{ $category['name'] }}</h3>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $category['description'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <p class="eyebrow">Featured calculators</p>
                <h2 class="section-title mt-4">Popular tools with polished result views</h2>
                <div class="mt-8 grid gap-5 md:grid-cols-2">
                    @foreach($featuredCalculators as $calculator)
                        <x-calculator.card :calculator="$calculator" />
                    @endforeach
                </div>
            </div>
            <aside class="surface-panel p-6 sm:p-8">
                <p class="eyebrow">Why people use us</p>
                <h3 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">A trustworthy calculator experience.</h3>
                <ul class="mt-6 space-y-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    <li>Clear formulas and plain-language explanations under every result.</li>
                    <li>Fast mobile-first pages built to feel like a premium product, not a template farm.</li>
                    <li>Structured content and internal links designed for SEO growth and long-term scale.</li>
                    <li>Reusable calculator architecture that keeps the site maintainable as the library grows.</li>
                </ul>
                <div class="mt-8 rounded-3xl border border-dashed border-[rgba(31,78,140,0.18)] bg-[rgba(31,78,140,0.03)] p-5">
                    <p class="text-sm font-semibold text-[#0B2A4A]">Newsletter and updates</p>
                    <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">This section supports finance updates, product announcements, and subscriber-focused planning content.</p>
                </div>
            </aside>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="surface-panel p-6 sm:p-8">
            <div class="grid gap-8 lg:grid-cols-[0.95fr,1.05fr] lg:items-center">
                <div>
                    <p class="eyebrow">Trust and usability</p>
                    <h2 class="section-title mt-4">Built for global audiences, fast decisions, and long-term scale.</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">SEO-ready structure</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Clear category hubs, strong internal links, and informative calculator pages help users discover the right tool faster.</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">Reusable engine</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Consistent results, formulas, and navigation make it easier to move between loan, tax, investing, and budgeting decisions.</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">Mobile-first UI</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Every page is optimized for clarity, touch-friendly inputs, and reduced visual noise.</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">Global usability</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Country-aware defaults, broad finance language, and regional hubs make the platform easier to use across markets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1fr,1fr]">
            <div>
                <p class="eyebrow">Recently added</p>
                <h2 class="section-title mt-4">New calculators ready for continued expansion</h2>
                <div class="mt-8 space-y-4">
                    @foreach($recentCalculators as $calculator)
                        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="flex items-center justify-between rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white px-5 py-4 shadow-[0_16px_36px_rgba(11,42,74,0.05)] transition hover:border-[rgba(31,174,75,0.45)] hover:bg-[rgba(31,174,75,0.03)]">
                            <span class="font-medium text-[#0B2A4A]">{{ $calculator['title'] }}</span>
                            <span class="text-sm text-[rgba(11,42,74,0.56)]">{{ $calculator['category_name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="eyebrow">SEO intro</p>
                <h2 class="section-title mt-4">A finance resource built for both calculations and better decisions</h2>
                <p class="mt-5 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                    Good finance tools should do more than output a number. FinguruTools pairs calculations with plain-language explanations, related guides, regional hubs, and connected planning flows so people can understand what the result means before acting on it.
                </p>
                <div class="mt-8 rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_16px_36px_rgba(11,42,74,0.05)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">Frequently asked questions</h3>
                    <div class="mt-5 space-y-4">
                        <div class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-4">
                            <p class="font-semibold text-[#0B2A4A]">Are these calculators only for one country?</p>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">No. The site is written for a worldwide audience and uses flexible assumptions where local rules vary.</p>
                        </div>
                        <div class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-4">
                            <p class="font-semibold text-[#0B2A4A]">Do the pages explain the result, or only show numbers?</p>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">The platform combines formulas, FAQs, planning notes, related calculators, and deeper guide content so each tool is easier to use in real life.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium in-content sponsorship slot -->
@endsection
