<section
    id="about-dec"
    class="min-h-screen flex flex-col items-center justify-center bg-[#f8f9fc] py-16 relative overflow-hidden"
    style="background: url('{{ uploaded_asset($page->image6) }}') center/cover no-repeat;"
>

    <!-- Logo Glow and Icon -->
    <div class="flex flex-col items-center mb-10 relative z-10">
        <div class="relative">
            <img
                id="logo-icon"
                src="{{ uploaded_asset($page->image5) }}"
                alt="All Things Digital Icon"
                class="relative z-10 w-24 sm:w-28 md:w-32 h-auto opacity-0 translate-y-6"
            />
        </div>
    </div>

    <!-- Animated Heading -->
    <div class="text-center mb-8 mx-auto max-w-5xl relative z-10 px-6 sm:px-8 md:px-0">
        <h2
            id="animated-headline"
            class="animated-headline text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-black tracking-tight leading-tight"
            data-splitting="lines"
        >
            @php
                $text = $page->getTranslation('title2', $lang);
                $formattedText = preg_replace(
                    '/\[(.*?)\]/',
                    '<span class="bg-gradient-to-r from-[#4ea7f3] via-[#3b82f6] to-[#1e40af] bg-clip-text text-transparent font-extrabold">$1</span>',
                    $text,
                );
            @endphp
            {!! $formattedText !!}
        </h2>
    </div>

    <!-- Description Paragraph -->
    <div id="animated-description" class="max-w-6xl mx-auto mb-8 relative z-10">
        <p
            
            class="text-center  px-6 text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed text-gray-700 mx-auto"
        >
            {!! $page->getTranslation('content', $lang) !!}
        </p>
    </div>

    <!-- Feature / Tag Cloud -->
    <div class="flex flex-wrap justify-center gap-3 sm:gap-4 mt-4 relative z-10 px-6 sm:px-8 md:px-0">
        @php
            $types = json_decode($page->getTranslation('title3', $lang), true) ?: [];
            $types = is_array($types) ? array_column($types, 'value') : [];
        @endphp
        @foreach ($types as $type)
            <div
                class="fade-up-tag bg-[#e2e8f0] px-5 py-2 rounded-full text-blue-700 font-semibold text-xs sm:text-sm shadow-sm border border-blue-100"
            >
                {{ $type }}
            </div>
        @endforeach
    </div>

    <!-- Subtle Glow Effect at the Bottom (Parallax) -->
    <div
        id="bottom-glow"
        class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-0 w-56 sm:w-64 md:w-80 lg:w-[400px] h-16 sm:h-20 md:h-24 lg:h-32 bg-blue-200 opacity-0 blur-2xl rounded-full scale-90 translate-y-8 z-0"
    ></div>
</section>

<script type="module">
document.addEventListener('DOMContentLoaded', () => {
    const logo = document.getElementById('logo-icon');
    const aboutHeadline = document.querySelector('.animated-headline[data-splitting]');
    const aboutDesc = document.getElementById('animated-description');
    const aboutTags = document.querySelectorAll('.fade-up-tag');
    const bottomGlow = document.getElementById('bottom-glow');

    // Pre-set styles to prevent flicker before animation
    if (logo) gsap.set(logo, { opacity: 0, y: 6 });
    if (aboutHeadline) {
        const lines = aboutHeadline.querySelectorAll('.line');
        gsap.set(lines, { opacity: 0, y: 50, color: '#1e293b' });
    }
    if (aboutDesc) gsap.set(aboutDesc, { opacity: 0, y: 30 });
    if (aboutTags.length > 0) gsap.set(aboutTags, { opacity: 0, y: 20 });
    if (bottomGlow) gsap.set(bottomGlow, { opacity: 0, y: 8, scale: 0.9 });

    // Animate logo
    if (logo) {
        gsap.to(logo, {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: 'power3.out'
        });
    }

    // Animate headline lines
    if (aboutHeadline) {
        const lines = aboutHeadline.querySelectorAll('.line');
        gsap.to(lines, {
            opacity: 1,
            y: 0,
            color: '#0ea5e9',
            stagger: 0.12,
            duration: 0.9,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: aboutHeadline,
                start: 'top 85%',
                once: true
            }
        });
    }

    // Animate description
    if (aboutDesc) {
        gsap.to(aboutDesc, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.3,
            ease: "power2.out",
            scrollTrigger: {
                trigger: aboutDesc,
                start: "top 90%",
                once: true
            }
        });
    }

    // Animate tags
    if (aboutTags.length > 0) {
        gsap.utils.toArray(aboutTags).forEach((el, i) => {
            gsap.to(el, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                delay: i * 0.05,
                ease: "power1.out",
                scrollTrigger: {
                    trigger: el,
                    start: "top 95%",
                    once: true
                }
            });
        });
    }

    // Animate bottom glow
    if (bottomGlow) {
        gsap.to(bottomGlow, {
            opacity: 0.3,
            y: 0,
            scale: 1,
            duration: 1.5,
            ease: 'power3.out'
        });

        gsap.to(bottomGlow, {
            y: -40,
            ease: 'none',
            scrollTrigger: {
                trigger: bottomGlow,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true
            }
        });
    }
});
</script>
