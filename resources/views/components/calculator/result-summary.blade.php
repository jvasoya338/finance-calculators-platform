@props(['result'])

<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Calculation Summary</p>
            <h2 class="mt-1 font-display text-xl font-bold text-slate-900">{{ $result['headline'] }}</h2>
        </div>
        <span class="rounded bg-blue-50 px-2.5 py-1 text-xs font-semibold text-[#1F4E8C]">
            Estimated
        </span>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach($result['summary'] as $stat)
            <div class="rounded-lg border border-slate-100 bg-slate-50/70 p-4">
                <p class="text-xs font-medium text-slate-500">{{ $stat['label'] }}</p>
                <p class="mt-1.5 font-display text-xl font-bold text-slate-900">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    @if(!empty($result['details']))
        <div class="mt-6 grid gap-2.5 sm:grid-cols-2">
            @foreach($result['details'] as $detail)
                <div class="flex items-center justify-between rounded-lg border border-slate-100 bg-white px-3.5 py-2.5 text-xs">
                    <span class="text-slate-600">{{ $detail['label'] }}</span>
                    <span class="font-semibold text-slate-900">{{ $detail['value'] }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-5 border-t border-slate-100 pt-4">
        <p class="text-xs leading-relaxed text-slate-600">{{ $result['explanation'] }}</p>
    </div>
</section>
