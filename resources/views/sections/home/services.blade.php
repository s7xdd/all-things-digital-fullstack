<section class="py-20 bg-white" id="services-section">
    <x-container>
        <div class="grid lg:grid-cols-2 gap-12">
            <div class="md:col-span-1" id="services-left" style="position:relative;">
                <div class="sticky top-28">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-snug">
                        {{ $page->getTranslation('heading3', $lang) }}
                    </h2>
                    <p class="mb-8 text-gray-600 text-sm font-normal leading-relaxed">
                        {{ $page->getTranslation('heading4', $lang) }}
                    </p>
                    <x-button-arrow href="{{ url('/services') }}" text="{{ $page->getTranslation('heading8', $lang) }}"
                        class="mt-1 w-max" />
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" id="services-cards">
                    @php
                        $cards = $services
                            ->map(function ($service) use ($lang) {
                                return [
                                    'title' => $service->getTranslation('name', $lang),
                                    'bg' => '#E8F1FF',
                                    'img' => $service->icon,
                                    'slug' => $service->slug,
                                    'short_description' => $service->getTranslation('short_description', $lang),
                                ];
                            })
                            ->toArray();
                    @endphp
                    @foreach ($cards as $card)
                        <a href="{{ route('services.show', ['slug' => $card['slug']]) }}"
                            class="group h-[260px] p-0 flex flex-col justify-between shadow-sm relative overflow-hidden transition hover:shadow-md service-card"
                            style="background: {{ $card['bg'] }};">
                            <div class="flex-1 flex items-center justify-center p-8">
                                <img src="{{ uploaded_asset($card['img']) }}" alt="{{ $card['title'] }}"
                                    class="h-[130px] w-auto" />
                            </div>
                            <div class="flex justify-between w-full items-end px-6 pb-5">
                                <span class="text-[17px] font-normal text-gray-900">
                                    {{ $card['title'] }}
                                </span>
                                <span
                                    class="w-9 h-9 flex items-center justify-center bg-white group-hover:bg-primary transition shadow-sm">
                                    <svg width="16" height="16" fill="none" stroke="currentColor"
                                        stroke-width="2" class="text-primary group-hover:text-white transition"
                                        viewBox="0 0 24 24">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-container>
</section>
