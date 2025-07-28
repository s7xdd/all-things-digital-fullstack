<section class="bg-white py-16 md:py-24">
    @php
        $ourMission = json_decode($page->getTranslation('heading1', $lang), true) ?? [];
    @endphp

    <div class="max-w-5xl mx-auto px-4">
        @foreach ($ourMission as $index => $mission)
            <div class="grid md:grid-cols-2 gap-12 items-center mb-24">
                @if ($index % 2 !== 0)
                    <div class="{{ $index % 2 === 0 ? 'fade-right' : 'fade-left' }}">
                        <img src="{{ uploaded_asset($mission['image']) }}" alt="Mission Image"
                            class="rounded-lg shadow-lg w-full object-cover h-56 md:h-full" loading="lazy">
                    </div>
                @endif
                <div class="{{ $index % 2 === 0 ? 'fade-left' : 'fade-right' }}">
                    <h2 id="about-title" class="font-bold text-2xl md:text-3xl text-[#2256ac] mb-4">
                        {{ $mission['title'] ?? 'Title ' . ($index + 1) }}
                    </h2>
                    <p id="about-text" class="text-gray-700 font-normal leading-relaxed mb-3">
                        {!! $mission['description'] ?? 'Description ' . ($index + 1) !!}
                    </p>
                </div>
                @if ($index % 2 === 0)
                    <div class="{{ $index % 2 === 0 ? 'fade-right' : 'fade-left' }}">
                        <img src="{{ uploaded_asset($mission['image']) }}" alt="Mission Image"
                            class="rounded-lg shadow-lg w-full object-cover h-56 md:h-full" loading="lazy">
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
