<section id="trusted-section" class="py-12 md:py-20"
    style="background: linear-gradient(to right, #DEF4FF 0%, #F8F8F8 100%);">
    <x-container>
        <h3 id="trusted-heading" class="text-center text-[#38A4DC] text-xl md:text-3xl font-normal mb-10">
            {{ $page->getTranslation('title2', $lang) }}
        </h3>
        <div id="leaders-swiper" class="swiper w-full">
            <div class="swiper-wrapper" id="trusted-logos">

                @foreach ($partners as $partner)
                    <div class="swiper-slide flex items-center justify-center">
                        <img src="{{ uploaded_asset($partner['image']) }}" alt="Leader Logo {{ $partner->title }}"
                            class="opacity-70 h-auto transition duration-300 ease-in-out hover:opacity-100 hover:scale-105" />
                    </div>
                @endforeach
            </div>
        </div>
    </x-container>
</section>
