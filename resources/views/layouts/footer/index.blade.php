<footer class="bg-[#003380] text-white pt-12 pb-6">
    <x-container>
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-12">
            <div class="flex flex-col gap-6 md:w-1/3">
                <div class="flex items-center gap-3">
                    <img src={{ uploaded_asset(get_setting('footer_logo')) }} alt="All Things Digital Logo"
                        class="h-10 w-auto" />
                </div>


                @php
                    $socialLinks = [
                        'facebook_link' => '/images/icons/facebook.svg',
                        'twitter_link' => '/images/icons/x.svg',
                        'instagram_link' => '/images/icons/instagram.svg',
                        'linkedin_link' => '/images/icons/linkedin.svg',
                    ];
                @endphp
                <div class="flex items-center gap-5 mt-5">
                    @foreach ($socialLinks as $key => $icon)
                        <a href="{{ get_setting($key) }}">
                            <img src="{{ $icon }}" alt="LinkedIn" class="w-5 h-5 social-icon" />

                        </a>
                    @endforeach
                </div>
            </div>


            @foreach ($menu_items as $item)
                <div class="md:w-1/3">
                    <h4 class="mb-1 font-normal text-gray-100"> {{ $item->label }}</h4>
                    <ul class="space-y-1 text-gray-200 text-sm">
                        @if (isset($item->child) && $item->child->isNotEmpty())
                            @foreach ($item->child as $child)
                                <li><a href="{{ url($child->link) }}" class="hover:text-white">
                                        {{ $child->label }}
                                    </a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endforeach

            <div class="md:w-1/3">
                <h4 class="mb-1 font-normal text-gray-100">{{ get_setting('footer_contact_title') }}</h4>
                <p class="text-gray-200 text-sm mb-2 break-all">{{ get_setting('footer_email') }}</p>
                <h4 class="mt-4 mb-1 font-normal text-gray-100">{{ get_setting('footer_address_title') }}</h4>
                <p class="text-gray-200 text-sm">
                    {{ get_setting('footer_address') }}
                </p>
            </div>

        </div>
        <hr class="my-6 border-white/30">
        <div class="flex flex-col md:flex-row md:justify-between items-center text-xs text-gray-100">
            <div>
                &copy; {{ date('Y') }} All Things Digital. All rights reserved
            </div>
            <div class="mt-2 md:mt-0">
                Designed by <a href="https://tomsher.com" target="_blank" rel="noopener noreferrer">Tomsher</a>
            </div>
        </div>
    </x-container>
</footer>
