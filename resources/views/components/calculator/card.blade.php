@props(['calculator'])

<article
    class="group rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-6 shadow-[0_24px_60px_rgba(11,42,74,0.07)] transition duration-300 hover:-translate-y-1 hover:border-[rgba(31,78,140,0.45)] hover:bg-[rgba(31,78,140,0.03)]"
    data-calculator-card
    data-title="{{ strtolower($calculator['title']) }}"
    data-category="{{ $calculator['category'] }}"
>
    <div class="mb-4 flex items-center gap-3">
        <span class="inline-flex rounded-full border border-[rgba(31,78,140,0.3)] bg-[rgba(31,78,140,0.1)] px-3 py-1 text-xs font-semibold tracking-[0.24em] text-[#1F4E8C] uppercase">
            {{ $calculator['category_name'] }}
        </span>
        @if(!empty($calculator['popular']))
            <span class="inline-flex rounded-full border border-[rgba(31,174,75,0.35)] bg-[rgba(31,174,75,0.12)] px-3 py-1 text-xs font-semibold text-[#1FAE4B]">
                Popular
            </span>
        @endif
    </div>
    <h3 class="font-display text-2xl font-semibold tracking-tight text-[#0B2A4A]">{{ $calculator['title'] }}</h3>
    <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $calculator['short_description'] }}</p>
    <div class="mt-6 flex items-center justify-between">
        <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#1F4E8C] transition group-hover:text-[#1FAE4B]">
            Open calculator
            <span aria-hidden="true">→</span>
        </a>
        <span class="text-xs text-[rgba(11,42,74,0.56)]">{{ $calculator['slug'] }}</span>
    </div>
</article>
