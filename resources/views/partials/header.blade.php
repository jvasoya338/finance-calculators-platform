<header class="sticky top-0 z-40 border-b border-[rgba(31,78,140,0.12)] bg-white/95 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img
                src="{{ asset('brand/main-logo.png') }}"
                alt="{{ config('finance.brand.name') }} logo"
                class="h-14 w-auto sm:h-16"
            >
        </a>

        <nav class="hidden items-center gap-6 text-sm font-medium text-[#0B2A4A] lg:flex">
            <a href="{{ route('calculators.index') }}" class="transition hover:text-[#1F4E8C]">Calculators</a>
            <a href="{{ route('categories.show', ['category' => 'loan-calculators']) }}" class="transition hover:text-[#1F4E8C]">Categories</a>
            <a href="{{ route('guides.index') }}" class="transition hover:text-[#1F4E8C]">Guides</a>
            <a href="{{ route('contact') }}" class="transition hover:text-[#1F4E8C]">Contact</a>
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <form method="POST" action="{{ route('country.update') }}">
                @csrf
                <label for="country" class="sr-only">Country</label>
                <select id="country" name="country" onchange="this.form.submit()" class="max-w-[13rem] rounded-full border border-[rgba(31,78,140,0.18)] bg-white px-4 py-2 text-sm font-medium text-[#0B2A4A] shadow-sm outline-none">
                    <option value="auto" @selected(($siteCountryMode ?? 'auto') === 'auto')>
                        Auto detect · India fallback
                    </option>
                    @foreach($siteCountries as $country)
                        <option value="{{ $country['code'] }}" @selected(($siteCountryMode ?? 'auto') === 'manual' && $siteCountry['code'] === $country['code'])>
                            {{ $country['flag'] }} {{ $country['name'] }} · {{ $country['currency'] }}
                        </option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="btn-primary inline-flex items-center rounded-full border border-[rgba(31,78,140,0.45)] px-5 py-2.5 text-sm font-semibold transition hover:border-[rgba(31,174,75,0.6)]">
                Start Calculating
            </a>
        </div>

        <details class="group lg:hidden">
            <summary class="flex cursor-pointer list-none items-center rounded-full border border-[rgba(31,78,140,0.18)] px-4 py-2 text-sm text-[#0B2A4A]">
                Menu
            </summary>
            <div class="absolute right-4 top-20 w-72 rounded-3xl border border-[rgba(31,78,140,0.12)] bg-white p-4 shadow-2xl">
                <div class="flex flex-col gap-2 text-sm text-[#0B2A4A]">
                    <form method="POST" action="{{ route('country.update') }}" class="px-4 py-2">
                        @csrf
                        <label for="country-mobile" class="mb-2 block text-xs font-semibold uppercase tracking-[0.2em] text-[rgba(11,42,74,0.56)]">Country</label>
                        <select id="country-mobile" name="country" onchange="this.form.submit()" class="w-full rounded-2xl border border-[rgba(31,78,140,0.18)] bg-white px-4 py-3 text-sm font-medium text-[#0B2A4A] outline-none">
                            <option value="auto" @selected(($siteCountryMode ?? 'auto') === 'auto')>
                                Auto detect · India fallback
                            </option>
                            @foreach($siteCountries as $country)
                                <option value="{{ $country['code'] }}" @selected(($siteCountryMode ?? 'auto') === 'manual' && $siteCountry['code'] === $country['code'])>
                                    {{ $country['flag'] }} {{ $country['name'] }} · {{ $country['currency'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <a href="{{ route('calculators.index') }}" class="rounded-2xl px-4 py-3 transition hover:bg-[rgba(31,78,140,0.06)]">Calculators</a>
                    <a href="{{ route('categories.show', ['category' => 'loan-calculators']) }}" class="rounded-2xl px-4 py-3 transition hover:bg-[rgba(31,78,140,0.06)]">Categories</a>
                    <a href="{{ route('guides.index') }}" class="rounded-2xl px-4 py-3 transition hover:bg-[rgba(31,78,140,0.06)]">Guides</a>
                    <a href="{{ route('contact') }}" class="rounded-2xl px-4 py-3 transition hover:bg-[rgba(31,78,140,0.06)]">Contact</a>
                </div>
            </div>
        </details>
    </div>
</header>
