<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" href="{{ uploaded_asset(get_setting('site_icon')) }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('build/assets/app-44a5d742.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-5157f989.css') }}">


    @vite('resources/css/app.css')
    <script type="module" src="{{ asset('build/assets/app-39363393.js') }}"></script>


    <style>
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        #page-loader {
            background: linear-gradient(90deg, #224fa2, #3da4dc, #224fa2, #3da4dc);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            transition: opacity 0.7s ease-in-out;
        }
    </style>

    {{-- SEO Meta --}}
    {!! SEO::generate() !!}

    @yield('style')
</head>

<body class="font-sans text-gray-900 bg-white antialiased">

    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 flex items-center justify-center z-50 opacity-100">
        <div class="flex items-center justify-center space-x-4">
            <!-- Rotating Site Icon -->
            <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="Site Icon"
                class="w-16 h-16 rounded-full animate-spin" />
            <!-- Loader Text -->
            <p class="text-white font-semibold text-lg">Loading...</p>
        </div>
    </div>
    <!-- End Loader -->

    @include('layouts.header.index')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer.index')

    {{-- Vite JS bundles --}}
    @vite('resources/js/app.js')

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ==================== Toastr Configuration ====================
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
                @if (session('success'))
                    toastr.success(@json(session('success')));
                @endif

                @if (session('error'))
                    toastr.error(@json(session('error')));
                @endif
            } else {
                console.warn('Toastr is not loaded.');
            }

            // ==================== AJAX Setup ====================
            if (window.jQuery) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                // Newsletter AJAX
                $('#newsletter-form').on('submit', function(e) {
                    e.preventDefault();
                    const email = $('#newsletter_email').val();
                    const token = $('input[name="_token"]').val();

                    $.post("{{ route('newsletter.subscribe') }}", {
                            newsletter_email: email,
                            _token: token
                        })
                        .done(function(response) {
                            $('#messageNewsletter').text(response.success).css('color', '#00dc00');
                            $('#newsletter_email').val('');
                        })
                        .fail(function(xhr) {
                            const error = xhr.responseJSON?.errors?.newsletter_email?.[0] ||
                                'An error occurred.';
                            $('#messageNewsletter').text(error).css('color', 'red');
                        });
                });
            }

            // Quantity Buttons Initialization (if present)
            if (window.jQuery) {
                $('.counter-input').each(function() {
                    const productId = this.id.split('_')[1];
                    const maxQty = parseInt($('.increment-button[data-id="' + productId + '"]').data(
                        'max-quantity')) || Infinity;
                    if (typeof updateButtonState === 'function') {
                        updateButtonState(productId, maxQty);
                    }
                });
            }

            // ============ Hide the Loader After Page Load ============
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                loader.style.opacity = 0;
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 1000); // Match with transition
            }, 1000); // Loader visible for at least 1s
        });
    </script>
</body>

</html>
