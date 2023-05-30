@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <h4>Booking</h4>

        <div class="multisteps-form mb-5">
            <!--progress bar-->
            <div class="row">
                <div class="col-12 col-lg-11 ms-auto me-auto mb-4">
                    <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button" title="Type of Reservation">Type
                            of
                            Reservation</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Choose a Date"
                            id="dateCalendarBtn">Choose
                            a
                            Date</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Day / Night Swimming Rates">Day
                            or Night Swimming</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Place of Swimming">Choose a
                            Pool</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Choose a Room or Cottage">Choose
                            a
                            Room or Cottage</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Number of persons">
                            Number of persons</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Book an Event">Book an
                            Event</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Guest Information">Guest
                            Information </button>
                        <button class="multisteps-form__progress-btn" type="button" title="Summary & Payment">Summary &
                            Payment</button>
                    </div>
                </div>
            </div>
            <!--form panels-->
            <div class="row">
                <div class="col-12 col-lg-10 m-auto">
                    <form class="multisteps-form__form" method="POST" action="" enctype="multipart/form-data">
                        @csrf

                        <!--single form panel: TYPE OF RESERVATION CONTENT -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Type of Reservation</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    @if (Auth::user()->user_role == 1)
                                                        <input id="nonExclusive" type="radio" name="type_of_reservation"
                                                            value="non-exclusive">
                                                    @elseif (Auth::user()->user_role == 2)
                                                        <input id="nonExclusive" type="radio" name="type_of_reservation"
                                                            value="non-exclusive" disabled readonly>
                                                    @endif

                                                    <label for="">Non Exclusive</label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    @if (Auth::user()->user_role == 1)
                                                        <input id="exclusive" type="radio" name="type_of_reservation"
                                                            value="exclusive">
                                                    @elseif (Auth::user()->user_role == 2)
                                                        <input id="exclusive" type="radio" name="type_of_reservation"
                                                            value="exclusive" checked>
                                                    @endif
                                                    <label for="">Exclusive</label>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <a class="btn btn-outline-secondary me-auto" href="{{ route('booknow') }}"
                                        role="button" title="Next">Cancel</a>

                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToDate">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF TYPE OF RESERVATION CONTENT -->

                        <!--single form panel: DATE CONTENT-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn"
                            id="dateCalendar">
                            <h3 class="multisteps-form__title">Choose a Date</h3>
                            <div class="multisteps-form__content">
                                <div id='calendar'></div>
                                <input type="text" name="date_Start" id="dateStart">
                                <input type="text" name="date_End" id="dateEnd">
                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" id="nextBtnToType"
                                        title="Next">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: DATE CONTENT-->

                        <!--single form panel: DAY / NIGHT CONTENT -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Day / Night Swimming Rates</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <i class="fa-solid fa-sun fa-10x m-auto text-warning"></i>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input id="daySwimming" type="radio" name="timeBooked"
                                                        value="day">
                                                    <label for="">Day Swimming</label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4" id="radioBtnForNight">
                                        <div class="card h-100 rooms-cottages-card p-4"style="background-color: #1F1D28;">
                                            <i class="fa-solid fa-moon fa-10x m-auto text-white"></i>
                                            <div class="card-body text-white">
                                                <h5 class="card-title">
                                                    <input id="nightSwimming" type="radio" name="timeBooked"
                                                        value="night">
                                                    <label for="">Night Swimming</label>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4" id="radioBtnForOvn">
                                        <div class="card h-100 rooms-cottages-card p-4"style="background-color: #1F1D28;">
                                            <i class="fa-solid fa-moon fa-10x m-auto text-white"></i>
                                            <div class="card-body text-white">
                                                <h5 class="card-title">
                                                    <input id="overnightSwimming" type="radio" name="timeBooked"
                                                        value="overnight">
                                                    <label for="">Overnight Swimming</label>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToPlaceOfPool">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF DAY / NIGHT CONTENT -->

                        <!--single form panel: PLACE OF POOL -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Choose a Pool</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input id="taasPool" type="radio" name="place_of_pool"
                                                        value="taas">
                                                    <label for="">Taas</label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input id="babaPool" type="radio" name="place_of_pool"
                                                        value="baba">
                                                    <label for="">Baba</label>
                                                </h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToRoom">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF PLACE OF POOL -->

                        <!--single form panel: ROOM OR COTTAGE CONTENT-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Choose a Room or Cottage</h3>
                            <div class="multisteps-form__content">
                                {{-- START OF CONTENT --}}
                                <input type="checkbox" name="room_cottage" value="0">
                                <label for="">I don't want to reserve a room or cottag</label>

                                <div id="roomsAndCottagesContent">
                                    <div id="roomsValues">
                                        <h4>Rooms</h4>
                                        <div class="row row-cols-2 row-cols-lg-3 g-4 mb-3" id="roomsContent">
                                        </div>
                                    </div>

                                    <div id="cottagesValues">
                                        <h4>Cottages</h4>
                                        <div class="row row-cols-2 row-cols-lg-3 g-4" id="cottagesContent">
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToNumPeople">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF ROOM OR COTTAGE CONTENT-->

                        <!--single form panel: NUMBER OF PEOPLE CONTENT -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn"
                            id="paxCard">
                            <h3 class="multisteps-form__title">Indicate number of Persons</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label">Adults</label>
                                        <input type="number" class="form-control mb-3" name="adults" id="adults">

                                        <label for="" class="form-label">Children</label>
                                        <input type="number" class="form-control mb-3" name="children" id="children">
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToPlacePool">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF NUMBER OF PEOPLE CONTENT -->

                        <!--single form panel: BOOK AN EVENT -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Book an Event</h3>
                            <div class="multisteps-form__content">

                                <input type="checkbox" name="functional_hall" value="0">
                                <label for="">I don't want to set an Event.</label>

                                <div class="row" id="bookEventContent">
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 functional-halls-card">
                                            <img src="{{ asset('img/events/1.png') }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input type="radio" name="functional_hall" value="Ilang-Ilang">
                                                    <label for="">Ilang-Ilang</label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card h-100 functional-halls-card">
                                            <img src="{{ asset('img/events/2.png') }}" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input type="radio" name="functional_hall" value="Jasmin">
                                                    <label for="">Jasmin</label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Inclusions:</h5>
                                                <input type="radio" name="inclusions" id="withTables"
                                                    value="with Tables and Chairs">
                                                <label for="">With Tables and Chairs</label>

                                                <br>
                                                <input type="radio" name="inclusions" id="withoutTables"
                                                    value="without Tables and Chairs">
                                                <label for="">Without Tables and Chairs</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToInfo">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF BOOK AN EVENT -->

                        <!--single form panel: GUEST INFO CONTENT-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Guest Information</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">First Name</label>
                                        @if (Auth::user()->user_role == 1)
                                            <input type="text" class="form-control" name="first_name"
                                                id="first_name">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                value="{{ Auth::user()->first_name }}" readonly>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">Last Name</label>

                                        @if (Auth::user()->user_role == 1)
                                            <input type="text" class="form-control" name="last_name" id="last_name">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                value="{{ Auth::user()->last_name }}" readonly>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">Birthdate</label>
                                        @if (Auth::user()->user_role == 1)
                                            <input type="date" name="birthday" class="form-control" id="birthday">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="date" name="birthday" class="form-control" id="birthday"
                                                value="{{ Auth::user()->birthday }}" readonly>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">Email Address</label>

                                        @if (Auth::user()->user_role == 1)
                                            <input type="email" name="email" class="form-control" id="email">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">Address</label>
                                        @if (Auth::user()->user_role == 1)
                                            <input type="text" name="address" class="form-control" id="address">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="text" name="address" class="form-control" id="address"
                                                value="{{ Auth::user()->address }}" readonly>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label for="" class="form-label">Contact Number</label>
                                        @if (Auth::user()->user_role == 1)
                                            <input type="text" name="contact_no" class="form-control"
                                                id="contact_no">
                                        @elseif (Auth::user()->user_role == 2)
                                            <input type="text" name="contact_no" class="form-control" id="contact_no"
                                                value="{{ Auth::user()->contact_no }}" readonly>
                                        @endif
                                    </div>

                                    @if (Auth::user()->user_role == 1)
                                        <div class="col-lg-6 mb-3">
                                            <label for="" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="" class="form-label">Confirm Password</label>
                                            <input type="password" name="confpassword" class="form-control"
                                                id="confPassword">
                                        </div>
                                    @endif

                                    @if (Auth::user()->user_role == 2)
                                        <input type="text" value="{{ Auth::user()->id }}" id="userID" hidden>
                                    @endif

                                    <input type="text" value="{{ Auth::user()->user_role }}" id="userRole" hidden>

                                </div>


                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToSummary">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF GUEST INFO CONTENT-->

                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Summary and Payment</h3>
                            <div class="multisteps-form__content">

                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <h4>Booking Summary</h4>

                                        <p id="bookInfo_date"></p>
                                        <p id="bookInfo_time"></p>
                                        <p id="bookInfo_placePool"></p>
                                        <p id="bookInfo_room"></p>
                                        <p id="bookInfo_adults"></p>
                                        <p id="bookInfo_children"></p>
                                        <hr>
                                        <h4>Personal Information</h4>
                                        <p id="bookInfo_name"></p>
                                        <p id="bookInfo_bday"></p>
                                        <p id="bookInfo_email"></p>
                                        <p id="bookInfo_addr"></p>
                                        <p id="bookInfo_contact"></p>
                                        <hr>
                                        <h4>Event Information</h4>
                                        <p id="bookInfo_functionalHall"></p>
                                        <p id="bookInfo_inclusions"></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <h4>Payment Information</h4>
                                        <ul class="list-group list-group-flush p-0">
                                            <li class="list-group-item px-0" id="typeOfReservationForPayment">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1" id="payment_exlusiveReservationHeading"></h6>
                                                    <p class="m-0 p-0" id="payment_exlusiveReservationPrice"></p>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">General Admission Fee</h6>
                                                    <p class="m-0 p-0" id="payment_admissionFeePrice"></p>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <div>
                                                        <small class="mb-1" id="payment_typeOfReservation"></small>
                                                        <small class="mb-1">x <span
                                                                id="payment_totalPersons"></span></small>
                                                    </div>

                                                    <p class="m-0 p-0" id="payment_totalAdmissionFee"></p>
                                                </div>


                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">Room or Cottage Fee</h6>
                                                    <p class="m-0 p-0">P <span id="payment_roomCottagePrice"></span></p>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1">Inclusions</h6>
                                                    <p class="m-0 p-0" id="payment_inclusions"></p>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex w-100 justify-content-end">
                                                    <h6>Total: P <span id="payment_totalFee"></span></h6>
                                                </div>
                                            </li>
                                        </ul>

                                        @if (Auth::user()->user_role == 1)
                                            <div id="modeOfPayment" class="mb-3">
                                                <h5>Mode of Payment:</h5>

                                                <input type="radio" name="mode_of_payment" value="cash">
                                                <label for="">Cash</label>
                                                <br>
                                                <input type="radio" name="mode_of_payment" value="gcash">
                                                <label for="">GCash</label>
                                            </div>
                                        @endif

                                        <div id="paymentType" class="mb-3">
                                            <h5>Payment Type:</h5>

                                            <input type="radio" name="payment_type" value="Full Payment">
                                            <label for="">Full Payment</label>
                                            <br>
                                            <input type="radio" name="payment_type" value="Down Payment">
                                            <label for="">Down Payment (50%)</label>
                                        </div>

                                        <div id="modeOfPaymentUpload">
                                            <label for="" class="form-label">Kindly upload your proof of
                                                payment:</label>
                                            <input type="file" name="" class="form-control" id="receiptImage">

                                            <div class="mt-3">
                                                <div class="text-center">
                                                    <img src="{{ asset('img/SAMPLEGCASHQRCODE.jpg') }}" alt=""
                                                        class="img-fluid" width="250">
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>


                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-success ms-auto" type="button" title="Submit"
                                        id="bookingBtn">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- MULTI-STEP FORN --}}
    <script>
        //DOM elements
        const DOMstrings = {
            stepsBtnClass: 'multisteps-form__progress-btn',
            stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
            stepsBar: document.querySelector('.multisteps-form__progress'),
            stepsForm: document.querySelector('.multisteps-form__form'),
            stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
            stepFormPanelClass: 'multisteps-form__panel',
            stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
            stepPrevBtnClass: 'js-btn-prev',
            stepNextBtnClass: 'js-btn-next'
        };

        //remove class from a set of items
        const removeClasses = (elemSet, className) => {
            elemSet.forEach(elem => {
                elem.classList.remove(className);
            });
        };
        //return exect parent node of the element
        const findParent = (elem, parentClass) => {
            let currentNode = elem;
            while (!currentNode.classList.contains(parentClass)) {
                currentNode = currentNode.parentNode;
            }
            return currentNode;
        };
        //get active button step number
        const getActiveStep = elem => {
            return Array.from(DOMstrings.stepsBtns).indexOf(elem);
        };
        //set all steps before clicked (and clicked too) to active
        const setActiveStep = activeStepNum => {
            //remove active state from all the state
            removeClasses(DOMstrings.stepsBtns, 'js-active');
            //set picked items to active
            DOMstrings.stepsBtns.forEach((elem, index) => {
                if (index <= activeStepNum) {
                    elem.classList.add('js-active');
                }
            });
        };
        //get active panel
        const getActivePanel = () => {
            let activePanel;
            DOMstrings.stepFormPanels.forEach(elem => {
                if (elem.classList.contains('js-active')) {
                    activePanel = elem;
                }
            });
            return activePanel;
        };
        //open active panel (and close unactive panels)
        const setActivePanel = activePanelNum => {
            //remove active class from all the panels
            removeClasses(DOMstrings.stepFormPanels, 'js-active');
            //show active panel
            DOMstrings.stepFormPanels.forEach((elem, index) => {
                if (index === activePanelNum) {
                    elem.classList.add('js-active');
                    setFormHeight(elem);
                }
            });
        };
        //set form height equal to current panel height
        const formHeight = activePanel => {
            const activePanelHeight = activePanel.offsetHeight;
            DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
        };
        const setFormHeight = () => {
            const activePanel = getActivePanel();
            formHeight(activePanel);
        };

        // //STEPS BAR CLICK FUNCTION
        DOMstrings.stepsBar.addEventListener('click', e => {
            //check if click target is a step button
            const eventTarget = e.target;
            if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
                return;
            }
            //get active button step number
            const activeStep = getActiveStep(eventTarget);
            //set all steps before clicked (and clicked too) to active
            setActiveStep(activeStep);
            //open active panel
            setActivePanel(activeStep);
        });

        //PREV/NEXT BTNS CLICK
        DOMstrings.stepsForm.addEventListener('click', e => {
            const eventTarget = e.target;
            //check if we clicked on `PREV` or NEXT` buttons
        if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList
                .contains(`${DOMstrings.stepNextBtnClass}`))) {
            return;
        }
        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
        let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);
        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
                activePanelNum--;
            } else {
                activePanelNum++;
                // if (activePanelNum == 0 && $('input[name = "type_of_reservation"]:checked').val() != undefined) {
                //     console.log($('input[name="type_of_reservation"]:checked').val())
                //     activePanelNum++;
                // } else if (activePanelNum == 1 && $('#dateBooked').val() != '') {
                //     console.log($('#dateBooked').val())
                //     activePanelNum++;
                // } else if (activePanelNum == 2 && $('input[name="timeBooked"]:checked').val() != undefined) {
                //     console.log($('input[name="timeBooked"]:checked').val())
                //     activePanelNum++;
                // } else if (activePanelNum == 3 && $('#adults').val() != '' && $('#children').val() != '') {
                //     console.log($('#adults').val(), $('#children').val());
                //     activePanelNum++;
                // } else if (activePanelNum == 4 && $('input[name = "room_cottage"]:checked').val() != undefined) {
                //     console.log($('input[name = "room_cottage"]:checked').val())
                //     activePanelNum++;
                // } else if (activePanelNum == 5 &&
                //     $('#first_name').val() != '' &&
                //     $('#last_name').val() != '' &&
                //     $('#birthday').val() != '' &&
                //     $('#email').val() != '' &&
                //     $('#address').val() != '' &&
                //     $('#contact_no').val() != '' &&
                //     $('#password').val() != '' && $('#confPassword').val() != '') {

                //     console.log($('#first_name').val(),
                //         $('#last_name').val(),
                //         $('#birthday').val(),
                //         $('#email').val(),
                //         $('#address').val(),
                //         $('#contact_no').val(),
                //         $('#password').val())
                //     activePanelNum++;
                // }


            }
            setActiveStep(activePanelNum);
            setActivePanel(activePanelNum);
        });
        //SETTING PROPER FORM HEIGHT ONLOAD
        window.addEventListener('load', setFormHeight, false);
        //SETTING PROPER FORM HEIGHT ONRESIZE
        window.addEventListener('resize', setFormHeight, false);
    </script>

    {{-- VALIDATIONS 
<script>
    $('#nextBtnToDate').on('click', () => {
        if (!$('input[name="type_of_reservation"]').is(':checked')) {
            swal({
                icon: 'warning',
                title: 'Select a type of reservation!',
                text: 'Please choose a type of reservation.'
            })
        }
    });

    $('#nextBtnToType').on('click', () => {
        if ($('#dateBooked').val() == '') {
            swal({
                icon: 'warning',
                title: 'Select a date',
                text: 'Please choose the date.'
            })
        }
    });

    $('#nextBtnToNumPeople').on('click', () => {
        if (!$('input[name ="timeBooked"]').is(':checked')) {
            swal({
                icon: 'warning',
                title: "Select a time!",
                text: "Please choose a time."
            })
        }
    });

    $('#nextBtnToRoom').on('click', () => {
        if ($('#adults').val() == '' || $('#children').val() == '') {
            swal({
                icon: 'warning',
                title: "Indicate the number of persons!",
                text: "Please indicate the number of adult and children in the field."
            })
        }
    });

    $('#nextBtnToInfo').on('click', () => {
        if (!$('input[name = "room_cottage"]').is(':checked')) {
            swal({
                icon: 'warning',
                title: 'Select a Room or Cottage',
                text: 'Please choose the room or cottage you want to reserve.'
            })
        }
    });
</script> --}}

    {{-- RESTRICTIONS AND API CALLS --}}
    <script>
        $('input[name="type_of_reservation"]:radio').on('click', (event) => {
            if (event.target.value === 'non-exclusive') {
                console.log('success')
                $('#radioBtnForNight').hide('#radioBtnForNight')
                $('#radioBtnForOvn').hide('#radioBtnForOvn')
                $('#typeOfReservationForPayment').hide('#typeOfReservationForPayment')

                //$('#modeOfPaymentUpload').hide('#modeOfPaymentUpload');
            } else if (event.target.value === 'exclusive') {
                console.log('exclusive')
                $('#cottagesValues').hide('#cottagesValues')
                //$('#modeOfPayment').hide('#modeOfPayment')
                //$('#modeOfPaymentUpload').show('#modeOfPaymentUpload')
            }
        });

        $('#modeOfPaymentUpload').hide('#modeOfPaymentUpload');
        $('input[name="mode_of_payment"]').click(function() {
            let value = $(this).attr('value');

            if (value == 'gcash') {
                $('#modeOfPaymentUpload').show();
            } else {
                $('#modeOfPaymentUpload').hide('#modeOfPaymentUpload');
            }
        });

        $('#nextBtnToRoom').on('click', () => {
            $placePool = $('input[name="place_of_pool"]:checked').val();

            axios.get('/getFilteredRooms/' + $placePool)
                .then((response) => {
                    let data = response.data;
                    let content = ""
                    data.map((d) => {
                        console.log(d)
                        content = `<div class="col">
                                    <div class="card h-100 rooms-cottages-card">
                                        <img src="/img/rooms/${d.room_id}/${d.room_cottage_image}"
                                            class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="${d.room_id}" type="checkbox" name="room_cottage"
                                                    value="${d.id}">
                                                <label
                                                    id="roomCottageName${d.id}">${d.room_id}</label>
                                            </h5>

                                            <p class="card-text">${d.room_name}</p>

                                            <p class="card-text" id="roomCottagePrice${d.id}">${d.room_cottage_price}</p>
                                        </div>
                                    </div>
                                </div> `
                        $('#roomsContent').append(content)
                    })
                })

            @if (Auth::user()->user_role == 1)
                axios.get('/getFilteredCottages/' + $placePool)
                    .then((response) => {
                        let data = response.data;
                        let content = ""
                        data.map((d, index) => {

                            console.log(data[index])
                            content = `<div class="col">
                                        <div class="card h-100 rooms-cottages-card">
                                            <img src="img/cottages/${d.cottage_name}/${d.room_cottage_image}"
                                                class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input id="${d.cottage_name}" type="checkbox"
                                                        name="room_cottage" value="${d.id}">
                                                    <label
                                                        id="roomCottageName${d.id}">${d.cottage_name}</label>
                                                </h5>

                                                <p class="card-text" id="roomCottagePrice${d.id}">${d.room_cottage_price}</p>
                                            </div>
                                        </div>
                                    </div> `
                            $('#cottagesContent').append(content)
                        })
                    })
            @endif
        })

        $('input[name="room_cottage"]').click(function() {
            let value = $(this).attr('value')

            if (value == 0) {
                $('#roomsAndCottagesContent').toggle();
            }
        });

        $('input[name="functional_hall"]').click(function() {
            let value = $(this).attr('value');

            if (value == 0) {
                $('#bookEventContent').toggle();
            }
        })
    </script>

    {{-- SUMMARY & PAYMENT --}}
    <script>
        $('#nextBtnToSummary').on('click', () => {
            $dateStart = $('input[name="dateStart"]:checked').val();
            $dateEnd = $('input[name="dateEnd"]:checked').val();
            $day =
                $('#bookInfo_date').val()
        });
    </script>


    {{-- SUBMISSION OF FORM --}}
    <script>
        // CALENDAR
        const clickDate = (info) => {
            $dateStart = $('#dateStart').val(moment(info.dateStr).format('YYYY-MM-DD'));
            $dateEnd = $('#dateEnd').val(moment(info.dateStr).add(1, 'days').format('YYYY-MM-DD'));
        }

        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            height: 700,
            dateClick: clickDate,
            validRange: {
                start: moment().format('YYYY-MM-DD')
            }

        });
        calendar.render();

        // END OF CALENDAR

        $('#nextBtnToSummary').on('click', () => {
            //VALUES
            $typeOfReservation = $('input[name="type_of_reservation"]:checked').val();
            $dateStart = moment($('#dateStart').val()).format('ll');
            $dateEnd = '';
            $time = $('input[name = "timeBooked"]:checked').val();
            $timeFormat = '';
            $placePool = $('input[name="place_of_pool"]:checked').val();

            //Payment Information
            $content = '' // type of reservation
            $exclusivePrice = ''
            $admissionFee = 0; //for non-exclu & exclusive day only
            $totalAdmissionFee = 0;
            $totalPaymentPrice = 0

            let totalRoomPrice = 0;
            let roomsAndCottages = $('input[name="room_cottage"]:checked').map(function() {
                $roomID = $(this).val();
                if ($roomID != 0) {
                    return $('#roomCottageName' + $roomID).text();
                } else {
                    return 'No room or cottage.'
                }

            }).get(); // displays the chosen rooms & cottages

            let roomsAndCottagesPrice = $('input[name="room_cottage"]:checked').map(function() {
                $roomID = $(this).val();
                if ($roomID != 0) {
                    return $('#roomCottagePrice' + $roomID).text();
                } else {
                    return 0;
                }

            }).get(); // gets the prices of rooms selected

            roomsAndCottagesPrice.map((item, index) => {
                totalRoomPrice = totalRoomPrice + Number(item)
            }) // stores the prices of each room selected

            // intialized it here to retrieve the total room price
            $('#payment_roomCottagePrice').text(`${totalRoomPrice}`);
            $totalRoomCottagePrice = Number($('#payment_roomCottagePrice').text());


            $adults = $('#adults').val();
            $children = $('#children').val();
            $totalPersons = Number($adults) + Number($children);

            // events & inclusions are for exclu day & overnight 
            $event = $('input[name="functional_hall"]:checked').val();
            $inclusions = $('input[name="inclusions"]:checked').val();
            $inclusionsPrice = 0;

            if ($typeOfReservation == 'non-exclusive') {
                $('#bookInfo_date').text(`Booking Date: ${$dateStart}`);

                $timeFormat = '8:00 AM - 5:00 PM';
                $content = 'Non-Exclusive Day Swimming';
                $admissionFee = 75;
                $totalAdmissionFee = Number($admissionFee) * Number($totalPersons);

                $totalPaymentPrice = Number($totalAdmissionFee) + Number(
                    $totalRoomCottagePrice); //computes the total price
            } else if ($typeOfReservation == 'exclusive') {
                if ($time == 'day') {
                    $('#bookInfo_date').text(`Booking Date: ${$dateStart}`);

                    $timeFormat = '8:00 AM - 5:00 PM';
                    $content = 'Exclusive Day Swimming';
                    $admissionFee = 100;
                    $totalAdmissionFee = Number($admissionFee) * Number($totalPersons);

                    if ($placePool == 'taas') {
                        $exclusivePrice = 1950;

                    } else if ($placePool == 'baba') {
                        $exclusivePrice = 3550;
                    }


                    if ($event == 'Ilang-Ilang') {
                        if ($inclusions == 'with Tables and Chairs') {
                            $inclusionsPrice = 3000;
                        } else if ($inclusions == 'without Tables and Chairs') {
                            $inclusionsPrice = 2000;
                        }
                    } else if ($event == 'Jasmin') {
                        if ($inclusions == 'with Tables and Chairs') {
                            $inclusionsPrice = 4000;
                        } else if ($inclusions == 'without Tables and Chairs') {
                            $inclusionsPrice = 3000;
                        }
                    }

                    console.log($exclusivePrice, $totalAdmissionFee, $totalRoomCottagePrice,
                        $inclusionsPrice)

                    $totalPaymentPrice = Number($exclusivePrice) + Number($totalAdmissionFee) + Number(
                        $totalRoomCottagePrice) + Number($inclusionsPrice); //computes the total price


                } else if ($time == 'night') {
                    $dateEnd = moment($('#dateEnd').val()).subtract(1, 'days').format('ll');

                    $('#bookInfo_date').text(`Booking Date: ${$dateStart}`);
                    $timeFormat = '7:00 PM - 11:00 PM';
                    $content = 'Exclusive Night Swimming';
                    $exclusivePrice = 1200;

                    console.log($exclusivePrice, $totalAdmissionFee, $totalRoomCottagePrice)

                    if ($totalPersons <= 7) {
                        $totalPaymentPrice = Number($exclusivePrice) + Number(
                            $totalRoomCottagePrice); //computes the total price
                    } else {
                        $excess = $totalPersons - 7;
                        $totalPersons = $excess;
                        $admissionFee = 100
                        $totalAdmissionFee = Number($admissionFee) * Number($excess);

                        $totalPaymentPrice = Number($exclusivePrice) + Number($totalAdmissionFee) + Number(
                            $totalRoomCottagePrice); //computes the total price
                    }

                    // TODO: MISSING TOTAL FEE;
                } else if ($time == 'overnight') {
                    $dateEnd = moment($('#dateEnd').val()).format('ll');

                    $('#bookInfo_date').text(`Booking Date: ${$dateStart} - ${$dateEnd}`);
                    $timeFormat = '7:00 PM - 8:00 AM';
                    $content = 'Exclusive Overnight Swimming';
                    $exclusivePrice = 4000;

                    if ($event == 'Ilang-Ilang') {
                        if ($inclusions == 'with Tables and Chairs') {
                            $inclusionsPrice = 4000;
                        } else if ($inclusions == 'without Tables and Chairs') {
                            $inclusionsPrice = 3000;
                        }
                    } else if ($event == 'Jasmin') {
                        if ($inclusions == 'with Tables and Chairs') {
                            $inclusionsPrice = 5000;
                        } else if ($inclusions == 'without Tables and Chairs') {
                            $inclusionsPrice = 4000;
                        }
                    }

                    console.log($exclusivePrice, $totalAdmissionFee, $totalRoomCottagePrice, $inclusionsPrice)

                    if ($totalPersons <= 25) {
                        $totalPaymentPrice = Number($exclusivePrice) + Number($totalAdmissionFee) + Number(
                            $totalRoomCottagePrice) + Number($inclusionsPrice); //computes the total price
                    } else {
                        $excess = $totalPersons - 25
                        $totalPersons = $excess

                        $admissionFee = 110;
                        $totalAdmissionFee = Number($admissionFee) * Number($excess);

                        $totalPaymentPrice = Number($exclusivePrice) + Number($totalAdmissionFee) + Number(
                            $totalRoomCottagePrice) + Number($inclusionsPrice)
                    }

                    //TODO: MISSING TOTAL FEE;
                }
            }

            //checks and replaces the content if there's a booked event
            $eventContent = '';
            $inclusionsContent = '';

            if ($event == 0) {
                $eventContent = 'No reserved functional hall';
                $inclusionsContent = 'No inclusions added.';
            } else {
                $eventContent = $('input[name="functional_hall"]:checked').val();
                $inclusionsContent = $('input[name="inclusions"]:checked').val();
            }


            $fname = $('#first_name').val();
            $lname = $('#last_name').val();
            $bday = moment($('#birthday').val()).format('ll');
            $email = $('#email').val();
            $address = $('#address').val();
            $contact_no = $('#contact_no').val();


            $('#bookInfo_time').text(`Time: ${$timeFormat}`);
            $('#bookInfo_placePool').text(`Chosen Pool: ${$placePool}`);
            $('#bookInfo_room').text(`Room or Cottage: ${roomsAndCottages}`);
            $('#bookInfo_adults').text(`Number of Adults: ${$adults}`);
            $('#bookInfo_children').text(`Number of Children: ${$children}`);

            $('#bookInfo_name').text(`Name: ${$fname} ${$lname}`);
            $('#bookInfo_bday').text(`Birthday: ${$bday}`);
            $('#bookInfo_email').text(`Email: ${$email}`);
            $('#bookInfo_addr').text(`Address: ${$address}`);
            $('#bookInfo_contact').text(`Contact Number: ${$contact_no}`);

            $('#bookInfo_functionalHall').text(`Functional Hall: ${$eventContent}`);
            $('#bookInfo_inclusions').text(`Inclusions: ${$inclusionsContent}`)

            //PAYMENT 
            $('#payment_exlusiveReservationHeading').text($content); // for exclusive only
            $('#payment_exlusiveReservationPrice').text(`P ${$exclusivePrice}`); // for exclusive only

            $('#payment_typeOfReservation').text($content);
            $('#payment_totalPersons').text($totalPersons);
            $('#payment_admissionFeePrice').text(`P ${$admissionFee}`); // for non-exclusive only
            $('#payment_totalAdmissionFee').text(`P ${$totalAdmissionFee}`);
            $('#payment_inclusions').text(`P ${$inclusionsPrice}`);

            $('#payment_totalFee').text(`${$totalPaymentPrice}`);


        });


        $('#bookingBtn').on('click', () => {
            //VALUES
            $reservationType = $('input[name="type_of_reservation"]:checked').val();
            $dateStart = $('#dateStart').val();
            $dateEnd = '';

            $time = $('input[name = "timeBooked"]:checked').val();

            if ($('input[name = "timeBooked"]:checked').val() == 'day' || $('input[name = "timeBooked"]:checked')
                .val() == 'night') {
                //$dateEnd = 'night and day time';
                $dateEnd = moment($('#dateEnd').val()).subtract(1, 'days').format('YYYY-MM-DD');
            } else {
                $dateEnd = $('#dateEnd').val();
            }

            $placePool = $('input[name="place_of_pool"]:checked').val();

            let roomsAndCottages = $('input[name="room_cottage"]:checked').map(function() {
                return $(this).val();
            }).get();

            $adults = $('#adults').val();
            $children = $('#children').val();

            $event = '';
            $inclusions = ''

            if ($('input[name="functional_hall"]:checked').val() == 0) {
                $event = 0;
                $inclusions = 0;

            } else {
                $event = $('input[name="functional_hall"]:checked').val();
                $inclusions = $('input[name="inclusions"]:checked').val();
            }

            $fname = $('#first_name').val();
            $lname = $('#last_name').val();
            $bday = $('#birthday').val();
            $email = $('#email').val();
            $address = $('#address').val();
            $contact_no = $('#contact_no').val();
            $password = $('#password').val();

            $user = $('#userID').val();
            $userRole = $('#userRole').val();

            $paymentFee = $('#payment_totalFee').text();
            $modeOfPayment = $('input[name="mode_of_payment"]:checked').val();
            $paymentType = $('input[name="payment_type"]:checked').val();
            console.log($paymentFee)

            $downPayment = Number(50 / 100 * $paymentFee);

            swal({
                icon: 'warning',
                title: 'Warning',
                text: 'Are you sure you to reserve this booking?',
                buttons: {
                    cancel: 'Cancel',
                    true: 'OK'
                }
            }).then((response) => {
                if (response == 'true') {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your booking has been saved!',
                    }).then((response) => {
                        const formdata = new FormData();
                        formdata.append('reservation_type', $reservationType);
                        formdata.append('date_start', $dateStart);
                        formdata.append('date_end', $dateEnd);
                        formdata.append('time', $time);
                        formdata.append('place_pool', $placePool);
                        formdata.append('room_cottage_id', roomsAndCottages);
                        formdata.append('adults', $adults);
                        formdata.append('children', $children);

                        formdata.append('event', $event);
                        formdata.append('inclusions', $inclusions)

                        formdata.append('user', $user);
                        formdata.append('user_role', $userRole)

                        formdata.append('first_name', $fname);
                        formdata.append('last_name', $lname);
                        formdata.append('birthday', $bday);
                        formdata.append('email', $email);
                        formdata.append('address', $address);
                        formdata.append('contact_no', $contact_no);
                        formdata.append('password', $password);

                        formdata.append('mode_of_payment', $modeOfPayment)
                        formdata.append('total_price', $paymentFee);
                        formdata.append('payment_type', $paymentType)
                        formdata.append('down_payment', $downPayment)
                        formdata.append('payment_image', document.getElementById('receiptImage')
                            .files[0]);


                        let settings = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }

                        console.log([...formdata])

                        axios.post('/admin-addbooking', formdata)
                            .then(response => {
                                location.reload();
                            })
                    })
                }
            })
        })
    </script>

    {{-- NOTES:
    - continue the validations
    - guest side functions
    - payment function
     --}}
@endsection
