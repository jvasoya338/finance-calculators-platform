@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="grid gap-6 lg:grid-cols-[0.95fr,1.05fr] lg:items-end">
            <div>
                <p class="eyebrow">{{ $category['calculator_count'] }} calculators</p>
                <h1 class="section-title mt-4">{{ $category['name'] }}</h1>
                <p class="section-copy mt-4">{{ $category['headline'] }}</p>
            </div>
            <div class="surface-panel p-6 sm:p-8">
                <p class="text-sm leading-7 text-slate-300">{{ $category['description'] }}</p>
            </div>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($category['calculators'] as $calculator)
                <x-calculator.card :calculator="$calculator" />
            @endforeach
        </div>
    </section>
@endsection
