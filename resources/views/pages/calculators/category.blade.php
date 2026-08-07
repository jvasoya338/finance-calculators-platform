@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="grid gap-6 lg:grid-cols-[0.95fr,1.05fr] lg:items-end">
            <div>
                <p class="eyebrow">{{ $category['calculator_count'] }} calculators</p>
                <h1 class="section-title mt-4">{{ $category['name'] }}</h1>
                <p class="section-copy mt-4">{{ $category['headline'] }}</p>
            </div>
            <div class="surface-panel p-6 sm:p-8">
                <p class="text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $category['description'] }}</p>
                <ul class="mt-5 space-y-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    @foreach($editorial['planning_points'] as $point)
                        <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-4 py-3">{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($category['calculators'] as $calculator)
                <x-calculator.card :calculator="$calculator" />
            @endforeach
        </div>

        <section class="mt-12 surface-panel p-6 sm:p-8">
            <p class="eyebrow">Search themes</p>
            <h2 class="section-title mt-4">Popular U.S., Europe, and global searches this category supports</h2>
            <div class="mt-6 flex flex-wrap gap-3">
                @foreach($editorial['search_themes'] as $theme)
                    <span class="inline-flex rounded-full border border-[rgba(31,78,140,0.14)] bg-white px-4 py-2 text-sm font-semibold text-[#0B2A4A] shadow-[0_10px_24px_rgba(11,42,74,0.04)]">{{ $theme }}</span>
                @endforeach
            </div>
            <p class="mt-6 max-w-3xl text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                These themes help visitors move from a broad country or region search into a specific calculator, guide, or planning page without losing the context behind the number.
            </p>
        </section>

        @if($editorial['guide_links']->isNotEmpty())
            <section class="mt-12 surface-panel p-6 sm:p-8">
                <p class="eyebrow">Related guides</p>
                <h2 class="section-title mt-4">Broader reading for {{ strtolower($category['name']) }}</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    @foreach($editorial['guide_links'] as $guide)
                        <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-5 transition hover:border-[rgba(31,78,140,0.35)] hover:bg-[rgba(31,78,140,0.05)]">
                            <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $guide['title'] }}</h3>
                            <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $guide['meta_description'] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection
