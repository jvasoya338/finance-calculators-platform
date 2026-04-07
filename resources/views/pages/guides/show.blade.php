@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="surface-panel p-6 sm:p-8 lg:p-10">
            <p class="eyebrow">Finance guide</p>
            <h1 class="mt-4 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A]">{{ $page['headline'] }}</h1>
            <p class="mt-6 text-lg leading-8 text-[rgba(11,42,74,0.72)]">{{ $page['intro'] }}</p>

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

            <section class="mt-10 rounded-[1.8rem] border border-[rgba(31,174,75,0.2)] bg-[rgba(31,174,75,0.08)] p-6 sm:p-8">
                <p class="eyebrow text-[#1FAE4B]">Key takeaways</p>
                <ul class="mt-4 space-y-3 text-base leading-8 text-[rgba(11,42,74,0.74)]">
                    @foreach($page['takeaways'] as $takeaway)
                        <li class="rounded-2xl border border-[rgba(31,174,75,0.18)] bg-white px-5 py-4">{{ $takeaway }}</li>
                    @endforeach
                </ul>
            </section>

            @if(!empty($page['faqs']))
                <section class="mt-10">
                    <p class="eyebrow">Frequently asked questions</p>
                    <div class="mt-5 space-y-4">
                        @foreach($page['faqs'] as $faq)
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
