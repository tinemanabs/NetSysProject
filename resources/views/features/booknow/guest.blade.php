<h4>Booking</h4>

<div class="multisteps-form mb-5">
    <!--progress bar-->
    <div class="row">
        <div class="col-12 col-lg-10 ms-auto me-auto mb-4">
            <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button"
                    title="Choose a Room or Cottage">Choose a
                    Room or Cottage</button>
                <button class="multisteps-form__progress-btn" type="button" title="Choose a Date">Choose a
                    Date</button>
                <button class="multisteps-form__progress-btn" type="button" title="Day / Night Swimming Rates">Day
                    or Night Swimming</button>
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
            <form class="multisteps-form__form" method="POST" action="">
                @csrf

                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Choose a Room or Cottage</h3>
                    <div class="multisteps-form__content">
                        {{-- START OF CONTENT --}}

                        <h4>Rooms</h4>
                        <div class="row row-cols-2 row-cols-lg-3 g-4 mb-3">
                            @foreach ($rooms as $room)
                                <div class="col">
                                    <div class="card h-100 rooms-cottages-card">
                                        <img src="{{ asset('img/rooms/' . $room->room_id . '/' . $room->room_cottage_image) }}"
                                            class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="{{ $room->room_id }}" type="radio" name="room_cottage"
                                                    value="{{ $room->id }}">
                                                <label for="{{ $room->room_id }}">{{ $room->room_id }}</label>
                                            </h5>

                                            <p class="card-text">{{ $room->room_name }}</p>
                                            <p class="card-text">{{ $room->room_cottage_price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h4>Cottages</h4>
                        <div class="row row-cols-2 row-cols-lg-3 g-4">
                            @foreach ($cottages as $cottage)
                                <div class="col">
                                    <div class="card h-100 rooms-cottages-card">
                                        <img src="{{ asset('img/cottages/' . $cottage->cottage_name . '/' . $cottage->room_cottage_image) }}"
                                            class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="{{ $cottage->cottage_name }}" type="radio"
                                                    name="room_cottage" value="{{ $cottage->id }}">
                                                <label
                                                    for="{{ $cottage->cottage_name }}">{{ $cottage->cottage_name }}</label>
                                            </h5>

                                            <p class="card-text">{{ $cottage->cottage_name }}</p>
                                            <p class="card-text">{{ $cottage->room_cottage_price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="button-row d-flex mt-4">
                            <a class="btn btn-outline-secondary me-auto" href="" role="button"
                                title="Next">Cancel</a>
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
                        <input type="text" name="date_booked" id="dateBooked">
                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            <button class="btn btn-primary ms-auto js-btn-next" type="button" id="nextBtnToType"
                                title="Next">Next</button>
                        </div>
                    </div>
                </div>

                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Day / Night Swimming Rates</h3>
                    <div class="multisteps-form__content">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card h-100 rooms-cottages-card p-4">
                                    <i class="fa-solid fa-sun fa-10x m-auto text-warning"></i>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <input id="day_swimming" type="radio" name="is_half" value="day">
                                            <label for="">Day Swimming</label>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card h-100 rooms-cottages-card p-4"style="background-color: #1F1D28;">
                                    <i class="fa-solid fa-moon fa-10x m-auto text-white"></i>
                                    <div class="card-body text-white">
                                        <h5 class="card-title">
                                            <input id="night_swimming" type="radio" name="is_half" value="night">
                                            <label for="">Night Swimming</label>
                                        </h5>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="" class="form-label">Adults</label>
                                <input type="text" class="form-control mb-3" name="adults" id="adults">

                                <label for="" class="form-label">Children</label>
                                <input type="text" class="form-control mb-3" name="children" id="children">
                            </div>
                        </div>

                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                id="nextBtnToInfo">Next</button>
                        </div>
                    </div>
                </div>

                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Guest Information</h3>
                    <div class="multisteps-form__content">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">Birthdate</label>
                                <input type="date" name="birthday" class="form-control">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="" class="form-label">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control">
                            </div>
                        </div>

                        <input type="text" value="{{ Auth::user()->id }}" id="user">

                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            <button class="btn btn-primary ms-auto js-btn-next" type="button"
                                title="Next">Next</button>
                        </div>
                    </div>
                </div>

                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Summary and Payment</h3>
                    <div class="multisteps-form__content">
                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            <button class="btn btn-success ms-auto" type="button" title="Submit"
                                id="bookingBtn">Submit</button>
                        </div>
                    </div>
                </div>

            </form>
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
            if (activePanelNum == 0 && $('input[name = "room_cottage"]:checked').val() != undefined) {
                console.log($('input[name = "room_cottage"]:checked').val())
                activePanelNum++;
            } else if (activePanelNum == 1 && $('#dateBooked').val() != '') {
                console.log($('#dateBooked').val())
                activePanelNum++;
            } else if (activePanelNum == 2 && $('input[name = "is_half"]:checked').val() != undefined && $(
                    '#adults').val() != '' && $('#children').val()) {
                console.log($('input[name = "is_half"]:checked').val())
                console.log($('#adults').val())
                console.log($('#children').val())
                activePanelNum++;
            } else if (activePanelNum == 3) {
                activePanelNum++;
            }

        }
        setActiveStep(activePanelNum);
        setActivePanel(activePanelNum);
    });
    //SETTING PROPER FORM HEIGHT ONLOAD
    window.addEventListener('load', setFormHeight, false);
    //SETTING PROPER FORM HEIGHT ONRESIZE
    window.addEventListener('resize', setFormHeight, false);
</script>

<script>
    $('#nextBtnToDate').on('click', () => {
        if (!$('input[name = "room_cottage"]').is(':checked')) {
            swal({
                icon: 'warning',
                title: 'Select a Room or Cottage',
                text: 'Please choose the room or cottage you want to reserve.'
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

    $('#nextBtnToInfo').on('click', () => {
        if (!$('input[name = "room_cottage"]').is(':checked') ||
            $('#adults').val() == '' ||
            $('#children').val() == '') {
            swal({
                icon: 'warning',
                title: 'Choose if day or night',
                text: 'Please choose your preferred time.'
            })
        }
    });
</script>

<script>
    const clickDate = (info) => {
        $dateBooked = $('#dateBooked').val(info.dateStr);
    }
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        height: 500,
        dateClick: clickDate,

    });
    calendar.render();


    $('#bookingBtn').on('click', () => {
        $room_id = $('input[name = "room_cottage"]:checked').val();
        $date = $('#dateBooked').val();
        $day = $('input[name = "is_half"]:checked').val();
        $adults = $('#adults').val();
        $children = $('#children').val();
        $user = $('#user').val();

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
                    formdata.append('room_id', $room_id);
                    formdata.append('date', $date);
                    formdata.append('day', $day);
                    formdata.append('adults', $adults);
                    formdata.append('children', $children);
                    formdata.append('user', $user);

                    console.log([...formdata])

                    axios.post('/addbooking', formdata)
                        .then(response => {
                            location.reload();
                        })
                })
            }
        })
    })
</script>
