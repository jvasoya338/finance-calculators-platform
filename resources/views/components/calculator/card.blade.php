@props(['calculator'])

<article
    class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-5 shadow-xs transition hover:border-[#1F4E8C] hover:shadow-sm"
    data-calculator-card
    data-title="{{ strtolower($calculator['title'].' '.$calculator['short_description'].' '.$calculator['slug'].' '.$calculator['category_name']) }}"
    data-category="{{ $calculator['category'] }}"
>
    <div>
        <div class="mb-3 flex items-center justify-between gap-2">
            <span class="inline-block text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                {{ $calculator['category_name'] }}
            </span>
            @if(!empty($calculator['popular']))
                <span class="rounded bg-emerald-50 px-2 py-0.5 text-[10px] font-semibold text-emerald-700">
                    Popular
                </span>
            @endif
        </div>
        <h3 class="font-display text-lg font-bold text-slate-900 group-hover:text-[#1F4E8C]">
            <a href="{{ route('calculators.show', ['calculator' => $calculator['slug']]) }}">
                {{ $calculator['title'] }}
            </a>
        </h3>
        <p class="mt-2 text-xs leading-relaxed text-slate-600">
            {{ $calculator['short_description'] }}
        </p>
    </div>

    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-[#1F4E8C]">
        <span>Calculate now</span>
        <span aria-hidden="true" class="transition group-hover:translate-x-0.5">→</span>
    </div>
</article>
