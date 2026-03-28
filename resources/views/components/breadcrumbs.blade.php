@props(['items' => []])

@if(count($items) > 1)
    <nav aria-label="Breadcrumb" class="mb-8">
        <ol class="flex flex-wrap items-center gap-2 rounded-full border border-[rgba(31,78,140,0.12)] bg-[rgba(31,78,140,0.04)] px-4 py-3 text-sm text-[rgba(11,42,74,0.72)]">
            @foreach($items as $item)
                <li class="flex items-center gap-2">
                    <a href="{{ $item['url'] }}" class="font-medium transition hover:text-[#1F4E8C]">{{ $item['label'] }}</a>
                    @unless($loop->last)
                        <span aria-hidden="true" class="text-[rgba(11,42,74,0.35)]">›</span>
                    @endunless
                </li>
            @endforeach
        </ol>
    </nav>
@endif
