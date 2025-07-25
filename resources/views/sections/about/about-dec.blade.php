<section id="about-dec"
    class="min-h-screen flex flex-col items-center justify-center bg-[#f8f9fc] py-16 relative overflow-hidden"
    style="background: url('{{ uploaded_asset($page->image6) }}') center/cover no-repeat;">

    <div class="flex flex-col items-center mb-10 relative z-10">
        <div class="relative">
            <img id="logo-icon" src="{{ uploaded_asset($page->image5) }}" alt="All Things Digital Icon"
                class="relative z-10 w-32 h-full opacity-0 translate-y-6" />
        </div>
    </div>

    <div class="text-center mb-8 mx-auto max-w-5xl relative z-10">
        <h2 id="animated-headline"
            class="animated-headline text-3xl md:text-4xl font-bold text-black tracking-tight leading-tight"
            data-splitting="lines">

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

    <div class="max-w-5xl mx-auto mb-8 relative z-10">
        <p id="animated-description" class="text-center text-base md:text-lg text-gray-700">
            {!! $page->getTranslation('content', $lang) !!}
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-4 mt-4 relative z-10">

        @php
            $types = json_decode($page->getTranslation('title3', $lang), true) ?: [];
            $types = array_column($types, 'value') ?? [];
        @endphp
        @foreach ($types as $type)
            <div
                class="fade-up-tag bg-[#e2e8f0] px-5 py-2 rounded-full text-blue-700 font-semibold text-sm shadow-sm border border-blue-100">
                {{ $type }}
            </div>
        @endforeach
    </div>

    <div id="bottom-glow"
        class="pointer-events-none absolute left-1/2 -translate-x-1/2 bottom-0 w-[400px] h-32 bg-blue-200 opacity-0 blur-2xl rounded-full scale-90 translate-y-8 z-0">
    </div>
</section>

<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        const logo = document.getElementById('logo-icon');
        if (logo) {
            gsap.to(logo, {
                opacity: 1,
                y: 0,
                duration: 1.2,
                ease: 'power3.out'
            });
        }

        const aboutHeadline = document.querySelector('.animated-headline[data-splitting]');
        if (aboutHeadline) {
            const lines = aboutHeadline.querySelectorAll('.line');
            gsap.set(lines, {
                opacity: 0,
                y: 50,
                color: '#1e293b'
            });

            gsap.to(lines, {
                opacity: 1,
                y: 0,
                color: "#0ea5e9",
                stagger: 0.12,
                duration: 0.9,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: aboutHeadline,
                    start: "top 85%",
                    once: true,
                }
            });
        }

        const aboutDesc = document.getElementById('animated-description');
        if (aboutDesc) {
            gsap.fromTo(aboutDesc, {
                opacity: 0,
                y: 30
            }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                delay: 0.3,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: aboutDesc,
                    start: "top 90%",
                    once: true,
                }
            });
        }

        const aboutTags = document.querySelectorAll('.fade-up-tag');
        if (aboutTags.length > 0) {
            gsap.utils.toArray(aboutTags).forEach((el, i) => {
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    delay: i * 0.05,
                    ease: "power1.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 95%",
                        once: true,
                    }
                });
            });
        }

        const bottomGlow = document.getElementById('bottom-glow');
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
