@extends('layouts.app')

@section('content')
    {{-- COTTAGES --}}
    <div id="cottages">
        <div class="container section-content">
            <h3>Our Cottages</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>

            <div class="lightbox-gallery">
                <div class="container">
                    <div class="row photos">
                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/1.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/1.png') }}">
                            </a>
                        </div>
                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/2.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/2.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/3.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/3.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/4.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/4.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/5.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/5.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/6.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/6.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/7.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/7.png') }}">
                            </a>
                        </div>

                        <div class="col-12 col-md-6 item">
                            <a href="{{ asset('img/cottages/8.png') }}" data-lightbox="photos">
                                <img class="img-fluid" src="{{ asset('img/cottages/8.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- END OF COTTAGES SECTION --}}

    {{-- ROOMS --}}
    <div id="rooms">
        <div class="container section-content">
            <h3>Our Rooms</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>
            <div class="lightbox-gallery">
                <div class="container">
                    <div class="row rooms d-flex justify-content-center">
                        <div class="col-12 col-md-6 item">
                            <img class="img-fluid" src="{{ asset('img/rooms/1.png') }}">
                        </div>
                        <div class="col-12 col-md-6 item">
                            <img class="img-fluid" src="{{ asset('img/rooms/2.png') }}">
                        </div>

                        <div class="col-12 col-md-6 item">
                            <img class="img-fluid" src="{{ asset('img/rooms/3.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- END OF ROOMS SECTION --}}

    {{-- AMMENITIES --}}
    <section id="ammenities">
        <div class="container section-content">
            <h3>Our Ammenities</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>

            <!-- Swiper -->
            <div class="swiper ammenitiesSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/1.png') }}" alt="">
                            <div class="card-body">
                                <h5>Inclinator</h5>
                                <p>We offer inclinator to our guests who are staying in “BABA” since it will take
                                    75 steps before you reach the ground.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/2.png') }}" alt="">
                            <div class="card-body">
                                <h5>Sari-sari Store</h5>
                                <p>We have a sari-sari store that sell snacks, drinks,
                                    swimming essentials, frozen goods, and toiletries. It also offers rentable items such as
                                    karaoke and floaters.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/3.png') }}" alt="">
                            <div class="card-body">
                                <h5>Parking Space</h5>
                                <p>We offer limited parking space to our guests. We encourage our guests to let us know if
                                    they they will be needing a parking slot.</p>

                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/4a.png') }}" alt="">
                            <div class="card-body">
                                <h5>Live Animals</h5>
                                <p>Our resort is known as “nature resort” which we offer our guests an ambience close to
                                    nature for a perfect getaway.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/4b.png') }}" alt="">
                            <div class="card-body">
                                <h5>Live Animals</h5>
                                <p>Our resort is known as “nature resort” which we offer our guests an ambience close to
                                    nature for a perfect getaway.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/5a.png') }}" alt="">
                            <div class="card-body">
                                <h5>Animal Sculptures</h5>
                                <p>Our resort also have some animal sculptures. It is perfect for
                                    the kids and family.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card ammenities-card">
                            <img class="card-img-top" src="{{ asset('img/ammenities/5b.png') }}" alt="">
                            <div class="card-body">
                                <h5>Animal Sculptures</h5>
                                <p>Our resort also have some animal sculptures. It is perfect for
                                    the kids and family.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    {{-- END OF AMMENITIES SECTION --}}

    {{-- POOLS --}}
    <div id="pools">
        <div class="container section-content">
            <h3>Our Pools</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>

            <div class="lightbox-gallery">
                <div class="container">
                    <div class="row pools d-flex justify-content-center">
                        <div class="col-12 col-md-4 item">
                            <img class="img-fluid" src="{{ asset('img/pools/1.png') }}">
                        </div>
                        <div class="col-12 col-md-4 item">
                            <img class="img-fluid" src="{{ asset('img/pools/2.png') }}">
                        </div>

                        <div class="col-12 col-md-4 item">
                            <img class="img-fluid" src="{{ asset('img/pools/3.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF POOLS SECTION --}}

    {{-- ABOUT US --}}
    <div id="aboutus">
        <div class="container section-content">
            <h3>About Us</h3>

            <div class="row d-flex align-items-center mb-3">
                <div class="col-12 col-md-6 order-md-last">
                    <img src="{{ asset('img/aboutus/1.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-6 ">
                    <h1>Labak sa Morong</h1>
                    <p>is a nature resort in Sariaya, Quezon that offers a perfect getaway to its local and tourists. </p>
                </div>
            </div>

            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-6 order-md-first">
                    <img src="{{ asset('img/aboutus/2.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-6 ">
                    <h1>Locate Us</h1>

                </div>
            </div>
        </div>
    </div>
    {{-- END OF ABOUT US SECTION --}}

    {{-- EVENTS --}}
    <div id="events">
        <div class="container section-content">
            {{-- <h3>Events</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p> --}}

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-md-last">
                    <img src="{{ asset('img/events.png') }}" alt="" class="img-fluid rounded-3">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <h5>Celebrate your milestone with us!</h5>
                    <button class="btn btn-primary">Book Now</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF EVENTS SECTION --}}

    {{-- DEALS --}}
    <div id="deals">
        <div class="container section-content">
            <h3>Deals</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-6 mb-3">
                    <img src="{{ asset('img/deals/1.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('img/deals/2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    {{-- END OF DEALS SECTION --}}

    {{-- REVIEWS --}}
    {{-- <div id="reviews">
        <div class="container section-content">
            <h3>Reviews</h3>
            <p class="subheading">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque perferendis assumenda
                doloribus! Facilis ad
                error, deleniti quidem recusandae architecto eos consequatur placeat aut</p>

            <!-- Swiper -->
            <div class="swiper reviewsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card reviews-card">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <i class="fa-solid fa-quote-left fa-5x mb-3"></i>
                                <i class="fa-regular fa-circle-user fa-4x"></i>
                                <h5>Juan Miguel Sebastian</h5>
                                <div class="d-flex align-items-center py-1">
                                    <span>5/5</span>
                                    <i class="fa-solid fa-star ms-2" style="color:#ffc107"></i>
                                </div>
                                <p>Superb facilities and amenities!</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card reviews-card">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <i class="fa-solid fa-quote-left fa-5x mb-3"></i>
                                <i class="fa-regular fa-circle-user fa-4x"></i>
                                <h5>Michael King</h5>
                                <div class="d-flex align-items-center py-1">
                                    <span>4/5</span>
                                    <i class="fa-solid fa-star ms-2" style="color:#ffc107"></i>
                                </div>
                                <p>Super helpful ng purchase service nila, hindi
                                    na ako aakyat pa. Thank you sa mga person in charge
                                    sa store. Napaka-accommodating.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card reviews-card">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <i class="fa-solid fa-quote-left fa-5x mb-3"></i>
                                <i class="fa-regular fa-circle-user fa-4x"></i>
                                <h5>James Sagad</h5>
                                <div class="d-flex align-items-center py-1">
                                    <span>4/5</span>
                                    <i class="fa-solid fa-star ms-2" style="color:#ffc107"></i>
                                </div>
                                <p>Highly recommended sa mga naghahanap ng resort
                                    sa Quezon.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                {{-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> 

            </div>
        </div>
    </div> --}}
    {{-- END OF REVIEWS SECTION --}}
@endsection
