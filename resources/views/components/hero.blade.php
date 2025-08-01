@props([
    'title' => '',
    'subtitle' => null,
    'bg' => 'linear-gradient(to bottom, #131e42, #0a146e, #01163a)',
    'topShape' => null,
    'glowImage' => null,
])

<section {{ $attributes->merge([
    'class' => 'relative h-[60vh] flex items-center justify-center overflow-hidden',
    'style' => "background: {$bg}"
]) }}>
    {{-- Decorative top shape --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1200px] pointer-events-none z-0 opacity-70">
        <img src="{{ $topShape ?? asset('images/shape-top.svg') }}" alt="Decorative Shape" class="w-full" />
    </div>

    {{-- Glow background --}}
    <div id="bottom-glow-wrapper" class="absolute bottom-16 left-1/2 -translate-x-1/2 w-full max-w-[900px] pointer-events-none z-0 opacity-0 scale-90 translate-y-8">
        <img src="{{ $glowImage ?? asset('images/bg-about.svg') }}" alt="Glow Background" class="w-full" />
    </div>

    {{-- Text container --}}
    <div class="relative z-10 max-w-3xl w-full mx-auto px-6 flex flex-col items-center justify-end h-full text-center pb-12 sm:pb-16 md:pb-24">
        <h1 class="text-white font-normal select-none leading-tight mb-5 text-3xl md:text-6xl">{!! $title !!}</h1>
        @if ($subtitle)
            <p class="text-white/80 font-normal text-lg md:text-xl max-w-xl">{!! $subtitle !!}</p>
        @endif
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const glowWrapper = document.getElementById('bottom-glow-wrapper');
        if (glowWrapper) {
            // Initial fade and scale in with 3s duration, then infinite vertical float
            gsap.to(glowWrapper, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 3,
                ease: 'power2.out',
                delay: 0.2,
                onComplete: () => {
                    gsap.to(glowWrapper, {
                        y: -20,
                        duration: 3,
                        ease: 'power1.inOut',
                        repeat: -1,
                        yoyo: true,
                    });
                }
            });
            // Optional: if you want scroll-triggered movement on the glow as well, you can add here
        }
    });
</script>
