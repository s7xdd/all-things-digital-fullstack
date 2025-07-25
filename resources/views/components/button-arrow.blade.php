@props([
    'href' => '#',
    'text' => 'Learn More',
    'variant' => 'light',
    'class' => '',
])

@php
    $isDark = $variant === 'dark';

    $base = 'group inline-flex items-center  px-6 py-2 border font-normal relative overflow-hidden transition-all duration-400 ease-in-out';
    $rootLight = 'border-gray-400 bg-white text-gray-900 hover:border-primary';
    $rootDark  = 'border-primary bg-primary text-white hover:bg-white hover:text-primary hover:border-primary';

    $bgLight = 'absolute inset-0 bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-in-out origin-left z-0';
    $bgDark  = 'absolute inset-0 bg-white scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-in-out origin-left z-0';

    $textLight = 'relative z-10 font-normal transition-colors duration-400 ease-in-out group-hover:text-white';
    $textDark  = 'relative z-10 font-normal transition-colors duration-400 ease-in-out group-hover:text-primary';
@endphp

<a href="{{ $href }}"
   class="{{ $base }} {{ $isDark ? $rootDark : $rootLight }} {{ $class }}">
    <div class="{{ $isDark ? $bgDark : $bgLight }}"></div>
    <span class="{{ $isDark ? $textDark : $textLight }}">
        {{ $text }}
    </span>
    <span class="relative z-10 ml-2 sm:ml-3 h-5 w-5 flex items-center font-normal">
        @if($isDark)
            <img src="/images/icons/arrow-right-white.svg"
                 alt=""
                 class="absolute inset-0 h-5 w-5 transition-all duration-400 ease-in-out group-hover:opacity-0" />
            <img src="/images/icons/arrow-right-black.svg"
                 alt=""
                 class="absolute inset-0 h-5 w-5 opacity-0 transition-all duration-400 ease-in-out group-hover:opacity-100" />
        @else
            <img src="/images/icons/arrow-right-black.svg"
                 alt=""
                 class="absolute inset-0 h-5 w-5 transition-all duration-400 ease-in-out group-hover:opacity-0" />
            <img src="/images/icons/arrow-right-white.svg"
                 alt=""
                 class="absolute inset-0 h-5 w-5 opacity-0 transition-all duration-400 ease-in-out group-hover:opacity-100" />
        @endif
    </span>
</a>
