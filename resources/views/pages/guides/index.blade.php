@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="mb-10 max-w-3xl">
            <p class="eyebrow">Guides Library</p>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Finance Guides &amp; Planning Resources</h1>
            <p class="mt-3 text-base text-slate-600 leading-relaxed">
                Clear, practical financial explainers, decision frameworks, and regional money guidance designed to help you make well-informed borrowing, investment, and budgeting decisions.
            </p>
        </div>

        <div class="mb-12">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Regional Financial Planning Hubs</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="card-panel p-5 transition hover:border-brand-400 hover:shadow-sm">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">India</span>
                    <h3 class="mt-3 text-base font-bold text-slate-900">India Finance Hub</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">EMI loan amortisation, SIP wealth projections, GST calculations, and New/Old tax regime planning.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="card-panel p-5 transition hover:border-brand-400 hover:shadow-sm">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-100">United Kingdom</span>
                    <h3 class="mt-3 text-base font-bold text-slate-900">UK Finance Hub</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">Repayment mortgage planning, PAYE salary &amp; National Insurance deductions, ISA savings growth.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="card-panel p-5 transition hover:border-brand-400 hover:shadow-sm">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-100">United States</span>
                    <h3 class="mt-3 text-base font-bold text-slate-900">US Finance Hub</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">Fixed-rate mortgage amortisation, federal &amp; state income tax brackets, 401(k) retirement forecasting.</p>
                </a>
                <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="card-panel p-5 transition hover:border-brand-400 hover:shadow-sm">
                    <span class="inline-block text-xs font-semibold uppercase tracking-wider text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-100">Eurozone</span>
                    <h3 class="mt-3 text-base font-bold text-slate-900">EU Finance Hub</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">Standard VAT breakdowns, net salary estimates, compound interest, and euro-denominated debt planning.</p>
                </a>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">All Financial Guides ({{ count($guides) }})</h2>
                    <p class="text-xs text-slate-500 mt-1">Written and reviewed by financial specialists</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($guides as $guide)
                    @php($metadata = \App\Support\GuideEditorial::metadata($guide))
                    <article class="card-panel p-6 flex flex-col justify-between transition hover:border-brand-400 hover:shadow-sm">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-3">
                                <span>{{ $metadata['author_name'] }}</span>
                                <time datetime="{{ $metadata['updated'] }}">Updated {{ $metadata['updated_display'] }}</time>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 leading-snug">
                                <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="hover:text-brand-700">
                                    {{ $guide['title'] }}
                                </a>
                            </h3>
                            <p class="text-sm text-slate-600 leading-relaxed mb-4">
                                {{ $guide['meta_description'] }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500">Editorial Guide</span>
                            <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="text-sm font-semibold text-brand-700 hover:text-brand-800 inline-flex items-center gap-1">
                                Read Guide <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
