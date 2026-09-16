@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="grid gap-8 lg:grid-cols-[0.9fr,1.1fr] lg:items-end">
            <div>
                <p class="eyebrow">Regional finance hub</p>
                <h1 class="section-title mt-4">{{ $page['headline'] }}</h1>
                <p class="section-copy mt-4">{{ $page['intro'] }}</p>
            </div>
            <div class="surface-panel p-6 sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $page['title'] }}</h2>
                <div class="mt-5 space-y-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    @foreach($page['body'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach($featuredCalculators as $calculator)
                <x-calculator.card :calculator="$calculator" />
            @endforeach
        </div>

        <section class="mt-14 grid gap-8 lg:grid-cols-[0.95fr,1.05fr]">
            <div class="surface-panel p-6 sm:p-8">
                <p class="eyebrow">Why people use this page</p>
                <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Regional finance planning with a cleaner structure</h2>
                <ul class="mt-6 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                    @foreach($page['use_cases'] ?? [] as $useCase)
                        <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-5 py-4">{{ $useCase }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="surface-panel p-6 sm:p-8">
                <p class="eyebrow">Local financial norms</p>
                <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Key financial practices & standards</h2>
                <ul class="mt-6 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                    @foreach($page['regional_guidelines'] ?? ($page['popular_searches'] ?? []) as $guideline)
                        <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-5 py-4 font-medium text-[#0B2A4A]">{{ $guideline }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        @if(!empty($page['seo_sections']))
            <section class="mt-14">
                <div>
                    <p class="eyebrow">Country-focused planning</p>
                    <h2 class="section-title mt-4">Finance topics this regional hub is built to support</h2>
                </div>

                <div class="mt-8 grid gap-5 lg:grid-cols-3">
                    @foreach($page['seo_sections'] as $section)
                        <article class="surface-panel p-6">
                            <h3 class="font-display text-2xl font-semibold tracking-tight text-[#0B2A4A]">{{ $section['heading'] }}</h3>
                            <p class="mt-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $section['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mt-14">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <p class="eyebrow">Related categories</p>
                    <h2 class="section-title mt-4">Explore more tools for this regional audience</h2>
                </div>
                <a href="{{ route('calculators.index') }}" class="hidden text-sm font-semibold text-[#1F4E8C] hover:text-[#1FAE4B] sm:inline-flex">All calculators</a>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', ['category' => $category['slug']]) }}" class="rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_18px_40px_rgba(11,42,74,0.05)] transition hover:-translate-y-1 hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.03)]">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#1F4E8C]">{{ $category['calculator_count'] }} {{ Str::plural('tool', $category['calculator_count']) }}</p>
                        <h3 class="mt-4 font-display text-2xl font-semibold text-[#0B2A4A]">{{ $category['name'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $category['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        @if(!empty($page['faqs']))
            <section class="mt-14 surface-panel p-6 sm:p-8">
                <p class="eyebrow">Frequently asked questions</p>
                <div class="mt-6 space-y-4">
                    @foreach($page['faqs'] as $faq)
                        <article class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5">
                            <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $faq['question'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $faq['answer'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection
