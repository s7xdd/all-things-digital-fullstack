<section class="py-16 md:py-24 bg-[#2256ac]" id="why-section">
    @php
        $whyChoose = json_decode($page->getTranslation('content1', $lang), true) ?? [];
    @endphp

    <x-container>
        <h2 id="why-title" class="text-white font-bold text-2xl md:text-3xl text-center mb-5">
            {{ $page->getTranslation('heading9', $lang) }}
        </h2>
        <p id="why-subtext" class="text-white/80 text-center max-w-3xl mx-auto mb-14 font-normal">
            {{ $page->getTranslation('content5', $lang) }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8 xl:gap-14 max-w-6xl mx-auto" id="why-cards">

            @foreach ($whyChoose as $item)
                <div
                    class="why-card bg-white shadow-lg px-4 py-6 flex flex-col items-center text-center transition duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    <img src="{{ uploaded_asset($item['image']) }}" alt="{{ $item['title'] }}"
                        class="h-[150px] mb-4 object-contain" />
                    <h3 class="font-semibold text-gray-900 text-lg mb-3">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-gray-700 font-normal text-[15px] leading-relaxed">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach


        </div>
    </x-container>
</section>
