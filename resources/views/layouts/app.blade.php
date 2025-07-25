<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <script type="module" src="{{ asset('dist/assets/app-f10b86b9.js') }}"></script> --}}
    {!! SEO::generate() !!}

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- @vite('resources/css/app.css') --}}

    @yield('style')


</head>

<body class="font-sans text-gray-900 bg-white antialiased">

    @include('layouts.header.index')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer.index')

    @vite('resources/js/app.js')

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif

            @if (session('error'))
                toastr.error('{{ session('error') }}');
            @endif

            $(document).ready(function() {
                $('.counter-input').each(function() {
                    let productId = $(this).attr('id').split('_')[
                        1];
                    let maxQuantity = parseInt($('.increment-button[data-id="' + productId + '"]')
                        .data('max-quantity')) || Infinity;
                    updateButtonState(productId, maxQuantity);
                });
            });

            $('#newsletter-form').on('submit', function(e) {
                e.preventDefault();

                let newsletter_email = $('#newsletter_email').val();
                let _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('newsletter.subscribe') }}",
                    type: "POST",
                    data: {
                        newsletter_email: newsletter_email,
                        _token: _token
                    },
                    success: function(response) {
                        $('#messageNewsletter').text(response.success).css('color', '#00dc00');
                        $('#newsletter_email').val('');
                    },
                    error: function(xhr) {
                        let error = xhr.responseJSON.errors.newsletter_email[0];
                        $('#messageNewsletter').text(error).css('color', 'red');
                    }
                });
            });


        });
    </script>

</body>

</html>
