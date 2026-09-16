@props(['chart'])

@if(!empty($chart['segments']))
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Visual Breakdown</p>
        <h3 class="mt-1 font-display text-lg font-bold text-slate-900">Result Composition</h3>
        <div class="mt-5 space-y-3.5">
            @foreach($chart['segments'] as $segment)
                <div>
                    <div class="mb-1.5 flex items-center justify-between text-xs font-medium">
                        <span class="text-slate-800">{{ $segment['label'] }}</span>
                        <span class="text-slate-500">{{ $segment['value'] }} ({{ number_format($segment['percent'], 1) }}%)</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full transition-all duration-500" style="width: {{ max($segment['percent'], 2) }}%; background-color: {{ $segment['color'] }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
