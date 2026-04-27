@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
        <x-breadcrumbs :items="$breadcrumbs" />
        <div class="surface-panel p-6 sm:p-8 lg:p-10">
            <p class="eyebrow">{{ str_replace('-', ' ', $pageKey) }}</p>
            <h1 class="mt-4 font-display text-5xl font-semibold tracking-tight text-[#0B2A4A]">{{ $page['headline'] }}</h1>
            <p class="mt-5 text-lg leading-8 text-[rgba(11,42,74,0.72)]">{{ $page['description'] }}</p>

            @if(session('status'))
                <div class="mt-8 rounded-3xl border border-[rgba(31,174,75,0.35)] bg-[rgba(31,174,75,0.14)] px-5 py-4 text-sm font-medium text-[#1FAE4B]">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-8 space-y-6 text-base leading-8 text-[rgba(11,42,74,0.72)]">
                @foreach($page['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                @if($pageKey === 'contact')
                    <div class="grid gap-8 lg:grid-cols-[1.1fr,0.9fr] lg:items-start">
                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5 rounded-3xl border border-[rgba(31,78,140,0.12)] bg-[rgba(31,78,140,0.03)] p-6">
                            @csrf
                            <div class="grid gap-5 sm:grid-cols-2">
                                <div class="space-y-2">
                                    <label for="name" class="text-sm font-semibold text-[#0B2A4A]">Name</label>
                                    <input id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class="text-sm text-rose-300">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="text-sm font-semibold text-[#0B2A4A]">Email</label>
                                    <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="text-sm text-rose-300">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="subject" class="text-sm font-semibold text-[#0B2A4A]">Subject</label>
                                <input id="subject" name="subject" class="form-input" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <p class="text-sm text-rose-300">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="message" class="text-sm font-semibold text-[#0B2A4A]">Message</label>
                                <textarea id="message" name="message" rows="7" class="form-input" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-sm text-rose-300">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3.5 text-sm font-semibold transition">
                                Send message
                            </button>
                        </form>

                        <div class="space-y-5 rounded-3xl border border-[rgba(31,78,140,0.12)] bg-[rgba(31,78,140,0.03)] p-6">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[rgba(11,42,74,0.56)]">Support email</p>
                                <p class="mt-3 text-lg font-semibold text-[#0B2A4A]">{{ config('finance.brand.support_email') }}</p>
                            </div>
                            <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-5">
                                <p class="text-sm font-semibold text-[#0B2A4A]">What happens next</p>
                                <p class="mt-3 text-sm leading-7 text-[rgba(11,42,74,0.72)]">Messages are stored securely so we can review them, respond, and improve the tools people use most often.</p>
                            </div>
                            <div class="rounded-3xl border border-[rgba(31,78,140,0.1)] bg-white p-5">
                                <p class="text-sm font-semibold text-[#0B2A4A]">Best for</p>
                                <ul class="mt-3 space-y-2 text-sm leading-7 text-[rgba(11,42,74,0.72)]">
                                    <li>Calculator feedback and bug reports</li>
                                    <li>Partnership or sponsorship enquiries</li>
                                    <li>Requests for new country-specific finance tools</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
