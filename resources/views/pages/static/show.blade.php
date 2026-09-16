@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="card-panel p-6 sm:p-10">
            <span class="eyebrow">{{ ucwords(str_replace('-', ' ', $pageKey)) }}</span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $page['headline'] }}</h1>
            <p class="mt-4 text-base text-slate-600 leading-relaxed font-normal">{{ $page['description'] }}</p>

            @if(session('status'))
                <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-8 space-y-5 text-base text-slate-700 leading-relaxed border-t border-slate-100 pt-6">
                @foreach($page['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                @if($pageKey === 'contact')
                    <div class="mt-10 grid gap-8 lg:grid-cols-12 lg:items-start pt-6 border-t border-slate-200">
                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 lg:col-span-7 bg-slate-50 p-6 rounded-2xl border border-slate-200">
                            @csrf
                            <h2 class="text-base font-bold text-slate-900 mb-2">Send Us a Direct Message</h2>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1">Your Name</label>
                                    <input id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="John Doe" required>
                                    @error('name')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
                                    <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}" placeholder="john@example.com" required>
                                    @error('email')
                                        <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="subject" class="block text-xs font-bold text-slate-700 mb-1">Subject</label>
                                <input id="subject" name="subject" class="form-input" value="{{ old('subject') }}" placeholder="Feedback or question regarding..." required>
                                @error('subject')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-xs font-bold text-slate-700 mb-1">Message</label>
                                <textarea id="message" name="message" rows="5" class="form-input" placeholder="Please describe your query or calculator feedback..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary w-full sm:w-auto px-6 py-2.5 text-sm font-semibold rounded-lg shadow-sm">
                                Send Message
                            </button>
                        </form>

                        <div class="space-y-4 lg:col-span-5">
                            <div class="card-panel p-5 bg-white border-slate-200">
                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Official Contact</span>
                                <p class="mt-1 text-base font-bold text-slate-900">{{ config('finance.brand.support_email') }}</p>
                                <p class="mt-2 text-xs text-slate-600 leading-relaxed">For general inquiries, editorial clarifications, or developer feedback.</p>
                            </div>

                            <div class="card-panel p-5 bg-white border-slate-200">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Response Standards</h3>
                                <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                                    Inquiries are reviewed by our editorial and technical teams. We aim to review math correction requests and tool bug reports within 2 business days.
                                </p>
                            </div>

                            <div class="card-panel p-5 bg-white border-slate-200">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Topics We Address</h3>
                                <ul class="mt-2 space-y-1.5 text-xs text-slate-600">
                                    <li class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-brand-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Formula verification &amp; edge cases
                                    </li>
                                    <li class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-brand-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        New currency / regional requests
                                    </li>
                                    <li class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-brand-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Editorial suggestions &amp; corrections
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </article>
@endsection
