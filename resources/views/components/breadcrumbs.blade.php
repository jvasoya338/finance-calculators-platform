@props(['items' => []])

@if(count($items) > 1)
    <nav aria-label="Breadcrumb" class="mb-6">
        <ol class="flex flex-wrap items-center gap-1.5 text-xs text-slate-500">
            @foreach($items as $item)
                <li class="flex items-center gap-1.5">
                    @if($loop->last)
                        <span class="font-medium text-slate-800" aria-current="page">{{ $item['label'] }}</span>
                    @else
                        <a href="{{ $item['url'] }}" class="transition hover:text-[#1F4E8C]">{{ $item['label'] }}</a>
                        <span aria-hidden="true" class="text-slate-300">/</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
