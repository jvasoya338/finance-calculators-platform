@extends('layouts.app')

@section('content')
    <!-- Clean Hero Section -->
    <section class="border-b border-slate-200 bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-10 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
                        Free Financial Utility Platform
                    </span>
                    <h1 class="mt-4 font-display text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                        Financial calculators for clear everyday decisions.
                    </h1>
                    <p class="mt-4 text-base leading-relaxed text-slate-600 sm:text-lg">
                        Explore transparent calculators for loans, investments, taxes, salary, and budgeting on FinguruTools. Fast pages, clear explanations, and verified mathematical models on every screen.
                    </p>

                    <!-- Fast Search Form -->
                    <div class="mt-8">
                        <form method="GET" action="{{ route('calculators.index') }}" class="flex flex-col gap-2 sm:flex-row">
                            <label for="home-calculator-search" class="sr-only">Search calculators</label>
                            <input
                                id="home-calculator-search"
                                name="q"
                                type="search"
                                class="form-input text-sm"
                                placeholder="Search calculators (e.g. EMI, SIP, Salary, GST, Loan)..."
                            >
                            <button type="submit" class="btn-primary shrink-0 whitespace-nowrap">
                                Search all calculators
                            </button>
                        </form>
                        <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                            <span>Popular:</span>
                            <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="hover:text-[#1F4E8C] underline">EMI Calculator</a>
                            <span>·</span>
                            <a href="{{ route('calculators.show', ['calculator' => 'sip-calculator']) }}" class="hover:text-[#1F4E8C] underline">SIP Calculator</a>
                            <span>·</span>
                            <a href="{{ route('calculators.show', ['calculator' => 'compound-interest-calculator']) }}" class="hover:text-[#1F4E8C] underline">Compound Interest</a>
                            <span>·</span>
                            <a href="{{ route('calculators.show', ['calculator' => 'salary-calculator']) }}" class="hover:text-[#1F4E8C] underline">Salary</a>
                        </div>
                    </div>
                </div>

                <!-- Featured Interactive Tool Snapshot -->
                <div class="lg:col-span-5">
                    <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-6 shadow-xs">
                        <div class="flex items-center justify-between border-b border-slate-200/80 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-600">Featured Tool</span>
                            </div>
                            <span class="rounded bg-white px-2 py-0.5 text-[11px] font-semibold text-slate-700 border border-slate-200">Fixed-Rate</span>
                        </div>

                        <div class="mt-4">
                            <h2 class="font-display text-xl font-bold text-slate-900">EMI Calculator</h2>
                            <p class="mt-1 text-xs text-slate-500">Example: {{ $featuredEmi['principal'] }} loan over {{ $featuredEmi['tenure'] }} years at {{ $featuredEmi['rate'] }}%</p>
                            
                            <div class="mt-4 rounded-lg border border-slate-200 bg-white p-4">
                                <p class="text-xs font-medium text-slate-500">Monthly EMI</p>
                                <p class="mt-1 font-display text-2xl font-extrabold text-[#1F4E8C]">{{ $featuredEmi['monthly_payment'] }}</p>
                            </div>

                            <div class="mt-3 grid grid-cols-2 gap-3 text-xs">
                                <div class="rounded-lg border border-slate-200 bg-white p-3">
                                    <span class="text-slate-500">Total Interest</span>
                                    <p class="mt-1 font-semibold text-slate-900">{{ $featuredEmi['total_interest'] }}</p>
                                </div>
                                <div class="rounded-lg border border-slate-200 bg-white p-3">
                                    <span class="text-slate-500">Total Repayment</span>
                                    <p class="mt-1 font-semibold text-slate-900">{{ $featuredEmi['total_repayment'] }}</p>
                                </div>
                            </div>

                            <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="btn-primary mt-4 w-full text-xs">
                                Open EMI Calculator →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Financial Calculators -->
    <section class="py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <p class="eyebrow">Most Popular</p>
                    <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">Popular Financial Calculators</h2>
                </div>
                <a href="{{ route('calculators.index') }}" class="text-xs font-semibold text-[#1F4E8C] hover:underline">
                    Browse all {{ count(config('calculators')) }} calculators →
                </a>
            </div>

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredCalculators as $calculator)
                    <x-calculator.card :calculator="$calculator" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- How FinGuruTools Works (3 Simple Steps) -->
    <section class="border-y border-slate-200 bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="eyebrow">Transparency</p>
                <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">How FinGuruTools Works</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">
                    We combine tested mathematical formulas with plain-language explanations so you understand the result before making commitments.
                </p>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-6">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-[#1F4E8C] text-xs font-bold text-white">1</span>
                    <h3 class="mt-4 font-display text-base font-bold text-slate-900">Enter your numbers</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-600">
                        Input loan amounts, interest rates, investment timelines, or salary details with instant country-aware currency formatting.
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-6">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-[#1F4E8C] text-xs font-bold text-white">2</span>
                    <h3 class="mt-4 font-display text-base font-bold text-slate-900">Instant accurate calculation</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-600">
                        Calculations run immediately in your browser using verified standard formulas (e.g. amortized reducing balance, compound interest).
                    </p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-6">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-[#1F4E8C] text-xs font-bold text-white">3</span>
                    <h3 class="mt-4 font-display text-base font-bold text-slate-900">Understand the tradeoffs</h3>
                    <p class="mt-2 text-xs leading-relaxed text-slate-600">
                        Every tool explains the underlying math, shows worked examples, highlights common mistakes, and links to relevant planning guides.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Financial Goal (Categories) -->
    <section class="py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <p class="eyebrow">Goal-Based Planning</p>
                    <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">Browse by financial goal</h2>
                </div>
                <a href="{{ route('calculators.index') }}" class="text-xs font-semibold text-[#1F4E8C] hover:underline">
                    View all categories →
                </a>
            </div>

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', ['category' => $category['slug']]) }}" class="group rounded-xl border border-slate-200 bg-white p-5 shadow-xs transition hover:border-[#1F4E8C] hover:shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500">{{ $category['calculator_count'] }} {{ Str::plural('tool', $category['calculator_count']) }}</span>
                            <span class="text-xs font-semibold text-[#1F4E8C] group-hover:translate-x-0.5 transition">→</span>
                        </div>
                        <h3 class="mt-2 font-display text-lg font-bold text-slate-900 group-hover:text-[#1F4E8C]">{{ $category['name'] }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-600">{{ $category['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Dedicated Regional Finance Hubs -->
    <section class="border-t border-slate-200 bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="eyebrow">Localized Financial Rules</p>
                <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">Dedicated regional finance hubs for the U.S., Europe, UK, and India</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">
                    Financial rules, tax brackets, and borrowing standards vary significantly around the world. Use these dedicated regional portals for localized calculations.
                </p>
            </div>

            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-[#1F4E8C] hover:bg-white hover:shadow-xs">
                    <span class="text-xl">🇺🇸</span>
                    <h3 class="mt-2 font-display text-base font-bold text-slate-900 group-hover:text-[#1F4E8C]">U.S. finance calculators</h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-slate-600">Mortgage APR, income tax estimates, take-home salary, credit card payoff, and standard monthly budgeting.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-[#1F4E8C] hover:bg-white hover:shadow-xs">
                    <span class="text-xl">🇬🇧</span>
                    <h3 class="mt-2 font-display text-base font-bold text-slate-900 group-hover:text-[#1F4E8C]">UK finance calculators</h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-slate-600">UK mortgages, PAYE net salary, tax band thresholds, ISA savings growth, and household budgeting.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-[#1F4E8C] hover:bg-white hover:shadow-xs">
                    <span class="text-xl">🇮🇳</span>
                    <h3 class="mt-2 font-display text-base font-bold text-slate-900 group-hover:text-[#1F4E8C]">India finance calculators</h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-slate-600">EMI reducing balance, SIP mutual fund wealth, GST slabs, and salary calculations with India-first defaults.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="group rounded-xl border border-slate-200 bg-slate-50/50 p-5 transition hover:border-[#1F4E8C] hover:bg-white hover:shadow-xs">
                    <span class="text-xl">🇪🇺</span>
                    <h3 class="mt-2 font-display text-base font-bold text-slate-900 group-hover:text-[#1F4E8C]">Europe finance calculators</h3>
                    <p class="mt-1.5 text-xs leading-relaxed text-slate-600">Standard VAT calculations, salary conversions, savings growth, and cross-border European planning.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Practical Reading Guides -->
    <section class="py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <p class="eyebrow">Financial Education</p>
                    <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">Practical reading before bigger money decisions</h2>
                </div>
                <a href="{{ route('guides.index') }}" class="text-xs font-semibold text-[#1F4E8C] hover:underline">
                    View all {{ count(config('guides')) }} guides →
                </a>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @foreach($guidePreviews as $guide)
                    @php($metadata = \App\Support\GuideEditorial::metadata($guide))
                    <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-xs transition hover:border-[#1F4E8C] hover:shadow-sm">
                        <div>
                            <span class="inline-block text-[11px] font-semibold uppercase tracking-wider text-[#1F4E8C]">Guide Article</span>
                            <h3 class="mt-2 font-display text-base font-bold text-slate-900 group-hover:text-[#1F4E8C]">{{ $guide['title'] }}</h3>
                            <p class="mt-1 text-[11px] text-slate-400">By {{ $metadata['author_name'] }} · Updated {{ $metadata['updated_display'] }}</p>
                            <p class="mt-3 text-xs leading-relaxed text-slate-600">{{ Str::limit($guide['intro'], 160) }}</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 text-xs font-semibold text-[#1F4E8C] flex items-center justify-between">
                            <span>Read guide</span>
                            <span aria-hidden="true">→</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Editorial Trust & Methodology Summary -->
    <section class="border-t border-slate-200 bg-slate-50/50 py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12">
                <div class="lg:col-span-6">
                    <p class="eyebrow">Trust & Methodology</p>
                    <h2 class="mt-1 font-display text-2xl font-bold text-slate-900 sm:text-3xl">Why people use FinguruTools</h2>
                    <div class="mt-4 space-y-3 text-xs leading-relaxed text-slate-600">
                        <p>People use FinguruTools for very different reasons. One visitor may be checking whether a home loan payment fits inside a monthly budget. Another may be comparing retirement projections, estimating take-home salary before accepting an offer, or stress-testing a debt payoff plan before committing to a higher payment.</p>
                        <p>In each case, our goal is the same: reduce confusion and help you move from a vague money concern to a clearer decision path with transparent assumptions.</p>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-4 text-xs font-semibold text-[#1F4E8C]">
                        <a href="{{ route('calculation-methodology') }}" class="underline hover:text-[#163D70]">Calculation Methodology →</a>
                        <a href="{{ route('editorial-policy') }}" class="underline hover:text-[#163D70]">Editorial Policy →</a>
                        <a href="{{ route('disclaimer') }}" class="underline hover:text-[#163D70]">Financial Disclaimer →</a>
                    </div>
                </div>

                <div class="space-y-4 lg:col-span-6">
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                        <p class="text-xs font-bold text-slate-900">Reviewed formulas</p>
                        <p class="mt-1 text-xs text-slate-600">Each calculator displays the standard mathematical equation, assumptions, and output interpretation.</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                        <p class="text-xs font-bold text-slate-900">Updated guide pages</p>
                        <p class="mt-1 text-xs text-slate-600">Articles are reviewed regularly and include author attribution and last-updated signals.</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                        <p class="text-xs font-bold text-slate-900">Planning updates & support</p>
                        <p class="mt-1 text-xs text-slate-600">For calculator feedback, formula questions, or guide suggestions, our team is reachable directly.</p>
                        <a href="{{ route('contact') }}" class="mt-2 inline-block text-xs font-semibold text-[#1F4E8C] hover:underline">Open contact form →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
