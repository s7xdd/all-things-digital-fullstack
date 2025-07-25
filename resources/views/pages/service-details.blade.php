@extends('layouts.app')

@section('title', $service['title'] . ' - ' . env('APP_NAME'))

@section('content')

    <section
        class="relative -mt-[100px] h-[70vh] flex items-center justify-center bg-gradient-to-b from-[#131e66] via-[#101c5c] to-[#01132f] overflow-hidden">
        <div id="bottom-glow-wrapper"
            class="absolute bottom-16 left-1/2 -translate-x-1/2 w-full max-w-[900px] pointer-events-none z-0 opacity-0 scale-90 translate-y-8">
            <img src="/images/bg-about.svg" alt="Decorative Glow" class="w-full" />
        </div>

        <div class="relative z-10 max-w-4xl w-full mx-auto text-center px-4">
            <h1 id="service-title" data-splitting
                class="text-white font-extrabold text-4xl md:text-7xl leading-tight mb-6 drop-shadow-lg select-none">
                {{ $service['title'] }}
            </h1>

            @if (!empty($service['description']))
                <p id="service-subtitle"
                    class="text-white/75 text-lg md:text-xl font-light max-w-3xl mx-auto drop-shadow-md tracking-wide opacity-0 translate-y-4">
                    {{ $service['description'] }}
                </p>
            @endif
        </div>
    </section>


    <section class="relative py-24 bg-gradient-to-b from-[#f8f9fc] via-[#eaf3fe] to-[#e5e9f7] overflow-hidden">
        <div class="absolute left-0 right-0 top-0 w-full pointer-events-none z-0">
            <img src="{{ asset('images/shape-top.svg') }}" alt="Decorative Grid Bottom Shape" class="w-full object-cover"
                style="min-height:120px;">
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

        <div class="max-w-7xl mx-auto px-6 text-slate-800 z-10 select-text">

            <div class="grid md:grid-cols-5 gap-12 md:gap-20 items-center mb-28">
                <div class="md:col-span-2 flex justify-center">
                    <div
                        class="bg-gradient-to-br from-white to-slate-200 p-12 shadow-2xl ring-1 ring-slate-200 hover:shadow-cyan-500/10 hover:shadow-2xl transition-all duration-500  transform hover:-translate-y-2">
                        <img src="{{ uploaded_asset($service['img']) }}" alt="{{ $service['title'] }}"
                            class="w-48 h-48 object-contain mx-auto filter drop-shadow-xl" />
                    </div>
                </div>

                @if (!empty($service['details']['overview']))
                    <div class="md:col-span-3 text-left">
                        <h2
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2256ac] to-[#14b8a6] mb-6 pb-2">
                            {{ $page->getTranslation('title1', $lang) }}</h2>
                        <p class="text-slate-600 text-lg leading-relaxed tracking-wide select-text space-y-4">
                            {!! $service['details']['overview'] !!}
                        </p>
                    </div>
                @endif
            </div>

            @if (!empty($service['details']['features']))
                <section class="mb-28">
                    <h3 class="text-4xl font-bold text-slate-800 mb-12 text-center">
                        {{ $page->getTranslation('heading2', $lang) }}</h3>
                    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-4">
                        @foreach ($service['details']['features'] as $feature)
                            <div
                                class="relative bg-white/60 backdrop-blur-sm border border-slate-200 shadow-lg hover:shadow-xl transition-all duration-300 p-8 flex flex-col min-h-[240px]  transform hover:-translate-y-2">
                                {{-- <img src="{{ asset('images/' . $feature['shape']) }}" alt="Background Shape"
                                    class="absolute right-0 bottom-0 opacity-5 scale-[1.5] pointer-events-none select-none transition-transform duration-500 group-hover:rotate-12"
                                    width="140" height="140" /> --}}
                                <div class="relative z-10">
                                    <span
                                        class="block mb-6 p-3 bg-gradient-to-br from-[#2256ac] to-[#14b8a6] rounded-lg shadow-md w-max">
                                        <img src="{{ uploaded_asset($feature['icon']) }}" alt="Feature Icon"
                                            class="w-8 h-8 select-none invert brightness-0" />
                                    </span>
                                    <div class="text-slate-900 text-xl font-semibold mb-2">{{ $feature['title'] }}</div>
                                    <div class="text-slate-600 text-sm leading-relaxed">{{ $feature['description'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (!empty($service['details']['benefits']))
                <section class="bg-[#01132f] text-white -mx-6 px-6 py-20 my-28 text-center  shadow-2xl">
                    <div class="max-w-4xl mx-auto">
                        <h3
                            class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-cyan-300 mb-5">
                            {{ $page->getTranslation('title2', $lang) }}
                        </h3>
                        <p class="text-slate-300 text-xl leading-relaxed tracking-wide select-text">
                            {!! $service['details']['benefits'] !!}
                        </p>
                    </div>
                </section>
            @endif

            @if (!empty($service['details']['use_cases']))
                @php
                    // Remove extra quotes if the string is double-encoded as in your data
                    $useCasesRaw = $service['details']['use_cases'];

                    // Remove outer quotes if present (because your data has quotes wrapped)
                    if (is_string($useCasesRaw)) {
                        $useCasesRaw = trim($useCasesRaw, '"');
                        // Undo escaped quotes
                        $useCasesRaw = stripslashes($useCasesRaw);
                    }

                    $serviceUseCases = json_decode($useCasesRaw, true);
                @endphp

                @if (!empty($serviceUseCases) && is_array($serviceUseCases))
                    <section class="mb-28">
                        <h3 class="text-4xl font-bold text-slate-800 mb-12 text-center">
                            {{ $page->getTranslation('heading3', $lang) }}
                        </h3>
                        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6">
                            @foreach ($serviceUseCases as $useCase)
                                <div
                                    class="relative bg-slate-800 border border-slate-700 shadow-lg overflow-hidden p-8 flex items-center min-h-[120px] transition-all duration-300 hover:border-teal-500 hover:bg-slate-700 transform hover:-translate-y-1">
                                    <span class="text-teal-400 mr-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <div class="relative z-10 text-white text-lg font-medium">
                                        {{ $useCase['name'] ?? $useCase }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endif



            @if (!empty($service['details']['faq']))
                <section x-data="{ active: null }" class="mb-20 max-w-4xl mx-auto text-left">
                    <h3 class="text-4xl font-bold text-slate-800 mb-12 text-center">
                        {{ $page->getTranslation('title3', $lang) }}</h3>
                    @foreach ($service['details']['faq'] as $index => $faq)
                        <div class="border border-slate-200 bg-white shadow-sm  mb-3 transition-all duration-300"
                            :class="{ 'bg-slate-50 border-teal-300': active === {{ $index }} }">
                            <button @click="active === {{ $index }} ? active = null : active = {{ $index }}"
                                class="w-full flex justify-between items-center py-5 px-6 text-lg font-semibold text-slate-800 focus:outline-none"
                                type="button">
                                <span>{{ $faq['question'] }}</span>
                                <svg :class="{ 'rotate-180 text-teal-500': active === {{ $index }} }"
                                    class="w-6 h-6 transition-transform duration-300 text-slate-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="active === {{ $index }}" x-collapse
                                class="px-6 pb-5 border-t border-slate-200 text-slate-600 select-text" style="display:none">
                                <p class="pt-3">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </section>
            @endif

            <div class="text-center">
                <a href="{{ route('services.index') }}"
                    class="inline-block mt-12 px-10 py-4 bg-gradient-to-r from-[#2256ac] to-[#14b8a6] text-white  font-semibold shadow-lg hover:shadow-xl hover:from-[#1b3e71] hover:to-[#119b88] transition-all duration-300 transform hover:-translate-y-1 select-none">
                    ← Back to All Services
                </a>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {

            const serviceTitle = document.getElementById('service-title');
            const serviceSubtitle = document.getElementById('service-subtitle');
            if (serviceTitle) {
                gsap.from(serviceTitle.querySelectorAll('.char'), {
                    opacity: 0,
                    y: 40,
                    rotateX: -90,
                    stagger: 0.03,
                    duration: 1,
                    ease: 'power3.out',
                    delay: 0.5
                });
            }
            if (serviceSubtitle) {
                gsap.to(serviceSubtitle, {
                    opacity: 1,
                    y: 0,
                    duration: 1.2,
                    ease: 'power3.out',
                    delay: 1.2
                });
            }

            const glowWrapper = document.getElementById('bottom-glow-wrapper');
            if (glowWrapper) {
                gsap.to(glowWrapper, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1.6,
                    ease: 'power3.out',
                    delay: 0.3
                });

                gsap.to(glowWrapper, {
                    y: -120,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: 'section:first-of-type',
                        start: 'top top',
                        end: 'bottom top',
                        scrub: 1.5
                    }
                });
            }
        });
    </script>
@endsection
