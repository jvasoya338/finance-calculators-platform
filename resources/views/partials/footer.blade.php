<footer class="relative z-10 mt-16 border-t border-[rgba(31,78,140,0.14)] bg-[linear-gradient(180deg,rgba(31,78,140,0.05),rgba(31,174,75,0.04))]">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                <img
                    src="{{ asset('brand/main-logo.png') }}"
                    alt="{{ config('finance.brand.name') }} logo"
                    class="h-12 w-auto"
                >
                <p class="max-w-xl text-sm leading-7 text-[rgba(11,42,74,0.76)]">{{ config('finance.brand.description') }}</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#1F4E8C]">Platform</p>
                    <div class="mt-3 flex flex-col gap-2 text-sm font-medium text-[#0B2A4A]">
                        <a href="{{ route('calculators.index') }}" class="transition hover:text-[#1F4E8C]">Calculators</a>
                        <a href="{{ route('guides.index') }}" class="transition hover:text-[#1F4E8C]">Guides</a>
                        <a href="{{ route('about') }}" class="transition hover:text-[#1F4E8C]">About</a>
                        <a href="{{ route('contact') }}" class="transition hover:text-[#1F4E8C]">Contact</a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#1F4E8C]">Legal</p>
                    <div class="mt-3 flex flex-col gap-2 text-sm font-medium text-[#0B2A4A]">
                        <a href="{{ route('privacy') }}" class="transition hover:text-[#1F4E8C]">Privacy</a>
                        <a href="{{ route('terms') }}" class="transition hover:text-[#1F4E8C]">Terms</a>
                        <a href="{{ route('disclaimer') }}" class="transition hover:text-[#1F4E8C]">Disclaimer</a>
                        <a href="{{ route('editorial-policy') }}" class="transition hover:text-[#1F4E8C]">Editorial Policy</a>
                        <a href="{{ route('calculation-methodology') }}" class="transition hover:text-[#1F4E8C]">Methodology</a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#1F4E8C]">Regions</p>
                    <div class="mt-3 flex flex-col gap-2 text-sm font-medium text-[#0B2A4A]">
                        <a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="transition hover:text-[#1FAE4B]">India Finance</a>
                        <a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="transition hover:text-[#1FAE4B]">UK Finance</a>
                        <a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="transition hover:text-[#1FAE4B]">US Finance</a>
                        <a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="transition hover:text-[#1FAE4B]">EU Finance</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-3 border-t border-[rgba(31,78,140,0.14)] pt-5 text-sm text-[rgba(11,42,74,0.66)] md:flex-row md:items-center md:justify-between">
            <p>© {{ now()->year }} {{ config('finance.brand.name') }} · <a href="{{ config('finance.brand.website') }}" class="font-medium text-[#1F4E8C] hover:text-[#1FAE4B]">{{ config('finance.brand.website') }}</a></p>
            <p>Educational estimates only. Not financial, tax, lending, or legal advice.</p>
        </div>
    </div>
</footer>
