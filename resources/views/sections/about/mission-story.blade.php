<section class="bg-white pt-16 md:pt-24">
    @php
        $ourMission = json_decode($page->getTranslation('heading1', $lang), true) ?? [];
    @endphp

    <div class="max-w-5xl mx-auto px-4">
        @foreach ($ourMission as $index => $mission)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-16">
                @if ($index % 2 === 0)
                    {{-- Image left on md+, image above text on mobile --}}
                    <div class="fade-right order-first md:order-first">
                        <img src="{{ uploaded_asset($mission['image']) }}" alt="Mission Image"
                             class="rounded-lg shadow-lg w-full object-cover h-48 md:h-full" loading="lazy" />
                    </div>
                    <div class="fade-left order-last md:order-last">
                        <h2 class="font-bold text-2xl md:text-3xl text-[#2256ac] mb-4">
                            {{ $mission['title'] ?? 'Title ' . ($index + 1) }}
                        </h2>
                        <p class="text-gray-700 font-normal leading-relaxed mb-3">
                            {!! $mission['description'] ?? 'Description ' . ($index + 1) !!}
                        </p>
                    </div>
                @else
                    {{-- Image right on md+, image below text on mobile --}}
                    <div class="fade-left order-last md:order-first">
                        <img src="{{ uploaded_asset($mission['image']) }}" alt="Mission Image"
                             class="rounded-lg shadow-lg w-full object-cover h-48 md:h-full" loading="lazy" />
                    </div>
                    <div class="fade-right order-first md:order-last">
                        <h2 class="font-bold text-2xl md:text-3xl text-[#2256ac] mb-4">
                            {{ $mission['title'] ?? 'Title ' . ($index + 1) }}
                        </h2>
                        <p class="text-gray-700 font-normal leading-relaxed mb-3">
                            {!! $mission['description'] ?? 'Description ' . ($index + 1) !!}
                        </p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        gsap.utils.toArray('.fade-left').forEach((el) => {
            gsap.from(el, {
                x: -50,
                opacity: 0,
                duration: 1.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            });
        });

        gsap.utils.toArray('.fade-right').forEach((el) => {
            gsap.from(el, {
                x: 50,
                opacity: 0,
                duration: 1.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            });
        });
    });
</script>
