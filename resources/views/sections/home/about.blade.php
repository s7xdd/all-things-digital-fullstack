<section class="py-20 bg-white" id="about-section">
    <x-container>

        @php
            $stats = json_decode($page->getTranslation('heading10', $lang), true) ?? [];
        @endphp

        <div class="flex flex-col md:flex-col md:space-y-5 lg:flex-row lg:space-x-5 lg:items-start">
            <div class="md:w-full lg:w-1/2 mb-10 md:mb-0 flex-shrink-0" id="about-title">
                <h2 class="text-2xl md:text-3xl xl:text-4xl font-bold text-gray-900 leading-snug mb-4">
                    {{ $page->getTranslation('heading5', $lang) }}
                </h2>
            </div>

            <div class="md:w-full lg:w-1/2 flex flex-col space-y-5 justify-center" id="about-text">
                <p class="antialiased text-base font-normal md:text-lg text-gray-700 leading-relaxed">
                    {{ $page->getTranslation('heading6', $lang) }}
                </p>
                <div id="about-button" class="mt-4">
                    <x-button-arrow href="{{ url('/about') }}" text="{{ $page->getTranslation('title1', $lang) }}" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-20" id="about-stats">
            @for ($i = 0; $i < 4; $i++)
                @if (!empty($stats[$i]['title']))
                    <div class="text-left">
                        <div id="counter-{{ $i }}" class="text-6xl font-normal text-gray-900 mb-2 counter"
                             data-count="{{ $stats[$i]['title'] ?? '' }}" data-suffix="%">{{ $stats[$i]['title'] ?? '' }}</div>
                        <div class="text-gray-500 font-normal text-base">{{ $stats[$i]['description'] ?? '' }}</div>
                    </div>
                @endif
            @endfor
        </div>

    </x-container>
</section>
