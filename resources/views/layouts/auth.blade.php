<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Labak sa Morong</title>

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

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"
        integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datatables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- FullCalendar CDN -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>

    <!-- Moment JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand d-block" href="/">
                        <img src="{{ asset('img/logo.png') }}" alt="" width="100" height="100">
                    </a>

                    @auth
                        @if (Auth::user()->email_verified_at !== null || Auth::user()->user_role == 1)
                            <button class="btn btn-primary d-none d-md-block" id="sidebarToggle"><i
                                    class="fa-solid fa-bars"></i></button>
                        @endif
                    @endauth

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end " id="navbarNavAltMarkup">
                        <div class="navbar-nav align-items-lg-center">
                            @guest
                                <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            @endguest

                            @auth
                                <a class="nav-link">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                                @if (Auth::user()->user_role == 1)
                                    <div class="d-block d-md-none">
                                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                                        <a href="{{ route('useraccounts') }}" class="nav-link">User Accounts</a>
                                        <a href="{{ route('booknow') }}" class="nav-link">Book Now</a>
                                        <a href="{{ route('showRoomsPage') }}" class="nav-link">Rooms</a>
                                        <a href="{{ route('showCottagesPage') }}" class="nav-link">Cottages</a>
                                        <a href="{{ route('purchaseAndRentals') }}" class="nav-link">Purchase and Rental
                                            Inventory</a>
                                        <a href="{{ route('bookevent') }}" class="nav-link">Events</a>
                                        <a href="{{ route('smsDashboard') }}" class="nav-link">SMS Notification System</a>
                                        <a href="{{ route('editprofile', Auth::user()->id) }}" class="nav-link">Profile</a>
                                    </div>
                                @else
                                    <div class="d-block d-md-none">
                                        <a href="{{ route('booknow') }}" class="nav-link">Book Now</a>
                                        <a href="{{ route('bookevent') }}" class="nav-link">Events</a>
                                        <a href="{{ route('editprofile', Auth::user()->id) }}" class="nav-link">Profile</a>
                                    </div>
                                @endif

                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @auth
                @if (Auth::user()->email_verified_at !== null || Auth::user()->user_role == 1)
                    <div class="d-flex" id="wrapper">
                        <!-- Sidebar-->
                        <div class="border-end bg-white" id="sidebar-wrapper">
                            @if (Auth::user()->user_role == 1)
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('dashboard') }}">Dashboard</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('useraccounts') }}">User Accounts</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('booknow') }}">Book Now</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('showRoomsPage') }}">Rooms</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('showCottagesPage') }}">Cottages</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('purchaseAndRentals') }}">Purchase and Rental Inventory</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('bookevent') }}">Events</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('smsDashboard') }}">SMS Notification System</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="/bookingviolations">POS Violation</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('editprofile', Auth::user()->id) }}">Profile</a>
                                </div>
                            @elseif (Auth::user()->user_role == 2)
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('booknow') }}">Book Now</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('bookevent') }}">Events</a>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3"
                                        href="{{ route('editprofile', Auth::user()->id) }}">Profile</a>
                                </div>
                            @endif
                        </div>


                        <!-- Page content wrapper-->
                        <div id="page-content-wrapper">
                            <!-- Page content-->
                            <div class="container-fluid p-4">
                                <div class="alert alert-info alert-dismissible fade hide" role="alert">
                                    <strong>Alert!</strong> <span id="alertMessage">You should check in on some of those
                                        fields below.</span>
                                </div>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container mt-3">
                        <div class="card text-dark bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Verify your Email Address!</h5>
                                <p class="card-text">Kindly, check your inbox for the email confirmation sent by
                                    the system
                                    to proceed with the registration.</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            @guest
                @yield('content')
            @endguest

        </main>
    </div>

    @auth
        @if (Auth::user()->user_role == 1)
            <script>
                $(document).ready(() => {
                    axios.get('api/getNewestRental').then(response => {
                        const data = response.data
                        console.log(data);
                        if (data == '') {
                            $(".alert").addClass('d-none')
                        } else {
                            $('#alertMessage').html(
                                `User <b>${data.first_name} ${data.last_name}</b> ${data.is_rental == 'true' ? 'rented' : 'purchased'} <b>${data.quantity}x ${data.item_name}</b>`
                            )
                            $(".alert").removeClass('d-none')
                        }
                        $(".alert").addClass('show')
                    }).catch(err => {
                        console.log(err.response)
                    })
                    const interval = setInterval(() => {
                        axios.get('api/getNewestRental').then(response => {
                            const data = response.data
                            console.log(data);
                            if (data == '') {
                                $(".alert").addClass('d-none')
                            } else {
                                $('#alertMessage').html(
                                    `User <b>${data.first_name} ${data.last_name}</b> ${data.is_rental == 'true' ? 'rented' : 'purchased'} <b>${data.quantity}x ${data.item_name}</b>`
                                )
                                $(".alert").removeClass('d-none')
                            }
                            $(".alert").addClass('show')
                        }).catch(err => {
                            console.log(err.response)
                        })
                    }, 5000);
                })
            </script>
        @endif
    @endauth

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
