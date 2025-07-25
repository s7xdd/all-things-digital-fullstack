@extends('layouts.app')

@section('title', 'Contact Us - ' . env('APP_NAME'))

@section('content')

    <x-hero title="{{ $page->getTranslation('title', $lang) }}" subtitle="{!! $page->getTranslation('sub_title', $lang) !!}" />

    <section class="relative py-24 bg-gradient-to-b from-[#f8f9fc] via-[#eaf3fe] to-[#e5e9f7] overflow-hidden">
        <div class="absolute left-0 right-0 bottom-0 w-full pointer-events-none z-0">
            <img src="{{ asset('images/shape-grid-bottom-1.svg') }}" alt="Decorative Grid Bottom Shape"
                class="w-full object-cover" style="min-height:120px;">
        </div>

        <svg class="absolute top-0 left-0 w-56 h-56 -translate-x-1/2 -translate-y-1/2 opacity-10 pointer-events-none"
            viewBox="0 0 200 200">
            <defs>
                <radialGradient id="radGrad1" cx="50%" cy="50%" r="50%">
                    <stop stop-color="#1c2d9a" stop-opacity="0.22" offset="0%" />
                    <stop stop-color="#f8f9fc" stop-opacity="0" offset="100%" />
                </radialGradient>
            </defs>
            <circle cx="100" cy="100" r="100" fill="url(#radGrad1)" />
        </svg>

        <x-container>
            <div class="relative grid md:grid-cols-2 gap-16 items-start z-10">

                <div class="space-y-8 bg-white/90 rounded-3xl p-10 shadow-xl border border-[#e5e9f7]">
                    <h2 class="text-3xl font-bold text-[#1e293b] leading-snug">
                        {{ $page->getTranslation('heading2', $lang) }}
                    </h2>
                    <p class="text-gray-600 text-base leading-relaxed">
                        {!! $page->getTranslation('content', $lang) !!}
                    </p>
                    <div class="space-y-5 text-gray-700 text-sm font-medium">
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-flex items-center justify-center bg-[#1c2d9a] rounded-full w-9 h-9 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 14v7" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>
                                <strong>Email:</strong> {{ get_setting('footer_email') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-flex items-center justify-center bg-[#1c2d9a] rounded-full w-9 h-9 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M22 16.92V21a1 1 0 01-1.1 1A19.86 19.86 0 013 5.14 1 1 0 014 4h4.09a1 1 0 011 .75 12.1 12.1 0 00.7 2.81 1 1 0 01-.23 1L8.21 10.79a16.53 16.53 0 007 7l1.23-1.23a1 1 0 011-.22 12.1 12.1 0 002.81.69 1 1 0 01.75 1z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>
                                <strong>Phone:</strong> {{ get_setting('footer_phone') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="inline-flex items-center justify-center bg-[#1c2d9a] rounded-full w-9 h-9 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M12 2a7 7 0 017 7c0 4.418-7 13-7 13S5 13.418 5 9a7 7 0 017-7z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>
                                <strong>Address:</strong> {{ get_setting('footer_address') }}
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('contact.submit') }}"
                    class="space-y-7 bg-white/90 p-10 rounded-3xl shadow-xl border border-[#e5e9f7]" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="Your full name" />
                        @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="you@example.com" />
                        @error('email')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="Write your message here..."></textarea>
                        @error('message')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-3 bg-[#1c2d9a] text-white font-semibold px-6 py-4 rounded-xl shadow-lg hover:bg-[#233e70] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        {{ $page->getTranslation('heading3', $lang) }}
                    </button>
                    @if ($errors->any())
                        <div class="mt-4 text-white">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                </form>
            </div>
        </x-container>
    </section>
@endsection
