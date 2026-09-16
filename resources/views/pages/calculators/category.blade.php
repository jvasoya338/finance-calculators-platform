@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="$breadcrumbs" />

        <!-- Category Header -->
        <div class="grid gap-8 lg:grid-cols-12 lg:items-center border-b border-slate-200 pb-8">
            <div class="lg:col-span-7">
                <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
                    {{ $category['calculator_count'] }} {{ Str::plural('Calculator', $category['calculator_count']) }}
                </span>
                <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                    {{ $category['name'] }}
                </h1>
                <p class="mt-2 text-sm leading-relaxed text-slate-600 sm:text-base">
                    {{ $category['headline'] }}
                </p>
                <p class="mt-2 text-xs leading-relaxed text-slate-500">
                    {{ $category['description'] }}
                </p>
            </div>

            <!-- Planning Points -->
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs lg:col-span-5">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Planning Essentials</p>
                <ul class="mt-3 space-y-2 text-xs text-slate-700">
                    @foreach($editorial['planning_points'] as $point)
                        <li class="flex items-start gap-2">
                            <span class="text-[#1F4E8C] font-bold">✓</span>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Calculators Grid -->
        <div class="mt-8">
            <h2 class="font-display text-lg font-bold text-slate-900">Available {{ $category['name'] }}</h2>
            <div class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($category['calculators'] as $calculator)
                    <x-calculator.card :calculator="$calculator" />
                @endforeach
            </div>
        </div>

        <!-- Decision Framework -->
        <section class="mt-12 rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Planning Framework</p>
            <h2 class="mt-1 font-display text-xl font-bold text-slate-900">Core decision framework for {{ strtolower($category['name']) }}</h2>
            <div class="mt-4 space-y-3 text-xs leading-relaxed text-slate-600 sm:text-sm">
                @foreach($editorial['framework_paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </section>

        <!-- Related Guides -->
        @if($editorial['guide_links']->isNotEmpty())
            <section class="mt-8 rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">In-Depth Guides</p>
                <h2 class="mt-1 font-display text-xl font-bold text-slate-900">Broader reading for {{ strtolower($category['name']) }}</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    @foreach($editorial['guide_links'] as $guide)
                        <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="group rounded-lg border border-slate-100 bg-slate-50/60 p-4 transition hover:border-[#1F4E8C] hover:bg-white">
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#1F4E8C]">{{ $guide['title'] }}</h3>
                            <p class="mt-1.5 text-xs leading-relaxed text-slate-500">{{ $guide['meta_description'] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
