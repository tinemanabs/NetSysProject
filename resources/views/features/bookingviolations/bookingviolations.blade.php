@extends('layouts.auth')
@section('title', 'Booking Violations')
@section('content')
    <div class="container-fluid">
        <h4>Booking Violations</h4>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookingViolation">
                Add Violations
            </button>

            <div class="modal fade" id="addBookingViolation" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Violation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Bookings Today</label>
                                <input class="form-control" list="datalistOptions" name="datalistOptions"
                                    id="exampleDataList" placeholder="Type to search...">
                                <datalist id="datalistOptions">
                                    @foreach ($bookingsToday as $booking)
                                        <option value="{{ $booking->id }}" data-userId='{{ $booking->user_id }}'>
                                            {{ $booking->first_name }}
                                            {{ $booking->last_name }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">User ID</label>
                                <input type="text" disabled class="form-control" id="userId">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Violation Price</label>
                                <input type="text" class="form-control" id="violationPrice">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Violation Description</label>
                                <input type="text" class="form-control" id="violationDescription">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitViolation">Add Violation</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="row-border" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Booking</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($violations as $violation)
                                <tr>
                                    <td>{{ $violation->id }}</td>
                                    <td>{{ $violation->createdBy->first_name }} {{ $violation->createdBy->last_name }}</td>
                                    <td>{{ $violation->booking_id }}</td>
                                    <td>{{ $violation->violation_price }}</td>
                                    <td>{{ $violation->violation_description }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $violation->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit{{ $violation->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Violation
                                                            #{{ $violation->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Booking
                                                                ID</label>
                                                            <input type="text" value="{{ $violation->booking_id }}"
                                                                disabled class="form-control"
                                                                id="bookingId{{ $violation->id }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">User
                                                                ID</label>
                                                            <input type="text" value="{{ $violation->user_id }}"
                                                                disabled class="form-control"
                                                                id="userId{{ $violation->id }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Violation Price</label>
                                                            <input type="text"
                                                                value="{{ $violation->violation_price }}"
                                                                class="form-control"
                                                                id="violationPrice{{ $violation->id }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Violation Description</label>
                                                            <input type="text"
                                                                value="{{ $violation->violation_description }}"
                                                                class="form-control"
                                                                id="violationDescription{{ $violation->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="editViolation{{ $violation->id }}"
                                                            class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger" id="delete{{ $violation->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                <script>
                                    $("#editViolation{{ $violation->id }}").click(() => {
                                        const bookingId = $("#bookingId{{ $violation->id }}").val()
                                        const userId = $("#userId{{ $violation->id }}").val()
                                        const vPrice = $("#violationPrice{{ $violation->id }}").val()
                                        const vDesc = $("#violationDescription{{ $violation->id }}").val()

                                        if (bookingId != '' && userId != '' && vPrice != '' && vDesc != '') {
                                            const formdata = new FormData()
                                            formdata.append('id', '{{ $violation->id }}')
                                            formdata.append('violation_price', vPrice)
                                            formdata.append('violation_description', vDesc)

                                            axios.post("/editViolation", formdata)
                                                .then(() => {
                                                    swal({
                                                        icon: "success",
                                                        title: "Violation Edited!",
                                                        text: "The violation has been edited!"
                                                    }).then(() => {
                                                        location.reload()
                                                    })
                                                })
                                        } else {
                                            swal({
                                                icon: "warning",
                                                title: "Warning!",
                                                text: "Some fields are not properly filled!"
                                            })
                                        }
                                    })
                                    $("#delete{{ $violation->id }}").click(() => {
                                        swal({
                                            icon: 'warning',
                                            title: "Remove Violation?",
                                            text: "Are you sure you want to remove the violation?",
                                            buttons: true,
                                            dangerMode: true,
                                        }).then((response) => {
                                            if (response) {
                                                const formdata = new FormData()
                                                formdata.append('id', "{{ $violation->id }}")
                                                axios.post('/deleteViolation', formdata)
                                                    .then(() => {
                                                        swal({
                                                            icon: "success",
                                                            title: "Violation Removed!",
                                                            text: "The violation has been removed."
                                                        }).then(() => {
                                                            location.reload()
                                                        })
                                                    })
                                                    .catch(err => {
                                                        console.log(err.response)
                                                    })
                                            }
                                        })
                                    })
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            })

            $("input[name='datalistOptions']").on('input', function(e) {
                var selected = $(this).val();
                axios.get(`/getSelectedBookingUser/${selected}`)
                    .then((response) => {
                        $("#userId").val(response.data.user_id)
                    })
            });

            $("#submitViolation").click(() => {
                const bookingId = $("#exampleDataList").val()
                const userId = $("#userId").val()
                const violationPrice = $("#violationPrice").val()
                const violationDescription = $("#violationDescription").val()
                if (bookingId != '' && userId != '' && violationPrice != '' && violationDescription != '') {

                    const formdata = new FormData()

                    formdata.append('booking_id', bookingId)
                    formdata.append('user_id', userId)
                    formdata.append('violation_price', violationPrice)
                    formdata.append('violation_description', violationDescription)

                    axios.post('/addViolation', formdata)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Violation Added!",
                                text: "The violation is added for the booked user."
                            }).then(() => {
                                location.reload()
                            })

                        }).catch(err => {
                            console.log(err.response)
                        })
                } else {
                    swal({
                        icon: "warning",
                        title: "Warning!",
                        text: "Please fill in the form before submitting."
                    })
                }

            })
        </script>
    </div>
@endsection
