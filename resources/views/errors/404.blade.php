@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-2xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24 text-center">
        <div class="card-panel p-8 sm:p-12">
            <span class="eyebrow">404 Error</span>
            <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Page Not Found</h1>
            <p class="mt-4 text-sm sm:text-base text-slate-600 leading-relaxed max-w-lg mx-auto">
                The page you are looking for may have moved, expired, or been renamed. Explore our financial calculators or return to the homepage.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('home') }}" class="btn-primary w-full sm:w-auto px-6 py-2.5 text-sm font-semibold rounded-lg shadow-sm">
                    Return to Homepage
                </a>
                <a href="{{ route('calculators.index') }}" class="btn-secondary w-full sm:w-auto px-6 py-2.5 text-sm font-semibold rounded-lg">
                    Browse All Calculators
                </a>
            </div>
        </div>
    </section>
@endsection
