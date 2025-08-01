<section class="{{ $bg ?? 'relative -mt-[100px] h-[60vh] flex items-center justify-center bg-gradient-to-b from-[#131e66] via-[#1c2d9a] to-[#01132f]' }}">
    <!-- Creative Bottom Glow Effect (Page Load + Parallax) -->
    <div id="bottom-glow-wrapper"
         class="absolute bottom-16 left-1/2 -translate-x-1/2 w-full max-w-[900px] pointer-events-none z-0 opacity-0 scale-90 translate-y-8">
        <img src="/images/bg-about.svg" alt="Decorative Glow" class="w-full" />
    </div>

    <!-- Section Content -->
    <div class="relative z-10 max-w-3xl w-full mx-auto text-center px-4">
        <h1 class="{{ $titleClass ?? 'text-white font-normal text-3xl md:text-5xl leading-tight mb-5' }}">
            {{ $title }}
        </h1>

        @isset($subtitle)
            <p class="text-white/80 text-lg md:text-xl font-normal mb-6">
                {{ $subtitle }}
            </p>
        @endisset
    </div>
</section>

<script type="module">

document.addEventListener('DOMContentLoaded', () => {
    const glowWrapper = document.getElementById('bottom-glow-wrapper');

    if (glowWrapper) {
        // Page load fade + rise animation
        gsap.to(glowWrapper, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out',
            delay: 0.2 // slight delay for smooth intro
        });

        // Parallax scroll effect (after it's visible)
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
    }
});
</script>
