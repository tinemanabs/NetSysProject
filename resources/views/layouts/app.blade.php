<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Swiper CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Lightbox CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div id="app">
        {{-- @if (Auth::user()->email_verified_at == null)
            <script>
                swal({
                    title: "Your email is not yet verified!",
                    text: "Kindly verify your email!",
                    icon: "warning",
                });
            </script>
        @endif --}}

        {{-- fix redirection to redirect here --}}
        <header id="header">
            <div class="banner-img">
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand d-block d-lg-none" href="#header">
                        <img src="{{ asset('img/logo.png') }}" alt="" width="100" height="100">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center " id="navbarNavAltMarkup">
                        <div class="navbar-nav align-items-lg-center">
                            <a class="nav-link active" aria-current="page" href="#header">Home</a>
                            <a class="nav-link" href="#cottages">Cottages</a>
                            <a class="nav-link" href="#rooms">Rooms</a>
                            <a class="nav-link" href="#ammenities">Ammenities</a>
                            <a class="nav-link" href="#pools">Pools</a>
                            <a class="navbar-brand d-none d-lg-block" href="#header">
                                <img src="{{ asset('img/logo.png') }}" alt="" width="100" height="100">
                            </a>
                            <a class="nav-link" href="#aboutus">About Us</a>
                            <a class="nav-link" href="#events">Events</a>
                            <a class="nav-link" href="#deals">Deals</a>
                            <a class="nav-link" href="#reviews">Reviews</a>
                            @guest
                                <a class="nav-link" href="{{ route('login') }}">Book Now</a>
                            @endguest
                            @auth
                                @if (Auth::user()->user_role == 1)
                                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                                @else
                                    <a class="nav-link" href="{{ route('booknow') }}">Book Now</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container h-100">
                <div class="h-100 d-flex justify-content-center align-items-center flex-column banner-content">
                    <h1>Perfect Getaway</h1>
                    <p>away from metro</p>
                    <button class="btn btn-light">Book Now</button>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- Lightbox JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".ammenitiesSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,

            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                }
            },

            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiper = new Swiper(".reviewsSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,

            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
        });
    </script>
</body>

</html>
