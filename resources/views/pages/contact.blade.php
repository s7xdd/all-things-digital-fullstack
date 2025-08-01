@extends('layouts.app')

@section('title', 'Contact Us - ' . env('APP_NAME'))

@section('content')

    <x-hero 
        title="{{ $page->getTranslation('title', $lang) }}" 
        subtitle="{!! $page->getTranslation('sub_title', $lang) !!}" 
    />

    <section class="relative py-16 sm:py-20 md:py-24 bg-gradient-to-b from-[#f8f9fc] via-[#eaf3fe] to-[#e5e9f7] overflow-hidden">
        <div class="absolute left-0 right-0 bottom-0 w-full pointer-events-none z-0">
            <img 
                src="{{ asset('images/shape-grid-bottom-1.svg') }}" 
                alt="Decorative Grid Bottom Shape"
                class="w-full object-cover" 
                style="min-height:120px;">
        </div>

        <svg class="absolute top-0 left-0 w-44 h-44 -translate-x-1/2 -translate-y-1/2 opacity-10 pointer-events-none" 
             viewBox="0 0 200 200" >
            <defs>
                <radialGradient id="radGrad1" cx="50%" cy="50%" r="50%">
                    <stop stop-color="#1c2d9a" stop-opacity="0.22" offset="0%" />
                    <stop stop-color="#f8f9fc" stop-opacity="0" offset="100%" />
                </radialGradient>
            </defs>
            <circle cx="100" cy="100" r="100" fill="url(#radGrad1)" />
        </svg>

        <x-container>
            <div class="relative grid md:grid-cols-2 gap-4 md:gap-6 items-start z-10">

                <!-- Info Block -->
                <div class="space-y-6 bg-white/90 rounded-xl p-8 shadow-lg border border-[#e5e9f7]">
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#1e293b] leading-snug">
                        {{ $page->getTranslation('heading2', $lang) }}
                    </h2>
                    <p class="text-gray-600 text-base leading-relaxed">
                        {!! $page->getTranslation('content', $lang) !!}
                    </p>
                    <div class="space-y-4 text-gray-700 text-sm font-medium">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center bg-[#1c2d9a] rounded-full w-8 h-8 text-white">
                      

                                <svg class="!w-4 !h-4" fill="white" id="fi_2099100" enable-background="new 0 0 511.998 511.998" height="512" viewBox="0 0 511.998 511.998" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m511.998 111.383c0-25.98-21.137-47.117-47.117-47.117h-417.764c-25.975.001-47.108 21.128-47.117 47.125v.008 289.199c0 26.305 21.352 47.133 47.133 47.133h417.731c26.304 0 47.133-21.351 47.133-47.133v-289.199c0-.002 0-.004 0-.006.001-.003.001-.006.001-.01zm-464.881-17.116h417.764c9.438 0 17.117 7.679 17.117 17.141 0 5.028-2.499 9.695-6.689 12.487l-209.805 139.876c-5.773 3.849-13.235 3.85-19.009 0 0 0-209.81-139.879-209.806-139.876.001.001-.003-.002-.004-.003-4.186-2.789-6.685-7.456-6.685-12.509 0-9.438 7.679-17.116 17.117-17.116zm417.748 323.464h-417.732c-9.339 0-17.133-7.551-17.133-17.133v-245.106l199.853 133.239c7.942 5.295 17.044 7.942 26.146 7.942 9.103 0 18.206-2.647 26.147-7.942l199.852-133.239v245.107c0 9.338-7.551 17.132-17.133 17.132z"></path></svg>


                            </span>
                            <span>
                                <strong>Email:</strong> {{ get_setting('footer_email') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center bg-[#1c2d9a] rounded-full w-8 h-8 text-white">
           
                                <svg class="w-4 h-4" fill="white" version="1.1" id="fi_159832" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 482.6 482.6" style="enable-background:new 0 0 482.6 482.6;" xml:space="preserve">
<g>
	<path d="M98.339,320.8c47.6,56.9,104.9,101.7,170.3,133.4c24.9,11.8,58.2,25.8,95.3,28.2c2.3,0.1,4.5,0.2,6.8,0.2
		c24.9,0,44.9-8.6,61.2-26.3c0.1-0.1,0.3-0.3,0.4-0.5c5.8-7,12.4-13.3,19.3-20c4.7-4.5,9.5-9.2,14.1-14
		c21.3-22.2,21.3-50.4-0.2-71.9l-60.1-60.1c-10.2-10.6-22.4-16.2-35.2-16.2c-12.8,0-25.1,5.6-35.6,16.1l-35.8,35.8
		c-3.3-1.9-6.7-3.6-9.9-5.2c-4-2-7.7-3.9-11-6c-32.6-20.7-62.2-47.7-90.5-82.4c-14.3-18.1-23.9-33.3-30.6-48.8
		c9.4-8.5,18.2-17.4,26.7-26.1c3-3.1,6.1-6.2,9.2-9.3c10.8-10.8,16.6-23.3,16.6-36s-5.7-25.2-16.6-36l-29.8-29.8
		c-3.5-3.5-6.8-6.9-10.2-10.4c-6.6-6.8-13.5-13.8-20.3-20.1c-10.3-10.1-22.4-15.4-35.2-15.4c-12.7,0-24.9,5.3-35.6,15.5l-37.4,37.4
		c-13.6,13.6-21.3,30.1-22.9,49.2c-1.9,23.9,2.5,49.3,13.9,80C32.739,229.6,59.139,273.7,98.339,320.8z M25.739,104.2
		c1.2-13.3,6.3-24.4,15.9-34l37.2-37.2c5.8-5.6,12.2-8.5,18.4-8.5c6.1,0,12.3,2.9,18,8.7c6.7,6.2,13,12.7,19.8,19.6
		c3.4,3.5,6.9,7,10.4,10.6l29.8,29.8c6.2,6.2,9.4,12.5,9.4,18.7s-3.2,12.5-9.4,18.7c-3.1,3.1-6.2,6.3-9.3,9.4
		c-9.3,9.4-18,18.3-27.6,26.8c-0.2,0.2-0.3,0.3-0.5,0.5c-8.3,8.3-7,16.2-5,22.2c0.1,0.3,0.2,0.5,0.3,0.8
		c7.7,18.5,18.4,36.1,35.1,57.1c30,37,61.6,65.7,96.4,87.8c4.3,2.8,8.9,5,13.2,7.2c4,2,7.7,3.9,11,6c0.4,0.2,0.7,0.4,1.1,0.6
		c3.3,1.7,6.5,2.5,9.7,2.5c8,0,13.2-5.1,14.9-6.8l37.4-37.4c5.8-5.8,12.1-8.9,18.3-8.9c7.6,0,13.8,4.7,17.7,8.9l60.3,60.2
		c12,12,11.9,25-0.3,37.7c-4.2,4.5-8.6,8.8-13.3,13.3c-7,6.8-14.3,13.8-20.9,21.7c-11.5,12.4-25.2,18.2-42.9,18.2
		c-1.7,0-3.5-0.1-5.2-0.2c-32.8-2.1-63.3-14.9-86.2-25.8c-62.2-30.1-116.8-72.8-162.1-127c-37.3-44.9-62.4-86.7-79-131.5
		C28.039,146.4,24.139,124.3,25.739,104.2z"></path>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>



                            </span>

                            <span>
                                <strong>Phone:</strong> {{ get_setting('footer_phone') }}
                            </span>
                        </div>
                        
                 <div class="flex items-start gap-3">
  <span class="inline-flex flex-shrink-0 items-center justify-center bg-[#1c2d9a] rounded-full w-8 h-8 text-white mt-1">


    <svg class="w-5 h-5" fill="white" stroke="currentColor" version="1.1" id="fi_684809" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M256,0C156.748,0,76,80.748,76,180c0,33.534,9.289,66.26,26.869,94.652l142.885,230.257
			c2.737,4.411,7.559,7.091,12.745,7.091c0.04,0,0.079,0,0.119,0c5.231-0.041,10.063-2.804,12.75-7.292L410.611,272.22
			C427.221,244.428,436,212.539,436,180C436,80.748,355.252,0,256,0z M384.866,256.818L258.272,468.186l-129.905-209.34
			C113.734,235.214,105.8,207.95,105.8,180c0-82.71,67.49-150.2,150.2-150.2S406.1,97.29,406.1,180
			C406.1,207.121,398.689,233.688,384.866,256.818z"></path>
	</g>
</g>
<g>
	<g>
		<path d="M256,90c-49.626,0-90,40.374-90,90c0,49.309,39.717,90,90,90c50.903,0,90-41.233,90-90C346,130.374,305.626,90,256,90z
			 M256,240.2c-33.257,0-60.2-27.033-60.2-60.2c0-33.084,27.116-60.2,60.2-60.2s60.1,27.116,60.1,60.2
			C316.1,212.683,289.784,240.2,256,240.2z"></path>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>


  </span>
  <span class="text-sm leading-snug">
    <strong>Address:</strong> {{ get_setting('footer_address') }}
  </span>
</div>




                    </div>
                </div>

                <!-- Contact Form -->
                <form action="{{ route('contact.submit') }}" method="POST"
                      class="space-y-6 bg-white/90 p-8 rounded-xl shadow-lg border border-[#e5e9f7]">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="Your full name" />
                        @error('name')
                            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="you@example.com" />
                        @error('email')
                            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1c2d9a] transition"
                            placeholder="Write your message here..."></textarea>
                        @error('message')
                            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-3 bg-[#1c2d9a] text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-[#233e70] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        {{ $page->getTranslation('heading3', $lang) }}
                    </button>

                    @if ($errors->any())
                        <div class="mt-4 text-red-600 text-sm">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="p-4 mt-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </x-container>
    </section>
@endsection
