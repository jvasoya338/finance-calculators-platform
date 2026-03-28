@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        <div class="surface-panel p-8 text-center sm:p-12">
            <p class="eyebrow">Maintenance</p>
            <h1 class="mt-4 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A] sm:text-6xl">We are improving the platform right now.</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-[rgba(11,42,74,0.72)]">
                FinguruTools is temporarily unavailable while updates are being deployed. Please check back shortly.
            </p>
            <div class="mt-8">
                <a href="{{ route('home') }}" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3.5 text-sm font-semibold transition">
                    Try again soon
                </a>
            </div>
        </div>
    </section>
@endsection
