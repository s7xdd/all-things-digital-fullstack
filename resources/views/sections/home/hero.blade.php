<section class="relative w-full min-h-screen -mt-[100px] overflow-hidden bg-black">
    <div id="hero-swiper" class="swiper min-h-screen">
        <div class="swiper-wrapper">
            @foreach ($slider as $slide)
                @php
                    $video = $slide['video_file'] ? asset('storage/' . $slide['video_file']) : null;
                    $image = !$video && $slide['image'] ? uploaded_asset($slide['image']) : null;
                @endphp

                <div class="swiper-slide relative min-h-screen block">
                    @if ($video)
                        <video autoplay muted loop playsinline preload="auto"
                            class="absolute inset-0 w-full h-full object-cover opacity-90">
                            <source src="{{ $video }}" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video>
                    @elseif ($image)
                        <img src="{{ $image }}" alt="{{ $slide['name'] }}"
                            class="absolute inset-0 w-full h-full object-cover opacity-90" />
                    @else
                        <div class="absolute inset-0 w-full h-full bg-gray-900 opacity-90"></div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/90"></div>

                    <div class="absolute bottom-0 left-0 z-10 w-full flex">
                        <div class="max-w-2xl w-full pb-8 sm:pb-14 px-3 sm:px-6 lg:pl-16"
                            id="hero-slide-content-{{ $slide['id'] }}">
                            @if ($slide['name'])
                                <h1
                                    class="gsap-animate split-text text-2xl sm:text-3xl md:text-5xl font-bold mb-6 sm:mb-8 text-white leading-tight">
                                    @php
                                        $text = $slide['name'];
                                        $formattedText = preg_replace(
                                            '/\[(.*?)\]/',
                                            '<span class="text-primary">$1</span>',
                                            $text,
                                        );
                                    @endphp

                                    {!! $formattedText !!}
                                </h1>
                            @endif

                            @if ($slide['button1_text'] && $slide['button1_link'])
                                <x-button-arrow href="{{ $slide['button1_link'] }}" text="{{ $slide['button1_text'] }}"
                                    class="text-base sm:text-lg border-white bg-white text-gray-900 font-semibold rounded-none transition hover:bg-primary hover:text-white hover:border-primary" />
                            @endif

                            @if ($slide['button2_text'] && $slide['button2_link'])
                                <x-button-arrow href="{{ $slide['button2_link'] }}" text="{{ $slide['button2_text'] }}"
                                    class="text-base sm:text-lg border-white bg-white text-gray-900 font-semibold rounded-none transition hover:bg-primary hover:text-white hover:border-primary" />
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="absolute hidden bottom-9 sm:bottom-16 right-9 sm:right-24 md:flex gap-2 z-20">
            <button id="hero-swiper-prev"
                class="swiper-button-prev absolute !-left-[120px] !w-[50px] !h-[50px] bg-transparent border border-white text-white flex items-center justify-center hover:bg-primary hover:text-black hover:border-white transition"
                type="button" aria-label="Previous slide">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="hero-swiper-next"
                class="swiper-button-next !w-[50px] !h-[50px] bg-transparent border border-white text-white flex items-center justify-center hover:bg-primary hover:text-black hover:border-white transition"
                type="button" aria-label="Next slide">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-1.5 z-20">
            <div class="swiper-progressbar bg-white/20 w-full h-full">
                <div id="hero-swiper-progress" class="bg-primary transition-all h-full w-0"></div>
            </div>
        </div>
    </div>
</section>
