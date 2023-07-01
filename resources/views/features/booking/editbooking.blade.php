@extends('layouts.auth')
@section('title', 'Edit Booking')
@section('content')
    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode < 48 || ASCIICode > 57)
                return false;
            return true;
        }
    </script>
    <div class="container-fluid">
        <h4>Edit Booking</h4>

        <div class="multisteps-form mb-5">
            <!--progress bar-->
            <div class="row">
                <div class="col-12 col-lg-10 ms-auto me-auto mb-4">
                    <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button" title="Booking Details">Booking
                            Details</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Place of Swimming">Choose a
                            Pool</button>
                        <button class="multisteps-form__progress-btn" type="button"
                            title="Day / Night Swimming Rates">Choose a Time</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Choose a Date">Choose a
                            Date</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Number of Persons">Number of
                            Persons</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Booking Confirmation">Booking
                            Confirmation</button>
                    </div>
                </div>
            </div>
            <!--form panels-->
            <div class="row">
                <div class="col-12 col-lg-10 m-auto">
                    <form class="multisteps-form__form" method="POST" action="">
                        @csrf

                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Booking Details</h3>
                            <div class="multisteps-form__content">
                                {{-- START OF CONTENT --}}

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Booking ID</label>
                                        <input type="text" class="form-control" value="{{ $booking->id }}" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Guest Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $booking->first_name }} {{ $booking->last_name }}" readonly>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Reservation Type</label>
                                        <input type="text" class="form-control"
                                            value="{{ ucfirst($booking->reservation_type) }}" readonly>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Date:</label>
                                        @if ($booking->type == 'overnight')
                                            <input type="text" class="form-control"
                                                value="{{ date('M d, Y', strtotime($booking->date_start)) }} - {{ date('M d, Y', strtotime($booking->date_end)) }}"
                                                readonly>
                                        @else
                                            <input type="text" class="form-control"
                                                value="{{ date('M d, Y', strtotime($booking->date_start)) }}" readonly>
                                        @endif

                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Time</label>
                                        @if ($booking->type == 'day')
                                            <input type="text" class="form-control" value="8:00 AM - 5:00 PM" readonly>
                                        @elseif ($booking->type == 'night')
                                            <input type="text" class="form-control" value="7:00 PM - 11:00 PM" readonly>
                                        @else
                                            <input type="text" class="form-control" value="7:00 PM - 8:00 AM" readonly>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Adults</label>
                                        <input type="text" class="form-control" value="{{ $booking->adults }}" readonly>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Children</label>
                                        <input type="text" class="form-control" value="{{ $booking->children }}"
                                            readonly>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="" class="form-label">Rooms Reserved</label>
                                        {{-- <input type="text" class="form-control mb-2" value="{{ $roomsStr }}"
                                            readonly> --}}
                                        @if ($booking->room_id == '[0]')
                                            <p>No rooms or cottages reserved.</p>
                                        @else
                                            @foreach ($rooms as $room)
                                                @if (in_array($room->id, json_decode($booking->room_id)))
                                                    <input type="text" class="form-control mb-2"
                                                        value="{{ $room->room_id }}{{ $room->cottage_name }}" readonly>
                                                @endif
                                            @endforeach
                                        @endif

                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Functional Hall</label>
                                        @if ($booking->functional_hall == '9')
                                            <input type="text" class="form-control" value="No reserved functional hall."
                                                readonly>
                                        @else
                                            <input type="text" class="form-control"
                                                value="{{ $booking->functional_hall }}" readonly>
                                        @endif
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Inlusions</label>
                                        @if ($booking->inclusions == '0')
                                            <input type="text" class="form-control" value="No inclusions added."
                                                readonly>
                                        @else
                                            <input type="text" class="form-control"
                                                value="{{ $booking->inclusions }}" readonly>
                                        @endif
                                    </div>
                                </div>


                                <div class="button-row d-flex mt-4">
                                    <a class="btn btn-outline-secondary me-auto" href="{{ route('booknow') }}"
                                        role="button" title="Next">Cancel</a>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button"
                                        title="Next">Next</button>
                                </div>
                            </div>
                        </div>

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
                                                        value="taas"
                                                        {{ $booking->place_pool == 'taas' ? 'checked' : '' }}>
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
                                                        value="baba"
                                                        {{ $booking->place_pool == 'baba' ? 'checked' : '' }}>
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
                                        id="nextBtnToType">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF PLACE OF POOL -->

                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Choose a Time</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="card h-100 rooms-cottages-card p-4">
                                            <i class="fa-solid fa-sun fa-10x m-auto text-warning"></i>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input id="daySwimming" type="radio" name="timeBooked"
                                                        value="day" {{ $booking->type == 'day' ? 'checked' : '' }}>
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
                                                        value="night" {{ $booking->type == 'night' ? 'checked' : '' }}>
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
                                                        value="overnight"
                                                        {{ $booking->type == 'overnight' ? 'checked' : '' }}>
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
                                        id="nextBtnToDate">Next</button>
                                </div>
                            </div>
                        </div>

                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Choose a Date</h3>
                            <div class="multisteps-form__content">

                                <div id='calendar'></div>
                                <input type="text" name="date_Start" id="dateStart" hidden
                                    value="{{ $booking->date_start }}">
                                <input type="text" name="date_End" id="dateEnd" hidden
                                    value="{{ $booking->date_end }}">

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToPeople">Next</button>
                                </div>
                            </div>
                        </div>

                        <!--single form panel: NUMBER OF PEOPLE CONTENT -->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn"
                            id="paxCard">
                            <h3 class="multisteps-form__title">Indicate number of Persons</h3>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label">Adults</label>
                                        <input type="text" class="form-control mb-3" name="adults" id="adults"
                                            onkeypress="return onlyNumberKey(event)" value="{{ $booking->adults }}">

                                        <label for="" class="form-label">Children</label>
                                        <input type="text" class="form-control mb-3" name="children" id="children"
                                            onkeypress="return onlyNumberKey(event)" value="{{ $booking->children }}">
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="nextBtnToSummary">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel: END OF NUMBER OF PEOPLE CONTENT -->

                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Booking Confirmation</h3>
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

                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev" type="button"
                                        title="Prev">Prev</button>
                                    <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                        id="bookingBtn">Next</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

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
        // DOMstrings.stepsBar.addEventListener('click', e => {
        //     //check if click target is a step button
        //     const eventTarget = e.target;
        //     if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
        //         return;
        //     }
        //     //get active button step number
        //     const activeStep = getActiveStep(eventTarget);
        //     //set all steps before clicked (and clicked too) to active
        //     setActiveStep(activeStep);
        //     //open active panel
        //     setActivePanel(activeStep);
        // });
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
        const bookingAdults = {!! json_encode($booking->adults) !!};
        const bookingChildren = {!! json_encode($booking->children) !!}
        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
                activePanelNum--;
            } else if (activePanelNum == 0) {
                activePanelNum++;
            } else if (activePanelNum == 1 && $('input[name="place_of_pool"]:checked').val() != undefined) {
                console.log($('input[name="place_of_pool"]:checked').val())
                activePanelNum++;
            } else if (activePanelNum == 2 && $('input[name="timeBooked"]:checked').val() != undefined) {
                console.log($('input[name="timeBooked"]:checked').val())
                activePanelNum++;
            } else if (activePanelNum == 3 && $('#dateStart').val() != '') {
                console.log($('#dateStart').val())
                activePanelNum++;
            } else if (activePanelNum == 4 && $('#adults').val() != '' && $('#children').val() != '' && !(Number($(
                    '#adults').val()) < Number(bookingAdults)) && !(Number($('#children').val()) < Number(
                    bookingChildren))) {
                console.log($('#adults').val(), $('#children').val())
                activePanelNum++;
            }
            setActiveStep(activePanelNum);
            setActivePanel(activePanelNum);
        });
        //SETTING PROPER FORM HEIGHT ONLOAD
        window.addEventListener('load', setFormHeight, false);
        //SETTING PROPER FORM HEIGHT ONRESIZE
        window.addEventListener('resize', setFormHeight, false);
    </script>

    {{-- VALIDATIONS --}}
    <script>
        $reservationType = {!! json_encode($booking->reservation_type) !!};

        if ($reservationType == 'non-exclusive') {
            $('#radioBtnForNight').hide('#radioBtnForNight')
            $('#radioBtnForOvn').hide('#radioBtnForOvn')
        }

        // TIME OF BOOKING VALIDATION AND DISABLING DATES
        $('#nextBtnToDate').on('click', () => {
            if (!$('input[name ="timeBooked"]').is(':checked')) {
                swal({
                    icon: 'warning',
                    title: "Select a time!",
                    text: "Please choose a time."
                })
            } else {
                const bookingStart = {!! json_encode($booking->date_start) !!};
                const bookingEnd = {!! json_encode($booking->date_end) !!};
                const placePool = $('input[name="place_of_pool"]:checked').val();
                const timeBooked = $('input[name="timeBooked"]:checked').val();
                const bookingID = {!! json_encode($booking->id) !!}

                console.log(placePool, timeBooked)
                axios.get('/getDisabledEditDates', {
                        params: {
                            timeBooked: timeBooked,
                            place_of_pool: placePool,
                            booking_id: bookingID
                        }
                    })
                    .then((response) => {
                        const disabledDates = response.data;
                        initializeCalendar(disabledDates);

                        console.log(disabledDates)
                    })
                    .catch(error => {
                        console.log(error)
                    });

                function initializeCalendar(disabledDates) {
                    let calendarEl = document.getElementById('calendar');
                    let calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        selectable: true,
                        height: 700,
                        dateClick: function(info) {
                            const clickedDate = info.dateStr;

                            if (disabledDates.includes(clickedDate)) {
                                swal({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: `This date is already reserved!`
                                });

                                console.log(disabledDates)
                                return;
                            }
                            console.log(disabledDates)
                            $dateStart = $('#dateStart').val(moment(info.dateStr).format('YYYY-MM-DD'));
                            $dateEnd = $('#dateEnd').val(moment(info.dateStr).add(1, 'days').format(
                                'YYYY-MM-DD'));

                        },
                        validRange: {
                            start: moment().format('YYYY-MM-DD')
                        },
                        dayCellDidMount: function(cell) {
                            const cellDate = moment(cell.date).format('YYYY-MM-DD');

                            if (disabledDates.includes(cellDate)) {
                                // Date is disabled, gray out the cell
                                cell.el.classList.add('disabled-cell');
                            }

                            if (cellDate === bookingStart || cellDate === bookingEnd) {
                                cell.el.classList.add('booking-cell')
                            }
                        }

                    });
                    calendar.render();
                }
            }
        });
    </script>

    {{-- SUMMARY & PAYMENT & SUBMISSION OF FORM --}}
    <script>
        $('#nextBtnToSummary').on('click', () => {
            $bookingAdults = {!! json_encode($booking->adults) !!};
            $bookingChildren = {!! json_encode($booking->children) !!}
            if ($('#adults').val() == '' || $('#children').val() == '') {
                swal({
                    icon: 'warning',
                    title: "Invalid Input!",
                    text: "Please indicate the number of persons."
                })
            } else if (Number($('#adults').val()) < Number($bookingAdults) || Number($('#children').val()) < Number(
                    $bookingChildren)) {
                swal({
                    icon: 'warning',
                    title: "Invalid Input!",
                    text: "Lesser value from the previous booking can't be processed."
                })
            } else {
                //VALUES
                $typeOfReservation = {!! json_encode($booking->reservation_type) !!}
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

                let totalRoomPrice = {!! json_encode($totalRoomPriceArr) !!};

                let roomValue = {!! json_encode($roomsStr) !!};
                let roomsAndCottages = '';
                if (roomValue == 0) {
                    roomsAndCottages = 'No rooms or cottages.';
                } else {
                    roomsAndCottages = {!! json_encode($roomsStr) !!};

                }

                // let roomsAndCottages = $('input[name="room_cottage"]:checked').map(function() {
                //     $roomID = $(this).val();
                //     if ($roomID != 0) {
                //         return $('#roomCottageName' + $roomID).text();
                //     } else {
                //         return 'No room or cottage.'
                //     }

                // }).get(); // displays the chosen rooms & cottages

                // let roomsAndCottagesPrice = $('input[name="room_cottage"]:checked').map(function() {
                //     $roomID = $(this).val();
                //     if ($roomID != 0) {
                //         return $('#roomCottagePrice' + $roomID).text();
                //     } else {
                //         return 0;
                //     }

                // }).get(); // gets the prices of rooms selected

                // roomsAndCottagesPrice.map((item, index) => {
                //     totalRoomPrice = totalRoomPrice + Number(item)
                // }) // stores the prices of each room selected

                // intialized it here to retrieve the total room price
                $('#payment_roomCottagePrice').text(`${totalRoomPrice}`);
                $totalRoomCottagePrice = Number($('#payment_roomCottagePrice').text());


                $adults = $('#adults').val();
                $children = $('#children').val();
                $totalPersons = Number($adults) + Number($children);

                // events & inclusions are for exclu day & overnight 
                $event = {!! json_encode($booking->functional_hall) !!}
                $inclusions = {!! json_encode($booking->inclusions) !!}
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
                        $dateEnd = moment($('#dateStart').val()).add(1, 'days').format('ll');

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

                        console.log($exclusivePrice, $totalAdmissionFee, $totalRoomCottagePrice,
                            $inclusionsPrice)

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
                    $eventContent = {!! json_encode($booking->functional_hall) !!};
                    $inclusionsContent = {!! json_encode($booking->inclusions) !!};
                }


                $fname = {!! json_encode($booking->first_name) !!};
                $lname = {!! json_encode($booking->last_name) !!}
                $bday = moment({!! json_encode($booking->birthday) !!}).format('ll');
                $email = {!! json_encode($booking->email) !!}
                $address = {!! json_encode($booking->address) !!}
                $contact_no = {!! json_encode($booking->contact_no) !!}


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
                if ($typeOfReservation == 'exclusive') {
                    $('#payment_exlusiveReservationHeading').text($content); // for exclusive only
                    $('#payment_exlusiveReservationPrice').text(`P ${$exclusivePrice}`); // for exclusive only
                }


                $('#payment_typeOfReservation').text($content);
                $('#payment_totalPersons').text($totalPersons);
                $('#payment_admissionFeePrice').text(`P ${$admissionFee}`); // for non-exclusive only
                $('#payment_totalAdmissionFee').text(`P ${$totalAdmissionFee}`);
                $('#payment_inclusions').text(`P ${$inclusionsPrice}`);

                $('#payment_totalFee').text(`${$totalPaymentPrice}`);
            }
        })

        $('#bookingBtn').on('click', () => {
            $dateStart = $('#dateStart').val();
            $dateEnd = '';

            $time = $('input[name = "timeBooked"]:checked').val();

            if ($('input[name = "timeBooked"]:checked').val() == 'day' || $('input[name = "timeBooked"]:checked')
                .val() == 'night') {
                //$dateEnd = 'night and day time';
                $dateEnd = $dateStart; // had conflict when input value has been added explicitly
            } else {
                $dateEnd = moment($('#dateStart').val()).add(1, 'days').format(
                    'YYYY-MM-DD'); // TODO: change for overnight
            }

            $placePool = $('input[name="place_of_pool"]:checked').val();
            $paymentFee = $('#payment_totalFee').text();
            $bookingID = {!! json_encode($booking->id) !!}
            $adults = $('#adults').val();
            $children = $('#children').val();

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

                        formdata.append('place_pool', $placePool);
                        formdata.append('time', $time);
                        formdata.append('date_start', $dateStart);
                        formdata.append('date_end', $dateEnd);
                        formdata.append('adults', $adults);
                        formdata.append('children', $children);
                        formdata.append('total_price', $paymentFee);

                        console.log([...formdata])

                        axios.post('/admin-updatebooking/' + $bookingID, formdata)
                            .then(response => {
                                location.reload();
                            })
                    })
                }
            })
        })
    </script>
@endsection
