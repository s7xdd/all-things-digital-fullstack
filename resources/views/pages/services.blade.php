@extends('layouts.app')

@section('title', 'Our Services - ' . env('APP_NAME'))

@section('content')

    {{-- Hero Section --}}
    <section class="relative -mt-[100px] h-[60vh] flex items-center justify-center bg-gradient-to-b from-[#131e66] via-[#1c2d9a] to-[#01132f] overflow-hidden">

        {{-- Decorative Top Shape --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1200px] pointer-events-none z-0 opacity-70">
            <img src="{{ asset('images/shape-top.svg') }}" alt="Top Decorative Shape" class="w-full" />
        </div>

        {{-- Glow Background --}}
        <div id="bottom-glow-wrapper" class="absolute bottom-16 left-1/2 -translate-x-1/2 w-full max-w-[900px] pointer-events-none z-0 opacity-0 scale-90 translate-y-8">
            <img src="{{ asset('images/bg-about.svg') }}" alt="Decorative Glow" class="w-full" />
        </div>

        {{-- Hero Text --}}
        <div class="relative z-10 max-w-3xl w-full mx-auto px-6 flex flex-col items-center justify-end h-full text-center pb-12 sm:pb-16 md:pb-24">
            <h1 class="text-white font-normal text-3xl md:text-6xl leading-tight mb-5 select-none">
                {{ $page->getTranslation('title', $lang) }}
            </h1>
            <p class="text-white/80 text-lg md:text-xl font-normal max-w-xl">
                {{ $page->getTranslation('sub_title', $lang) }}
            </p>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="relative py-8 sm:py-16 md:py-24 bg-gradient-to-b from-[#f8f9fc] via-[#eaf3fe] to-[#e3eaf3] overflow-hidden">

        {{-- Background Decorations --}}
        <div class="absolute top-0 left-0 w-full max-w-[1200px] pointer-events-none z-0 opacity-10">
            <img src="{{ asset('images/shape-top.svg') }}" alt="Background Decoration" class="w-full" style="min-height:120px;" />
        </div>

        <svg class="absolute top-0 left-0 w-56 h-56 -translate-x-1/2 -translate-y-1/2 opacity-10 pointer-events-none" viewBox="0 0 200 200">
            <defs>
                <radialGradient id="grad" cx="50%" cy="50%" r="50%">
                    <stop stop-color="#1c2d9a" stop-opacity="0.22" offset="0%" />
                    <stop stop-color="#f0f4fd" stop-opacity="0" offset="100%" />
                </radialGradient>
            </defs>
            <circle cx="100" cy="100" r="100" fill="url(#grad)" />
        </svg>

        {{-- Services List --}}
        <x-container>
            @php
                $backgroundVariants = ['#E8F1FF', '#E8F7FF', '#D9F2FF', '#E2F3FB', '#EAF8FF', '#E8F8FB'];
                $services = $services->map(function ($service, $index) use ($backgroundVariants) {
                    $service->bg = $backgroundVariants[$index % count($backgroundVariants)];
                    return $service;
                });
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-14">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service->slug) }}" 
                       class="group relative bg-white rounded-lg shadow-md p-5 flex flex-col sm:flex-row items-center gap-4 overflow-hidden"
                       style="background-color: {{ $service->bg }}; min-height: 300px; transition: box-shadow 0.3s ease;">
                        
                        {{-- Icon --}}
                        <div class="flex-shrink-0">
                            <img src="{{ uploaded_asset($service->icon) }}" alt="{{ $service->name }}" 
                                 class="w-20 h-20 md:w-24 md:h-24 object-contain transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6" />
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 max-w-full">
                            <h3 class="text-gray-900 text-xl md:text-2xl font-semibold mb-2 group-hover:text-[#2256ac] transition-colors duration-300">
                                {{ $service->name }}
                            </h3>
                            <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                                {{ $service->getTranslation('short_description', $lang) }}
                            </p>
                        </div>

                        {{-- Arrow icon bottom right --}}
                        <span class="absolute bottom-4 right-4 flex items-center justify-center w-8 h-8 bg-white shadow-sm transition-colors group-hover:bg-[#2256ac] group-hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-6l7 6-7 6" />
                            </svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </x-container>
    </section>

@endsection

@section('script')
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        const glowWrapper = document.getElementById('bottom-glow-wrapper');

        if (glowWrapper) {
            // Initial fade and scale up of glow
            gsap.to(glowWrapper, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 3,
                ease: 'power2.out',
                delay: 0.2,
                onComplete: () => {
                    // Animate glowing background floating up/down infinitely
                    gsap.to(glowWrapper, {
                        y: -20,
                        duration: 3,
                        ease: "power1.inOut",
                        repeat: -1,
                        yoyo: true,
                    });
                }
            });

            // Optional: scroll-linked vertical animation - currently disabled to avoid conflict with floating
            /*
            gsap.to(glowWrapper, {
                y: -80,
                ease: 'none',
                scrollTrigger: {
                    trigger: glowWrapper,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
            */
        }
    });
</script>
@endsection
