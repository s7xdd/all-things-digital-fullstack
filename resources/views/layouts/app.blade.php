<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('build/assets/app-4ff17481.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-6a406d76.css') }}">


    {!! SEO::generate() !!}

    @yield('style')
</head>

<body class="font-sans text-gray-900 bg-white antialiased">

    @include('layouts.header.index')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer.index')

    @vite('resources/js/app.js')
    <script type="module" src="{{ asset('build/assets/app-638fbbf4.js') }}"></script>


    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toastr options
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

            // CSRF setup for Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            // Toast Notifications
            @if (session('success'))
                toastr.success(@json(session('success')));
            @endif

            @if (session('error'))
                toastr.error(@json(session('error')));
            @endif

            // Counter Button Logic
            $('.counter-input').each(function() {
                const productId = this.id.split('_')[1];
                const maxQuantity = parseInt(
                    $('.increment-button[data-id="' + productId + '"]').data('max-quantity')
                ) || Infinity;
                updateButtonState(productId, maxQuantity);
            });

            $('#newsletter-form').on('submit', function(e) {
                e.preventDefault();

                const email = $('#newsletter_email').val();
                const token = $('input[name="_token"]').val();

                $.post("{{ route('newsletter.subscribe') }}", {
                    newsletter_email: email,
                    _token: token
                }).done(function(response) {
                    $('#messageNewsletter').text(response.success).css('color', '#00dc00');
                    $('#newsletter_email').val('');
                }).fail(function(xhr) {
                    const error = xhr.responseJSON.errors.newsletter_email?.[0] ||
                        'An error occurred.';
                    $('#messageNewsletter').text(error).css('color', 'red');
                });
            });
        });
    </script>

</body>

</html>
