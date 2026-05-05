@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="surface-panel p-6 sm:p-8 lg:p-10">
            <p class="eyebrow">Finance guide</p>
            <h1 class="mt-4 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A]">{{ $page['headline'] }}</h1>
            <p class="mt-6 text-lg leading-8 text-[rgba(11,42,74,0.72)]">{{ $page['intro'] }}</p>

            <div class="mt-8 rounded-[1.6rem] border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.04)]">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#1F4E8C]">{{ $editorial['author']['label'] }}</p>
                <p class="mt-3 text-lg font-semibold text-[#0B2A4A]">{{ $editorial['author']['name'] }}</p>
                <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $editorial['author']['note'] }}</p>
                <div class="mt-4 space-y-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                    @foreach($editorial['author']['bio'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_16px_36px_rgba(11,42,74,0.04)] sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['review_process']['heading'] }}</h2>
                <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['review_process']['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </section>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-6 sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['audience']['heading'] }}</h2>
                <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['audience']['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </section>

            <div class="mt-10 space-y-8">
                @foreach($page['sections'] as $section)
                    <section class="rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-6 sm:p-8">
                        <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $section['heading'] }}</h2>
                        <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                            @foreach($section['body'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_16px_36px_rgba(11,42,74,0.04)] sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['example']['heading'] }}</h2>
                <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['example']['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
                <ol class="mt-6 space-y-3 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['example']['steps'] as $step)
                        <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] px-5 py-4">{{ $step }}</li>
                    @endforeach
                </ol>
            </section>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,174,75,0.2)] bg-[rgba(31,174,75,0.08)] p-6 sm:p-8">
                <p class="eyebrow text-[#1FAE4B]">Key takeaways</p>
                <ul class="mt-4 space-y-3 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($page['takeaways'] as $takeaway)
                        <li class="rounded-2xl border border-[rgba(31,174,75,0.18)] bg-white px-5 py-4">{{ $takeaway }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-[rgba(31,78,140,0.03)] p-6 sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['mistakes']['heading'] }}</h2>
                <ul class="mt-5 space-y-3 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['mistakes']['items'] as $item)
                        <li class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-white px-5 py-4">{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,174,75,0.18)] bg-[rgba(31,174,75,0.08)] p-6 sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['checklist']['heading'] }}</h2>
                <ul class="mt-5 space-y-3 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['checklist']['items'] as $item)
                        <li class="rounded-2xl border border-[rgba(31,174,75,0.18)] bg-white px-5 py-4">{{ $item }}</li>
                    @endforeach
                </ul>
            </section>

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_16px_36px_rgba(11,42,74,0.04)] sm:p-8">
                <h2 class="font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $editorial['closing']['heading'] }}</h2>
                <div class="mt-5 space-y-4 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($editorial['closing']['paragraphs'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </section>

            @if(!empty($faqs))
                <section class="mt-10">
                    <p class="eyebrow">Frequently asked questions</p>
                    <div class="mt-5 space-y-4">
                        @foreach($faqs as $faq)
                            <article class="rounded-[1.6rem] border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.04)]">
                                <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $faq['question'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $faq['answer'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if($relatedCalculators->isNotEmpty())
                <section class="mt-10">
                    <p class="eyebrow">Related calculators</p>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        @foreach($relatedCalculators as $calculator)
                            <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="rounded-[1.6rem] border border-[rgba(31,78,140,0.1)] bg-white p-5 shadow-[0_16px_36px_rgba(11,42,74,0.04)] transition hover:border-[rgba(31,78,140,0.35)] hover:bg-[rgba(31,78,140,0.03)]">
                                <h3 class="text-lg font-semibold text-[#0B2A4A]">{{ $calculator['title'] }}</h3>
                                <p class="mt-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $calculator['short_description'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection
