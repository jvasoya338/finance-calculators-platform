@props(['name', 'field', 'value' => null])

<div class="space-y-2">
    <label for="{{ $name }}" class="text-sm font-semibold text-[#0B2A4A]">{{ $field['label'] }}</label>

    @if(($field['type'] ?? 'text') === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            class="form-input"
        >
            @foreach($field['options'] as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) $value === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
    @else
        <div class="relative">
            @php
                $prefix = $field['prefix'] ?? null;

                if ($prefix === '$' || $prefix === 'currency') {
                    $prefix = $siteCountry['symbol'] ?? '$';
                }
            @endphp
            @if(!empty($prefix))
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm text-[rgba(11,42,74,0.56)]">{{ $prefix }}</span>
            @endif
            <input
                id="{{ $name }}"
                name="{{ $name }}"
                type="{{ $field['type'] ?? 'text' }}"
                step="{{ $field['step'] ?? 'any' }}"
                value="{{ old($name, $value) }}"
                class="form-input {{ !empty($prefix) ? 'pl-9' : '' }}"
            >
        </div>
    @endif

    @error($name)
        <p class="text-sm text-rose-300">{{ $message }}</p>
    @enderror
</div>
