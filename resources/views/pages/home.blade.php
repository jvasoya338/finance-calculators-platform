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
                        Explore polished calculators for EMI, SIP, home loans, investing, taxes, salaries, debt payoff, and budgeting on FinguruTools. Fast pages, clear explanations, and a product-quality experience on every screen.
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
                                <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">EMI Calculator</h2>
                            </div>
                            <span class="rounded-full border border-[rgba(31,174,75,0.35)] bg-[rgba(31,174,75,0.12)] px-3 py-1 text-xs font-semibold text-[#1FAE4B]">Live</span>
                        </div>
                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                <p class="text-sm text-[rgba(11,42,74,0.56)]">Monthly EMI</p>
                                <p class="mt-3 text-3xl font-semibold text-[#0B2A4A]">{{ $featuredEmi['monthly_payment'] }}</p>
                                <p class="mt-2 text-sm text-[rgba(11,42,74,0.72)]">Based on a {{ $featuredEmi['principal'] }} loan over {{ $featuredEmi['tenure'] }} years at {{ $featuredEmi['rate'] }}%.</p>
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                    <p class="text-sm text-[rgba(11,42,74,0.56)]">Total repayment</p>
                                    <p class="mt-2 text-2xl font-semibold text-[#0B2A4A]">{{ $featuredEmi['total_repayment'] }}</p>
                                </div>
                                <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                    <p class="text-sm text-[rgba(11,42,74,0.56)]">Total interest</p>
                                    <p class="mt-2 text-2xl font-semibold text-[#0B2A4A]">{{ $featuredEmi['total_interest'] }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-[#1F4E8C] hover:text-[#1FAE4B]">
                            Explore EMI planning
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
                <div class="space-y-5">
                    <form method="GET" action="{{ route('calculators.index') }}" class="flex flex-col gap-3 sm:flex-row">
                        <label for="home-calculator-search" class="sr-only">Search calculators</label>
                        <input id="home-calculator-search" name="q" type="search" class="form-input" placeholder="Search EMI, SIP, salary, GST, budget...">
                        <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-2xl px-5 py-3.5 text-sm font-semibold transition">
                            Search
                        </button>
                    </form>
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
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="surface-panel p-6 sm:p-8">
            <p class="eyebrow">What FinguruTools does</p>
            <h2 class="section-title mt-4">A finance site built for people who want clearer decisions, not just quick numbers</h2>
            <div class="mt-6 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                <p>FinguruTools brings together calculators, practical guides, regional finance hubs, and plain-language explanations so people can compare common money choices without jumping between multiple sites. Whether the question is about a loan payment, a savings plan, take-home pay, tax, debt payoff, or a crypto position, the goal is the same: make the numbers easier to understand before a real decision is made.</p>
                <p>Many finance sites stop at the calculation itself. We try to go one step further by showing formulas, worked examples, FAQs, related tools, and supporting articles that explain what the result means. That helps visitors understand tradeoffs such as affordability versus total cost, growth versus contribution size, or spending comfort versus long-term goals.</p>
                <p>The site is designed for everyday use on mobile or desktop, and it is especially useful for people who want a cleaner starting point before checking official lender, payroll, tax, or provider sources. FinguruTools is not meant to replace professional advice. It is meant to make the next financial question easier to frame and compare.</p>
                <p>People use FinguruTools for very different reasons. One visitor may be checking whether a home loan payment fits inside a monthly budget. Another may be comparing retirement projections, estimating take-home salary before accepting an offer, or stress-testing a debt payoff plan before committing to a higher payment. In each case, the job of the site is the same: reduce confusion and help the person move from a vague money concern to a clearer decision path.</p>
                <p>That is also why the platform includes regional finance hubs, educational guide pages, and connected links between related calculators. A strong finance site should not feel like a collection of isolated forms. It should help users understand what question to ask next, what assumption matters most, and where the result may need extra caution because real-world rules vary by lender, employer, product, or country.</p>
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
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#1F4E8C]">{{ $category['calculator_count'] }} {{ Str::plural('tool', $category['calculator_count']) }}</p>
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
                <div class="mt-6 grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-2xl font-semibold text-[#0B2A4A]">{{ $calculatorCount }}+</p>
                        <p class="mt-1 text-sm text-[rgba(11,42,74,0.72)]">working finance calculators</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-2xl font-semibold text-[#0B2A4A]">{{ $guideCount }}+</p>
                        <p class="mt-1 text-sm text-[rgba(11,42,74,0.72)]">practical finance guides</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-2xl font-semibold text-[#0B2A4A]">4</p>
                        <p class="mt-1 text-sm text-[rgba(11,42,74,0.72)]">regional planning hubs</p>
                    </div>
                </div>
                <ul class="mt-6 space-y-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    <li>Clear formulas and plain-language explanations under every result.</li>
                    <li>Fast mobile-first pages built to feel like a premium product, not a template farm.</li>
                    <li>Guides, FAQs, and worked examples that help people understand the result before acting on it.</li>
                    <li>Consistent categories and navigation that make it easier to compare related money decisions.</li>
                </ul>
                <div class="mt-8 rounded-3xl border border-[rgba(31,78,140,0.12)] bg-[rgba(31,78,140,0.03)] p-5">
                    <p class="text-sm font-semibold text-[#0B2A4A]">Planning updates</p>
                    <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">For calculator feedback, partnership enquiries, or finance guide suggestions, contact the FinguruTools team directly at <a href="mailto:{{ config('finance.brand.support_email') }}" class="font-semibold text-[#1F4E8C] hover:text-[#1FAE4B]">{{ config('finance.brand.support_email') }}</a>.</p>
                </div>
            </aside>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-6">
            <div>
                <p class="eyebrow">Guides</p>
                <h2 class="section-title mt-4">Practical reading before bigger money decisions</h2>
            </div>
            <a href="{{ route('guides.index') }}" class="hidden text-sm font-semibold text-[#1F4E8C] hover:text-[#1FAE4B] sm:inline-flex">View all guides</a>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-3">
            @foreach($guidePreviews as $guide)
                @php($metadata = \App\Support\GuideEditorial::metadata($guide))
                <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_18px_40px_rgba(11,42,74,0.05)] transition hover:-translate-y-1 hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.03)]">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#1F4E8C]">Guide article</p>
                    <h3 class="mt-4 font-display text-2xl font-semibold text-[#0B2A4A]">{{ $guide['title'] }}</h3>
                    <p class="mt-3 text-xs font-semibold uppercase tracking-[0.18em] text-[rgba(11,42,74,0.56)]">By {{ $metadata['author_name'] }} · Updated {{ $metadata['updated_display'] }}</p>
                    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ Str::limit($guide['intro'], 180) }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="surface-panel p-6 sm:p-8">
            <div class="grid gap-8 lg:grid-cols-[0.95fr,1.05fr] lg:items-center">
                <div>
                    <p class="eyebrow">Trust and usability</p>
                    <h2 class="section-title mt-4">Built for clear answers, practical comparisons, and easy everyday use.</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">Clear finance journeys</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Category hubs, related tools, and supporting guides make it easier to move from one money question to the next.</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                        <p class="text-sm font-semibold text-[#0B2A4A]">Consistent calculations</p>
                        <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Results, formulas, and assumptions are presented in a repeatable format across loan, tax, investing, and budgeting tools.</p>
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
                <h2 class="section-title mt-4">New calculators people can use right away</h2>
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
                <p class="eyebrow">Why the site works</p>
                <h2 class="section-title mt-4">A finance resource built for both calculations and better decisions</h2>
                <p class="mt-5 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                    Good finance tools should do more than output a number. FinguruTools pairs calculations with plain-language explanations, related guides, regional hubs, and connected planning flows so people can understand what the result means before acting on it.
                </p>
                <p class="mt-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                    We also try to keep the experience trustworthy. That means publishing methodology notes, editorial guidance, legal pages, worked examples, and support information so users can understand both the strengths and the limits of the tool they are using.
                </p>
                <div class="mt-8 rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_16px_36px_rgba(11,42,74,0.05)]">
                    <h3 class="text-lg font-semibold text-[#0B2A4A]">Frequently asked questions</h3>
                    <div class="mt-5 space-y-4">
                        <div class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-4">
                            <p class="font-semibold text-[#0B2A4A]">Are these calculators only for one country?</p>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">No. The site is designed for a broad audience, while also offering country-aware defaults and regional finance hubs where they are helpful.</p>
                        </div>
                        <div class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-4">
                            <p class="font-semibold text-[#0B2A4A]">Do the pages explain the result, or only show numbers?</p>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Each tool pairs the calculation with formulas, FAQs, worked examples, related calculators, and supporting guide content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium in-content sponsorship slot -->
@endsection
