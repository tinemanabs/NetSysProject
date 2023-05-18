@extends('layouts.auth')

@section('content')
    <h4>Book an Event</h4>

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
                    <button class="multisteps-form__progress-btn" type="button" title="Day or Night">Choose a Time</button>
                    <button class="multisteps-form__progress-btn" type="button" title="Inclusions">Inclusions</button>
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
                        <h3 class="multisteps-form__title">Choose a Functional Hall</h3>
                        <div class="multisteps-form__content">
                            {{-- START OF CONTENT --}}
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 functional-halls-card">
                                        <img src="{{ asset('img/events/1.png') }}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="" type="radio" name="functional_hall"
                                                    value="Ilang-Ilang">
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
                                                <input id="" type="radio" name="functional_hall" value="Jasmin">
                                                <label for="">Jasmin</label>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
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
                        <h3 class="multisteps-form__title">Day / Night</h3>
                        <div class="multisteps-form__content">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 rooms-cottages-card p-4">
                                        <i class="fa-solid fa-sun fa-10x m-auto text-warning"></i>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="dayEvent" type="radio" name="time" value="day">
                                                <label for="">Day</label>
                                            </h5>

                                            <p class="card-text">Time: 8:00 AM - 5:00 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 rooms-cottages-card p-4"style="background-color: #1F1D28;">
                                        <i class="fa-solid fa-moon fa-10x m-auto text-white"></i>
                                        <div class="card-body text-white">
                                            <h5 class="card-title">
                                                <input id="nightEvent" type="radio" name="time" value="night">
                                                <label for="">Night</label>
                                            </h5>
                                            <p class="card-text">Time: 7:00 PM - 8:00 AM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ms-auto js-btn-next" type="button" title="Next"
                                    id="nextBtnToInclusions">Next</button>
                            </div>
                        </div>
                    </div>

                    <!--single form panel-->
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                        <h3 class="multisteps-form__title">Inclusions</h3>
                        <div class="multisteps-form__content">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 rooms-cottages-card p-4">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input id="withTablesChairs" type="radio" name="time"
                                                    value="1">
                                                <label for="">With Tables and Chairs</label>
                                            </h5>

                                            <p class="card-text">3000</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 rooms-cottages-card p-4"style="background-color: #1F1D28;">
                                        <div class="card-body text-white">
                                            <h5 class="card-title">
                                                <input id="withoutTablesChairs" type="radio" name="time"
                                                    value="0">
                                                <label for="">Without Tables</label>
                                            </h5>
                                            <p class="card-text">2000</p>
                                        </div>
                                    </div>
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
        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
                activePanelNum--;
            } else {
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
    </script>
@endsection
