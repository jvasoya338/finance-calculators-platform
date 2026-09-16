@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <x-breadcrumbs :items="$breadcrumbs" />

        <!-- Article Header -->
        <header class="mb-8">
            <span class="eyebrow">Financial Education Guide</span>
            <h1 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $page['headline'] }}
            </h1>
            <p class="mt-4 text-lg text-slate-600 leading-relaxed font-normal">
                {{ $page['intro'] }}
            </p>

            <div class="mt-6 flex flex-wrap items-center gap-3 pt-6 border-t border-slate-200 text-xs text-slate-600">
                <span class="inline-flex items-center gap-1.5 font-medium text-slate-900">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Written by {{ $metadata['author_name'] }}
                </span>
                <span class="text-slate-300">·</span>
                <time datetime="{{ $metadata['published'] }}" class="text-slate-500">Published {{ $metadata['published_display'] }}</time>
                <span class="text-slate-300">·</span>
                <span class="inline-flex items-center gap-1 text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full font-medium border border-emerald-100">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Verified {{ $metadata['updated_display'] }}
                </span>
            </div>
        </header>

        <!-- Author / Editorial Trust Box -->
        <section class="card-panel p-5 sm:p-6 mb-10 bg-slate-50 border-slate-200">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 font-bold flex items-center justify-center flex-shrink-0 text-sm">
                    FG
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wider text-brand-700">{{ $editorial['author']['label'] }}</p>
                    <p class="text-sm font-bold text-slate-900 mt-0.5">{{ $editorial['author']['name'] }}</p>
                    <p class="text-xs text-slate-600 mt-1">{{ $editorial['author']['note'] }}</p>
                    <div class="mt-3 space-y-2 text-xs text-slate-600 leading-relaxed border-t border-slate-200/80 pt-3">
                        @foreach($editorial['author']['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Editorial Review & Methodology Note -->
        <section class="card-panel p-6 sm:p-8 mb-10">
            <h2 class="text-xl font-bold text-slate-900 mb-3">{{ $editorial['review_process']['heading'] }}</h2>
            <div class="space-y-3 text-sm text-slate-700 leading-relaxed">
                @foreach($editorial['review_process']['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </section>

        <!-- Who This Is For -->
        <section class="card-panel p-6 sm:p-8 mb-10 bg-brand-50/50 border-brand-100">
            <h2 class="text-xl font-bold text-slate-900 mb-3">{{ $editorial['audience']['heading'] }}</h2>
            <div class="space-y-3 text-sm text-slate-700 leading-relaxed">
                @foreach($editorial['audience']['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </section>

        <!-- Guide Main Content Sections -->
        <div class="space-y-10 mb-10">
            @foreach($page['sections'] as $section)
                <section class="card-panel p-6 sm:p-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4">{{ $section['heading'] }}</h2>
                    <div class="space-y-4 text-base text-slate-700 leading-relaxed">
                        @foreach($section['body'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Worked Calculation Example -->
        <section class="card-panel p-6 sm:p-8 mb-10 border-brand-200">
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-brand-700"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-700">Practical Demonstration</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-4">{{ $editorial['example']['heading'] }}</h2>
            <div class="space-y-3 text-sm text-slate-700 leading-relaxed mb-6">
                @foreach($editorial['example']['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="space-y-3">
                @foreach($editorial['example']['steps'] as $idx => $step)
                    <div class="flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 leading-relaxed">
                        <span class="w-6 h-6 rounded-full bg-white border border-slate-300 text-slate-700 font-semibold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                            {{ $idx + 1 }}
                        </span>
                        <div>{{ $step }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Key Takeaways -->
        <section class="card-panel p-6 sm:p-8 mb-10 bg-emerald-50/50 border-emerald-200">
            <h2 class="text-xl font-bold text-emerald-950 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Key Takeaways
            </h2>
            <ul class="space-y-3">
                @foreach($page['takeaways'] as $takeaway)
                    <li class="flex items-start gap-3 p-3.5 bg-white border border-emerald-100 rounded-xl text-sm text-slate-800 leading-relaxed shadow-sm">
                        <svg class="w-4 h-4 text-emerald-600 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>{{ $takeaway }}</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Common Mistakes to Avoid -->
        <section class="card-panel p-6 sm:p-8 mb-10 bg-amber-50/30 border-amber-200">
            <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                {{ $editorial['mistakes']['heading'] }}
            </h2>
            <ul class="space-y-3">
                @foreach($editorial['mistakes']['items'] as $item)
                    <li class="p-4 bg-white border border-amber-100 rounded-xl text-sm text-slate-800 leading-relaxed shadow-sm">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Actionable Decision Checklist -->
        <section class="card-panel p-6 sm:p-8 mb-10">
            <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-brand-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                {{ $editorial['checklist']['heading'] }}
            </h2>
            <ul class="space-y-3">
                @foreach($editorial['checklist']['items'] as $item)
                    <li class="flex items-start gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 leading-relaxed">
                        <span class="w-4 h-4 mt-0.5 rounded border border-slate-400 bg-white flex-shrink-0"></span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </section>

        <!-- Closing Advice -->
        <section class="card-panel p-6 sm:p-8 mb-10">
            <h2 class="text-xl font-bold text-slate-900 mb-3">{{ $editorial['closing']['heading'] }}</h2>
            <div class="space-y-3 text-sm text-slate-700 leading-relaxed">
                @foreach($editorial['closing']['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </section>

        <!-- Interactive FAQ Accordions -->
        @if(!empty($faqs))
            <section class="mb-10">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Frequently Asked Questions</h2>
                <div class="space-y-3">
                    @foreach($faqs as $faq)
                        <details class="group card-panel p-5 bg-white transition open:shadow-sm">
                            <summary class="flex cursor-pointer items-center justify-between font-semibold text-slate-900 text-sm list-none select-none">
                                <span>{{ $faq['question'] }}</span>
                                <span class="ml-4 flex-shrink-0 text-slate-400 group-open:rotate-180 transition-transform duration-200">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </span>
                            </summary>
                            <p class="mt-4 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                {{ $faq['answer'] }}
                            </p>
                        </details>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Related Calculators -->
        @if($relatedCalculators->isNotEmpty())
            <section class="pt-8 border-t border-slate-200">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Calculate Your Numbers Now</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($relatedCalculators as $calculator)
                        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="card-panel p-5 transition hover:border-brand-400 hover:shadow-sm flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-semibold text-brand-700 uppercase tracking-wider">{{ $calculator['category_title'] ?? 'Tool' }}</span>
                                <h3 class="text-base font-bold text-slate-900 mt-1">{{ $calculator['title'] }}</h3>
                                <p class="text-xs text-slate-600 mt-2 leading-relaxed">{{ $calculator['short_description'] }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 text-xs font-semibold text-brand-700 flex items-center justify-between">
                                <span>Launch Calculator</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </article>
@endsection
