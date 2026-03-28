@props(['schedule'])

@if(!empty($schedule['rows']))
    <section class="surface-panel p-6 sm:p-8">
        <p class="eyebrow">Amortization table</p>
        <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-[#0B2A4A]">Payment schedule snapshot</h2>
        <p class="mt-4 text-sm leading-7 text-[rgba(11,42,74,0.72)]">{{ $schedule['summary'] ?? '' }}</p>
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm text-[rgba(11,42,74,0.78)]">
                <thead>
                    <tr class="border-b border-[rgba(31,78,140,0.12)] text-[rgba(11,42,74,0.56)]">
                        @foreach($schedule['columns'] as $column)
                            <th class="px-4 py-3 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedule['rows'] as $row)
                        <tr class="border-b border-[rgba(31,78,140,0.08)]">
                            @foreach($row as $cell)
                                <td class="px-4 py-3">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif
