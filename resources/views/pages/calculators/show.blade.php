@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="grid gap-10 xl:grid-cols-[0.95fr,1.05fr] xl:items-start">
            <div>
                <div class="inline-flex rounded-full border border-[rgba(31,78,140,0.3)] bg-[rgba(31,78,140,0.1)] px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.24em] text-[#1F4E8C]">
                    {{ $calculator['category_name'] }}
                </div>
                <h1 class="mt-5 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A] sm:text-6xl">{{ $calculator['h1'] }}</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-[rgba(11,42,74,0.72)]">{{ $calculator['intro'] }}</p>

                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.05)]">
                        <p class="text-sm text-[rgba(11,42,74,0.56)]">Formula type</p>
                        <p class="mt-2 text-lg font-semibold text-[#0B2A4A]">Reusable service</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.05)]">
                        <p class="text-sm text-[rgba(11,42,74,0.56)]">Metadata</p>
                        <p class="mt-2 text-lg font-semibold text-[#0B2A4A]">SEO optimized</p>
                    </div>
                    <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.05)]">
                        <p class="text-sm text-[rgba(11,42,74,0.56)]">Audience</p>
                        <p class="mt-2 text-lg font-semibold text-[#0B2A4A]">Worldwide</p>
                    </div>
                </div>
            </div>

            <div class="surface-panel p-6 sm:p-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="eyebrow">Calculator form</p>
                        <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Enter your numbers</h2>
                    </div>
                    <span class="rounded-full border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-3 py-1 text-xs font-semibold text-[rgba(11,42,74,0.72)]">Instant results</span>
                </div>
                <form method="GET" action="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="mt-8 grid gap-5">
                    @foreach($calculator['fields'] as $name => $field)
                        <x-calculator.form-field :name="$name" :field="$field" :value="$formValues[$name] ?? ($field['default'] ?? null)" />
                    @endforeach
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3.5 text-sm font-semibold transition">
                            Calculate now
                        </button>
                        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="inline-flex items-center justify-center rounded-full border border-[rgba(31,78,140,0.14)] bg-white px-6 py-3.5 text-sm font-semibold text-[#0B2A4A] transition hover:border-[rgba(31,78,140,0.28)] hover:bg-[rgba(31,78,140,0.04)]">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if($result)
            <div class="mt-10">
                <x-calculator.result-summary :result="$result" />
            </div>
        @endif

        <div class="mt-14 grid gap-8 xl:grid-cols-[1.1fr,0.9fr]">
            <div class="space-y-8">
                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">Formula and method</p>
                    <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">How the {{ strtolower($calculator['title']) }} works</h2>
                    <p class="mt-5 text-base leading-8 text-[rgba(11,42,74,0.72)]">{{ $calculator['formula'] }}</p>
                </section>

                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">Why use this tool</p>
                    <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Use cases and planning benefits</h2>
                    <ul class="mt-6 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                        @foreach($calculator['benefits'] as $benefit)
                            <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-5 py-4">{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </section>

                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">SEO content</p>
                    <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $calculator['title'] }} guide</h2>
                    <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                        <p>{{ $calculator['title'] }} pages should do more than show a number. This page combines the calculation interface with explanatory content, formula transparency, frequently asked questions, and related internal links so the experience works for both users and search visibility.</p>
                        <p>Because the platform is built for a worldwide audience, the language stays broad and adaptable wherever country-specific policies or regulations differ. That keeps the user experience clean today while preserving room for localized enhancements later.</p>
                    </div>
                </section>
            </div>

            <div class="space-y-8">
                @if(!empty($result['chart']))
                    <x-calculator.chart :chart="$result['chart']" />
                @endif

                @if(!empty($result['schedule']))
                    <x-calculator.schedule-table :schedule="$result['schedule']" />
                @endif

                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">Frequently asked questions</p>
                    <div class="mt-6 space-y-4">
                        @foreach($calculator['faqs'] as $faq)
                            <article class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                                <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $faq['question'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $faq['answer'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">Related calculators</p>
                    <div class="mt-6 space-y-4">
                        @foreach($relatedCalculators as $related)
                            <a href="{{ route('calculators.show', ['calculator' => $related['slug']]) }}" class="block rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.05)]">
                                <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $related['title'] }}</h3>
                                <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $related['short_description'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="surface-panel p-6 sm:p-8">
                    <p class="eyebrow">More finance paths</p>
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('calculators.index') }}" class="inline-flex rounded-full border border-[rgba(31,78,140,0.12)] bg-white px-4 py-2 text-sm font-semibold text-[#0B2A4A] transition hover:border-[rgba(31,78,140,0.3)] hover:bg-[rgba(31,78,140,0.04)]">All calculators</a>
                        <a href="{{ route('categories.show', ['category' => $calculator['category']]) }}" class="inline-flex rounded-full border border-[rgba(31,78,140,0.3)] bg-[rgba(31,78,140,0.1)] px-4 py-2 text-sm font-semibold text-[#1F4E8C] transition hover:bg-[rgba(31,174,75,0.12)] hover:text-[#1FAE4B]">{{ $calculator['category_name'] }}</a>
                        <a href="{{ route('guides.index') }}" class="inline-flex rounded-full border border-[rgba(31,78,140,0.12)] bg-white px-4 py-2 text-sm font-semibold text-[#0B2A4A] transition hover:border-[rgba(31,78,140,0.3)] hover:bg-[rgba(31,78,140,0.04)]">Finance guides</a>
                    </div>
                </section>
            </div>
        </div>

        <!-- Optional in-content calculator sponsorship slot -->
    </section>
@endsection
