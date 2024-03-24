<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | {{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="{{ asset('imgaes/logo-full.svg') }}" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap"
        rel="stylesheet">

    {{-- External CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/landing-font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/plugins/owlcarousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/accordion.css') }}" />
    @stack('stylesheet')
</head>

<body>
    <div id="app">
        @yield('app')
        {{-- @include('sweetalert::alert') --}}
    </div>

    <a href="#app" class="back-to-top"> <i class="fa fa-angle-up"></i> </a>

    <script src="{{ asset('landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/js/menu.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/plugins/retinajs/retina.min.js') }}"></script>
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <script src="{{ asset('landing/js/accordion.js') }}"></script>
    <script src="{{ asset('landing/js/custom.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            AOS.init({
                // Global settings:
                debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
                useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
                disableMutationObserver: false, // disables automatic mutations' detections (advanced)

                mirror: true
            });
        })

        $(document).on('click', 'a[href^="#"]', function(e) {
            // target element id
            var id = $(this).attr('href');

            // target element
            var $id = $(id);
            if ($id.length === 0) {
                return;
            }

            // prevent standard hash navigation (avoid blinking in IE)
            e.preventDefault();

            // top position relative to the document
            var pos = $id.offset().top;

            // animated top scrolling
            $('body, html').animate({
                scrollTop: pos
            });
        });
    </script>


</body>

</html>
