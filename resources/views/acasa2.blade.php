<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="romania feng shui, feng shui , metafizica chineza, zodiacul chinezesc, marian golea, anca dimancea, alina badic, 360 de grade, 6tv, antena stars, feng shui bucuresti, lillian too, fengshui4life, sobolan, bivol, tigru, iepure, dragon, sarpe, cal, oaie, maimuta, cocos, caine, mistret, remedii feng shui, remedii sanatate, remedii pentru zodii, remedii prosperitate, remedii business, remedii dragoste, remedii noroc, bijuterii feng shui, cursuri feng shui, cursuri paht chee, elemente feng shui, lemn, pamant, apa, foc, metal, despre feng shui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-reboot.min.css"> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/glider.min.css') }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    @yield('extra-css')

    <title>Romania Feng Shui</title>

</head>

<body>

    @include('include.navbar2')

    <main class="mainContent">

        @yield('content')

    </main>

    <!-- Go to Top Button -->
    <a class="gotopbtn" id="back-to-top-btn" href="#"><i class="fas fa-angle-double-up"></i></a>
    <!-- Sfarsit Go to Top Button -->

    @include('include.footer')

    @yield('extra-js')

    <!-- CDNs ONLY-->

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- END -- Jquery CDN -->

    <!-- Scroll Reveal CDN -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- END -- Scroll Reveal CDN -->

    <!-- Popper.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- END -- Popper.js CDN -->

    <!-- Bootstrap CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- END -- Bootstrap CDN -->

    <!-- Bootstrap Bundle CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- End -- Bootstrap Bundle CDN -->

    <!-- Animation on Scroll CDN -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- End -- Animation on Scroll CDN -->

    <!-- SCRIPTS ONLY-->

    <!-- Search bar Script -->
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Glider Min Js Script -->
    <script src="{{ asset('js/glider.min.js') }}"></script>
    <!-- Sfarsit -- Glider Min Js Script -->

    <!-- Mega Menu Nav Script -->
    <script src="{{ asset('js/megaMenu.js') }}"></script>
    <!-- Sfarsit -- Mega Menu Nav Script -->

    <!-- Slider Magazin Cards Script -->
    <script src="{{ asset('js/sliderStudents.js') }}"></script>
    <!-- Sfarsit -- Slider Magazin Cards Script -->

    <!-- Tilt JS Script -->
    <script src="{{ asset('js/tilt.js') }}"></script>
    <!-- Sfarsit -- Tilt JS Script -->

    <!-- Romb Animation Product Category Script -->
    <script src="{{ asset('js/square__animation1.js') }}"></script>
    <!-- Sfarsit -- Romb Animation Product Category Script -->

    <!-- Romb Animation Product Category Script -->
    <script src="{{ asset('js/square__animation2.js') }}"></script>
    <!-- Sfarsit -- Romb Animation Product Category Script -->

    <!-- Search bar Script -->
    <script src="{{ asset('js/parallax.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Search bar Script -->
    <script src="{{ asset('js/footer.js') }}"></script>
    <!-- Sfarsit Search bar Script -->

    <!-- Back to Top Button Script -->
    <script src="{{ asset('js/backtotop.js') }}"></script>
    <!-- Sfarsit Back to Top Button Script -->


    <script>
        AOS.init({
            once: true
        });
    </script>

</body>

</html>