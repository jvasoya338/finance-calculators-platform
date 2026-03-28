@props(['result'])

<section class="@if(!empty($result['warning'])) border-rose-400/30 bg-rose-400/10 @else border-[rgba(31,174,75,0.3)] bg-[rgba(31,174,75,0.1)] @endif rounded-3xl border p-6 sm:p-8">
    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[rgba(11,42,74,0.56)]">Results</p>
    <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">{{ $result['headline'] }}</h2>
    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach($result['summary'] as $stat)
            <div class="rounded-2xl border border-[rgba(31,78,140,0.1)] bg-white p-5">
                <p class="text-sm text-[rgba(11,42,74,0.56)]">{{ $stat['label'] }}</p>
                <p class="mt-2 text-2xl font-semibold text-[#0B2A4A]">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    @if(!empty($result['details']))
        <div class="mt-8 grid gap-3 sm:grid-cols-2">
            @foreach($result['details'] as $detail)
                <div class="flex items-center justify-between rounded-2xl border border-[rgba(31,78,140,0.08)] bg-[rgba(31,78,140,0.03)] px-4 py-3 text-sm">
                    <span class="text-[rgba(11,42,74,0.72)]">{{ $detail['label'] }}</span>
                    <span class="font-semibold text-[#0B2A4A]">{{ $detail['value'] }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <p class="mt-6 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $result['explanation'] }}</p>
</section>
