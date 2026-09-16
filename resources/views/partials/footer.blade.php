<footer class="mt-20 border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="inline-block">
                    <img
                        src="{{ asset('brand/main-logo.png') }}"
                        alt="{{ config('finance.brand.name') }}"
                        class="h-9 w-auto"
                    >
                </a>
                <p class="mt-3.5 max-w-sm text-sm leading-relaxed text-slate-600">
                    {{ config('finance.brand.description') }}
                </p>
                <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span>Free, transparent calculations for global planning</span>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-900">Calculators</p>
                <ul class="mt-3.5 space-y-2.5 text-sm text-slate-600">
                    <li><a href="{{ route('calculators.index') }}" class="transition hover:text-[#1F4E8C]">All Calculators</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 'loan-calculators']) }}" class="transition hover:text-[#1F4E8C]">Loan & Mortgage</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 'investment-calculators']) }}" class="transition hover:text-[#1F4E8C]">Investment & SIP</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 'tax-calculators']) }}" class="transition hover:text-[#1F4E8C]">Tax & Income</a></li>
                    <li><a href="{{ route('categories.show', ['category' => 'budget-calculators']) }}" class="transition hover:text-[#1F4E8C]">Budget & Credit</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-900">Regional Planning</p>
                <ul class="mt-3.5 space-y-2.5 text-sm text-slate-600">
                    <li><a href="{{ route('regional.show', ['region' => 'us-finance-tools']) }}" class="transition hover:text-[#1F4E8C]">United States</a></li>
                    <li><a href="{{ route('regional.show', ['region' => 'uk-finance-tools']) }}" class="transition hover:text-[#1F4E8C]">United Kingdom</a></li>
                    <li><a href="{{ route('regional.show', ['region' => 'india-finance-tools']) }}" class="transition hover:text-[#1F4E8C]">India Hub</a></li>
                    <li><a href="{{ route('regional.show', ['region' => 'eu-finance-tools']) }}" class="transition hover:text-[#1F4E8C]">European Union</a></li>
                    <li><a href="{{ route('guides.index') }}" class="transition hover:text-[#1F4E8C]">Financial Guides</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-900">Trust & Legal</p>
                <ul class="mt-3.5 space-y-2.5 text-sm text-slate-600">
                    <li><a href="{{ route('about') }}" class="transition hover:text-[#1F4E8C]">About FinGuruTools</a></li>
                    <li><a href="{{ route('calculation-methodology') }}" class="transition hover:text-[#1F4E8C]">Calculation Methodology</a></li>
                    <li><a href="{{ route('editorial-policy') }}" class="transition hover:text-[#1F4E8C]">Editorial Policy</a></li>
                    <li><a href="{{ route('privacy') }}" class="transition hover:text-[#1F4E8C]">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="transition hover:text-[#1F4E8C]">Terms & Conditions</a></li>
                    <li><a href="{{ route('disclaimer') }}" class="transition hover:text-[#1F4E8C]">Financial Disclaimer</a></li>
                    <li><a href="{{ route('contact') }}" class="transition hover:text-[#1F4E8C]">Contact & Support</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-slate-100 pt-6">
            <div class="flex flex-col gap-3 text-xs leading-relaxed text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>© {{ now()->year }} {{ config('finance.brand.name') }}. All rights reserved.</p>
                <p class="max-w-xl text-left sm:text-right">Educational financial calculators and planning information only. Not licensed investment, lending, or tax advice.</p>
            </div>
        </div>
    </div>
</footer>
