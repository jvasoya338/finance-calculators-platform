@props(['schedule'])

@if(!empty($schedule['rows']))
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs sm:p-7">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Amortization Table</p>
        <h3 class="mt-1 font-display text-lg font-bold text-slate-900">Payment Schedule Snapshot</h3>
        @if(!empty($schedule['summary']))
            <p class="mt-2 text-xs leading-relaxed text-slate-600">{{ $schedule['summary'] }}</p>
        @endif
        <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-xs">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        @foreach($schedule['columns'] as $column)
                            <th scope="col" class="px-3.5 py-2.5 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @foreach($schedule['rows'] as $row)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            @foreach($row as $cell)
                                <td class="whitespace-nowrap px-3.5 py-2.5 text-slate-600">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif
