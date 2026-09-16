<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-sm">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img
                src="{{ asset('brand/main-logo.png') }}"
                alt="{{ config('finance.brand.name') }}"
                class="h-10 w-auto"
            >
        </a>

        <nav class="hidden items-center gap-7 text-sm font-medium text-slate-700 lg:flex">
            <a href="{{ route('calculators.index') }}" class="transition hover:text-[#1F4E8C]">Calculators</a>
            <a href="{{ route('categories.show', ['category' => 'loan-calculators']) }}" class="transition hover:text-[#1F4E8C]">Categories</a>
            <a href="{{ route('guides.index') }}" class="transition hover:text-[#1F4E8C]">Guides</a>
            <a href="{{ route('about') }}" class="transition hover:text-[#1F4E8C]">About</a>
            <a href="{{ route('contact') }}" class="transition hover:text-[#1F4E8C]">Contact</a>
        </nav>

        <div class="hidden items-center gap-4 lg:flex">
            <form method="POST" action="{{ route('country.update') }}">
                @csrf
                <label for="country" class="sr-only">Country</label>
                <select id="country" name="country" onchange="this.form.submit()" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-300 focus:border-[#1F4E8C] focus:outline-none">
                    <option value="auto" @selected(($siteCountryMode ?? 'auto') === 'auto')>
                        🌍 Auto Detect
                    </option>
                    @foreach($siteCountries as $country)
                        <option value="{{ $country['code'] }}" @selected(($siteCountryMode ?? 'auto') === 'manual' && $siteCountry['code'] === $country['code'])>
                            {{ $country['flag'] }} {{ $country['name'] }} ({{ $country['currency'] }})
                        </option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('calculators.show', ['calculator' => 'emi-calculator']) }}" class="btn-primary text-xs font-semibold !py-2 !px-4">
                Open EMI Tool
            </a>
        </div>

        <details class="group lg:hidden">
            <summary class="flex cursor-pointer list-none items-center rounded-lg border border-slate-200 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                <span>Menu</span>
            </summary>
            <div class="absolute right-4 top-16 w-64 rounded-xl border border-slate-200 bg-white p-4 shadow-lg">
                <div class="flex flex-col gap-1 text-sm font-medium text-slate-700">
                    <a href="{{ route('calculators.index') }}" class="rounded-lg px-3 py-2 transition hover:bg-slate-50 hover:text-[#1F4E8C]">Calculators</a>
                    <a href="{{ route('categories.show', ['category' => 'loan-calculators']) }}" class="rounded-lg px-3 py-2 transition hover:bg-slate-50 hover:text-[#1F4E8C]">Categories</a>
                    <a href="{{ route('guides.index') }}" class="rounded-lg px-3 py-2 transition hover:bg-slate-50 hover:text-[#1F4E8C]">Guides</a>
                    <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 transition hover:bg-slate-50 hover:text-[#1F4E8C]">About</a>
                    <a href="{{ route('contact') }}" class="rounded-lg px-3 py-2 transition hover:bg-slate-50 hover:text-[#1F4E8C]">Contact</a>
                    
                    <div class="my-2 border-t border-slate-100"></div>

                    <form method="POST" action="{{ route('country.update') }}" class="px-3 py-1">
                        @csrf
                        <label for="country-mobile" class="mb-1 block text-xs font-semibold text-slate-500">Region & Currency</label>
                        <select id="country-mobile" name="country" onchange="this.form.submit()" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-1.5 text-xs font-medium text-slate-700">
                            <option value="auto" @selected(($siteCountryMode ?? 'auto') === 'auto')>
                                🌍 Auto Detect
                            </option>
                            @foreach($siteCountries as $country)
                                <option value="{{ $country['code'] }}" @selected(($siteCountryMode ?? 'auto') === 'manual' && $siteCountry['code'] === $country['code'])>
                                    {{ $country['flag'] }} {{ $country['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </details>
    </div>
</header>
