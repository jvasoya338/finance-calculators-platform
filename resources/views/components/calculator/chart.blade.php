@props(['chart'])

@if(!empty($chart['segments']))
    <section class="surface-panel p-6 sm:p-8">
        <p class="eyebrow">Visual breakdown</p>
        <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Result composition</h2>
        <div class="mt-8 space-y-4">
            @foreach($chart['segments'] as $segment)
                <div>
                    <div class="mb-2 flex items-center justify-between gap-4 text-sm">
                        <span class="font-semibold text-[#0B2A4A]">{{ $segment['label'] }}</span>
                        <span class="text-[rgba(11,42,74,0.72)]">{{ $segment['value'] }} · {{ number_format($segment['percent'], 1) }}%</span>
                    </div>
                    <div class="h-3 overflow-hidden rounded-full bg-[rgba(31,78,140,0.08)]">
                        <div class="h-full rounded-full" style="width: {{ max($segment['percent'], 2) }}%; background-color: {{ $segment['color'] }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
