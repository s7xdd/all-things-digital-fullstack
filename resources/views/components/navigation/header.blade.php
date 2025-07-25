<header id="main-header"
    class="!bg-transparent font-[--font-aspekta] font-light fixed top-0 left-0 w-full z-50 py-7 px-6 lg:px-0 text-white transition-all duration-300">
    <div class="lg:w-5/6 mx-auto flex justify-between items-center">


        <a href="/" class="flex items-center">
            <img id="header-logo" src="{{ uploaded_asset(get_setting('site_logo_white')) }}"
                data-logo-white="{{ uploaded_asset(get_setting('site_logo_white')) }}"
                data-logo-colored="{{ uploaded_asset(get_setting('site_logo_colored')) }}"
                alt="{{ env('APP_NAME') }} Logo" class="h-[54px] w-auto transition-all duration-300">
        </a>

        <nav class="max-[1100px]:hidden">
            <ul id="header-nav" class="flex space-x-7 font-light text-[17px]">

                @foreach ($menu_items as $item)
                    <li class="relative group">
                        <a href="{{ url($item->link) }}"
                            class="hover:text-gray-300 flex items-center gap-1 {{ request()->is(ltrim($item->link, '/')) ? 'menu-active' : '' }}">
                            {{ $item->label }}
                        </a>

                        @if (!empty($item->children) && $item->children->isNotEmpty())
                            <ul
                                class="absolute left-0 top-full min-w-[180px] bg-white text-gray-800 rounded-lg shadow-lg py-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 z-20">
                                @foreach ($item->children as $child)
                                    <li>
                                        <a href="{{ url($child->link) }}"
                                            class="block px-4 py-2 hover:bg-gray-100">{{ $child->label }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

        </nav>

        <div class="flex justify-end">
            <a href="{{ route('contact') }}" id="header-btn"
                class="bg-white text-[--dark] px-6 py-3 font-normal hover:bg-gray-100 rounded-full transition-all duration-300">
                Get Started
            </a>

            <button id="hamburger-menu"
                class="min-[1101px]:hidden relative flex flex-col justify-center items-center w-12 h-12 rounded-full z-50"
                aria-label="Toggle menu">
                <span
                    class="w-8 h-0.5 bg-white my-[3px] absolute transition-transform duration-300 origin-center top-line"></span>
                <span class="w-8 h-0.5 bg-white my-[3px] absolute transition-opacity duration-300 middle-line"></span>
                <span
                    class="w-8 h-0.5 bg-white my-[3px] absolute transition-transform duration-300 origin-center bottom-line"></span>
            </button>
        </div>
    </div>
</header>

<div id="mobile-menu"
    class="fixed top-0 left-0 w-full h-full bg-[--primary] text-white z-40 flex flex-col items-center justify-center transform -translate-y-full transition-transform duration-500 ease-in-out">
    <ul class="flex flex-col space-y-8 text-2xl text-center">
        @foreach ($menu_items as $item)
            <li>
                <a href="{{ url($item->link) }}" class="hover:text-gray-300">
                    {{ $item->label }}
                </a>

                @if (!empty($item->children) && $item->children->isNotEmpty())
                    <ul class="mt-2 space-y-2 text-sm">
                        @foreach ($item->children as $child)
                            <li>
                                <a href="{{ url($child->link) }}" class="hover:text-gray-300">
                                    {{ $child->label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

        <li>
            <button
                class="bg-white text-[--dark] px-8 py-4 font-normal hover:bg-gray-100 rounded-full transition-all duration-300 text-lg">
                Get Started
            </button>
        </li>
    </ul>
</div>
