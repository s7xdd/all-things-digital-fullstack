<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" href="{{ uploaded_asset(get_setting('site_icon')) }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    {{-- Primary CSS --}}
    @vite('resources/css/app.css')
    
    {{-- If Toastr included via npm/Vite, import its CSS in your app.css or JS --}}
    {{-- Otherwise, enable the below CDN line: --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}

    {{-- SEO Meta --}}
    {!! SEO::generate() !!}

    @yield('style')
</head>

<body class="font-sans text-gray-900 bg-white antialiased">

    @include('layouts.header.index')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer.index')

    {{-- jQuery with correct integrity hash --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-H+K7U5CnXl1hZW+6osq7dhzZpl1QDXD6GbFD2QIa7w="
        crossorigin="anonymous"></script>

    {{-- If Toastr included via CDN (uncomment if not using npm/Vite) --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    {{-- Vite JS bundles --}}
    @vite('resources/js/app.js')
    {{-- If you want to load Toastr explicitly via separate script (only if not via app.js) --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // ==================== Toastr Configuration ====================
            // Make sure toastr is available ! If toastr loaded via npm/Vite, window.toastr should exist.
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                };

                // Show flash notifications from Laravel session
                @if(session('success'))
                    toastr.success(@json(session('success')));
                @endif

                @if(session('error'))
                    toastr.error(@json(session('error')));
                @endif
            } else {
                console.warn('Toastr is not loaded.');
            }

            // =============== AJAX Setup ===============
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            // =============== Quantity Buttons Initialization ===============
            $('.counter-input').each(function () {
                const productId = this.id.split('_')[1];
                const maxQty = parseInt($('.increment-button[data-id="' + productId + '"]').data('max-quantity')) || Infinity;
                if (typeof updateButtonState === 'function') {
                    updateButtonState(productId, maxQty);
                }
            });

            // =============== Newsletter Form AJAX Submission ===============
            $('#newsletter-form').on('submit', function (e) {
                e.preventDefault();

                const email = $('#newsletter_email').val();
                const token = $('input[name="_token"]').val();

                $.post("{{ route('newsletter.subscribe') }}", {
                    newsletter_email: email,
                    _token: token
                })
                .done(function (response) {
                    $('#messageNewsletter').text(response.success).css('color', '#00dc00');
                    $('#newsletter_email').val('');
                })
                .fail(function (xhr) {
                    const error = xhr.responseJSON?.errors?.newsletter_email?.[0] || 'An error occurred.';
                    $('#messageNewsletter').text(error).css('color', 'red');
                });
            });
        });
    </script>

</body>

</html>
