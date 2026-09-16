@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="$breadcrumbs" />

        <!-- Header & Intro -->
        <div class="max-w-3xl">
            <span class="inline-flex items-center rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
                {{ $calculator['category_name'] }}
            </span>
            <h1 class="mt-3 font-display text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                {{ $calculator['h1'] }}
            </h1>
            <p class="mt-2.5 text-sm leading-relaxed text-slate-600 sm:text-base">
                {{ $calculator['intro'] }}
            </p>

            <!-- Compact Calculation Specs -->
            <div class="mt-4 flex flex-wrap items-center gap-2 text-xs">
                <span class="inline-flex items-center gap-1 rounded-md border border-slate-200 bg-white px-2.5 py-1 font-medium text-slate-600">
                    <strong class="text-slate-900">Model:</strong> {{ $editorial['specs']['model'] ?? 'Standard Formula' }}
                </span>
                <span class="inline-flex items-center gap-1 rounded-md border border-slate-200 bg-white px-2.5 py-1 font-medium text-slate-600">
                    <strong class="text-slate-900">Output:</strong> {{ $editorial['specs']['output'] ?? 'Real-Time Estimate' }}
                </span>
                <span class="inline-flex items-center gap-1 rounded-md border border-slate-200 bg-white px-2.5 py-1 font-medium text-slate-600">
                    <strong class="text-slate-900">Scope:</strong> {{ $editorial['specs']['scope'] ?? 'Multi-Currency Global' }}
                </span>
            </div>
        </div>

        <!-- Calculator & Results Main Grid -->
        <div class="mt-8 grid gap-8 lg:grid-cols-12 lg:items-start">
            <!-- Left: Form Input Card -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs lg:col-span-6">
                <div class="border-b border-slate-100 pb-3">
                    <h2 class="font-display text-lg font-bold text-slate-900">Enter Parameters</h2>
                    <p class="mt-0.5 text-xs text-slate-500">Adjust inputs to calculate real-time estimates</p>
                </div>

                <form method="GET" action="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="mt-5 space-y-4">
                    @foreach($calculator['fields'] as $name => $field)
                        <x-calculator.form-field :name="$name" :field="$field" :value="$formValues[$name] ?? ($field['default'] ?? null)" />
                    @endforeach

                    <div class="pt-2 flex flex-col gap-2.5 sm:flex-row sm:items-center">
                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            Calculate now
                        </button>
                        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="btn-secondary w-full sm:w-auto text-center">
                            Reset defaults
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right: Results Panel -->
            <div class="space-y-6 lg:col-span-6">
                @if($result)
                    <x-calculator.result-summary :result="$result" />

                    @if(!empty($result['chart']))
                        <x-calculator.chart :chart="$result['chart']" />
                    @endif

                    @if(!empty($result['schedule']))
                        <x-calculator.schedule-table :schedule="$result['schedule']" />
                    @endif
                @endif
            </div>
        </div>

        <!-- In-Depth Editorial Guidance & Methodology -->
        <div class="mt-14 border-t border-slate-200 pt-10">
            <div class="grid gap-10 lg:grid-cols-12">
                <!-- Main Editorial Articles (8 cols) -->
                <div class="space-y-10 lg:col-span-8">
                    <!-- Overview & Formula Section -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">What this {{ strtolower($calculator['title']) }} is showing you</h2>
                        <div class="mt-3.5 space-y-3 text-sm leading-relaxed text-slate-600">
                            @foreach($editorial['overview'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <!-- Clean Formula Box -->
                        <div class="mt-5 rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Mathematical Model</p>
                            <p class="mt-1.5 font-mono text-sm font-semibold text-slate-900">{{ $calculator['formula'] }}</p>
                        </div>
                    </section>

                    <!-- Key Inputs Explained -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">Inputs that matter most</h2>
                        <p class="mt-1 text-xs text-slate-500">Understanding how each variable impacts the final calculation</p>
                        <div class="mt-4 grid gap-3.5 sm:grid-cols-2">
                            @foreach($editorial['input_highlights'] as $highlight)
                                <div class="rounded-lg border border-slate-100 bg-slate-50/70 p-4">
                                    <h3 class="text-sm font-bold text-slate-900">{{ $highlight['title'] }}</h3>
                                    <p class="mt-1.5 text-xs leading-relaxed text-slate-600">{{ $highlight['body'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Interpretation & Guidance -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">How to interpret your results</h2>
                        <div class="mt-3.5 space-y-3 text-sm leading-relaxed text-slate-600">
                            @foreach($editorial['interpretation'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                        <ul class="mt-4 space-y-2 border-t border-slate-100 pt-4 text-xs leading-relaxed text-slate-600">
                            @foreach($editorial['tips'] as $tip)
                                <li class="flex items-start gap-2">
                                    <span class="text-[#1F4E8C] font-bold">✓</span>
                                    <span>{{ $tip }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Worked Example Scenario -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">Worked Example Scenario</h2>
                        <p class="mt-1.5 text-xs leading-relaxed text-slate-600">
                            The snapshot below illustrates a representative calculation using the standard initial parameters:
                        </p>
                        <div class="mt-4 grid gap-3 sm:grid-cols-3">
                            @foreach($exampleResult['summary'] as $stat)
                                <div class="rounded-lg border border-slate-100 bg-slate-50 p-3.5">
                                    <p class="text-[11px] font-medium text-slate-500">{{ $stat['label'] }}</p>
                                    <p class="mt-1 font-display text-lg font-bold text-slate-900">{{ $stat['value'] }}</p>
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-4 text-xs leading-relaxed text-slate-600">{{ $exampleResult['explanation'] }}</p>
                    </section>

                    <!-- Practical Considerations & Pitfalls -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">{{ $editorial['considerations']['heading'] }}</h2>
                        <div class="mt-3.5 space-y-3 text-sm leading-relaxed text-slate-600">
                            @foreach($editorial['considerations']['paragraphs'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                        @if(!empty($editorial['considerations']['key_factors']))
                            <div class="mt-4 border-t border-slate-100 pt-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Key Factors to Review:</p>
                                <ul class="mt-2 space-y-1.5 text-xs leading-relaxed text-slate-700">
                                    @foreach($editorial['considerations']['key_factors'] as $factor)
                                        <li class="flex items-start gap-2">
                                            <span class="text-slate-400">•</span>
                                            <span>{{ $factor }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </section>

                    <!-- Frequently Asked Questions (Clean Accessible Accordion) -->
                    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
                        <h2 class="font-display text-xl font-bold text-slate-900">Frequently Asked Questions</h2>
                        <div class="mt-4 divide-y divide-slate-100">
                            @foreach($calculator['faqs'] as $faq)
                                <details class="group py-3.5 first:pt-0 last:pb-0" @if($loop->first) open @endif>
                                    <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-slate-900 hover:text-[#1F4E8C]">
                                        <span>{{ $faq['question'] }}</span>
                                        <span class="ml-2 text-slate-400 transition group-open:rotate-180">▼</span>
                                    </summary>
                                    <p class="mt-2.5 text-xs leading-relaxed text-slate-600">
                                        {{ $faq['answer'] }}
                                    </p>
                                </details>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- Sidebar: Related Tools & Planning Links (4 cols) -->
                <aside class="space-y-6 lg:col-span-4">
                    <!-- Related Calculators -->
                    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Related Tools</p>
                        <h3 class="mt-1 font-display text-base font-bold text-slate-900">Connected Calculators</h3>
                        <div class="mt-3.5 space-y-2.5">
                            @foreach($relatedCalculators as $related)
                                <a href="{{ route('calculators.show', ['calculator' => $related['slug']]) }}" class="block rounded-lg border border-slate-100 bg-slate-50/60 p-3 transition hover:border-[#1F4E8C] hover:bg-white">
                                    <p class="text-xs font-bold text-slate-900">{{ $related['title'] }}</p>
                                    <p class="mt-1 text-[11px] leading-relaxed text-slate-500">{{ Str::limit($related['short_description'], 80) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Related Guides (if available) -->
                    @if($editorial['related_guides']->isNotEmpty())
                        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Educational Guides</p>
                            <h3 class="mt-1 font-display text-base font-bold text-slate-900">Recommended Reading</h3>
                            <div class="mt-3.5 space-y-2.5">
                                @foreach($editorial['related_guides'] as $guide)
                                    <a href="{{ route('guides.show', ['guide' => $guide['slug']]) }}" class="block rounded-lg border border-slate-100 bg-slate-50/60 p-3 transition hover:border-[#1F4E8C] hover:bg-white">
                                        <p class="text-xs font-bold text-slate-900">{{ $guide['title'] }}</p>
                                        <p class="mt-1 text-[11px] leading-relaxed text-slate-500">{{ Str::limit($guide['meta_description'], 80) }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Common Benefits -->
                    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Why Use This Calculator</p>
                        <ul class="mt-3 space-y-2 text-xs leading-relaxed text-slate-600">
                            @foreach($calculator['benefits'] as $benefit)
                                <li class="flex items-start gap-1.5">
                                    <span class="text-emerald-600 font-bold">•</span>
                                    <span>{{ $benefit }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
