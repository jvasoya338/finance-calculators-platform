@props(['name', 'field', 'value' => null])

<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-xs font-semibold uppercase tracking-wider text-slate-700">{{ $field['label'] }}</label>

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
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm font-medium text-slate-400">{{ $prefix }}</span>
            @endif
            <input
                id="{{ $name }}"
                name="{{ $name }}"
                type="{{ $field['type'] ?? 'text' }}"
                step="{{ $field['step'] ?? 'any' }}"
                value="{{ old($name, $value) }}"
                class="form-input {{ !empty($prefix) ? 'pl-8' : '' }}"
            >
        </div>
    @endif

    @error($name)
        <p class="text-xs font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>
