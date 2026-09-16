@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="$breadcrumbs" />

        <!-- Regional Header -->
        <div class="grid gap-8 lg:grid-cols-12 lg:items-center border-b border-slate-200 pb-8">
            <div class="lg:col-span-7">
                <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
                    Regional Finance Portal
                </span>
                <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                    {{ $page['headline'] }}
                </h1>
                <p class="mt-2 text-sm leading-relaxed text-slate-600 sm:text-base">
                    {{ $page['intro'] }}
                </p>
            </div>

            <!-- Regional Overview Box -->
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs lg:col-span-5">
                <h2 class="font-display text-base font-bold text-slate-900">{{ $page['title'] }}</h2>
                <div class="mt-2 space-y-2 text-xs leading-relaxed text-slate-600">
                    @foreach($page['body'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Featured Regional Calculators -->
        <div class="mt-8">
            <h2 class="font-display text-lg font-bold text-slate-900">Key Regional Calculators</h2>
            <div class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredCalculators as $calculator)
                    <x-calculator.card :calculator="$calculator" />
                @endforeach
            </div>
        </div>

        <!-- Norms & Use Cases Grid -->
        <div class="mt-12 grid gap-6 lg:grid-cols-2">
            <!-- Local Financial Norms -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Standards & Conventions</p>
                <h2 class="mt-1 font-display text-xl font-bold text-slate-900">Local Financial Norms</h2>
                <ul class="mt-4 space-y-2.5 text-xs leading-relaxed text-slate-700">
                    @foreach($page['regional_guidelines'] ?? ($page['popular_searches'] ?? []) as $guideline)
                        <li class="flex items-start gap-2">
                            <span class="text-[#1F4E8C] font-bold">✓</span>
                            <span>{{ $guideline }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Why People Use This Hub -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Planning Value</p>
                <h2 class="mt-1 font-display text-xl font-bold text-slate-900">Practical Applications</h2>
                <ul class="mt-4 space-y-2.5 text-xs leading-relaxed text-slate-600">
                    @foreach($page['use_cases'] ?? [] as $useCase)
                        <li class="flex items-start gap-2">
                            <span class="text-slate-400">•</span>
                            <span>{{ $useCase }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Topic Sections -->
        @if(!empty($page['seo_sections']))
            <div class="mt-12 border-t border-slate-200 pt-10">
                <h2 class="font-display text-xl font-bold text-slate-900">Regional Topics & Context</h2>
                <div class="mt-5 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($page['seo_sections'] as $section)
                        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs">
                            <h3 class="font-display text-base font-bold text-slate-900">{{ $section['heading'] }}</h3>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600">{{ $section['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- FAQs -->
        @if(!empty($page['faqs']))
            <section class="mt-12 rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                <h2 class="font-display text-xl font-bold text-slate-900">Frequently Asked Questions</h2>
                <div class="mt-4 divide-y divide-slate-100">
                    @foreach($page['faqs'] as $faq)
                        <details class="group py-3.5 first:pt-0 last:pb-0">
                            <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-slate-900 hover:text-[#1F4E8C]">
                                <span>{{ $faq['question'] }}</span>
                                <span class="ml-2 text-slate-400 transition group-open:rotate-180">▼</span>
                            </summary>
                            <p class="mt-2 text-xs leading-relaxed text-slate-600">
                                {{ $faq['answer'] }}
                            </p>
                        </details>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
