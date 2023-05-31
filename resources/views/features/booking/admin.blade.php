<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6>Booking</h6>
        <a class="btn btn-primary" href="{{ route('addbooking') }}" role="button">Add Booking</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Booking Date</th>
                            <th>Time</th>
                            <th>Pool</th>
                            <th>Guest Name</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allBookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>
                                    @if ($booking->reservation_type == 'exclusive')
                                        <span class="badge bg-success">
                                            E
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            NE
                                        </span>
                                    @endif

                                </td>
                                <td>
                                    @if ($booking->type == 'overnight')
                                        {{ date('M d, Y', strtotime($booking->date_start)) }} -
                                        {{ date('M d, Y', strtotime($booking->date_end)) }}
                                    @else
                                        {{ date('M d, Y', strtotime($booking->date_start)) }}
                                    @endif

                                </td>
                                <td>
                                    {{ $booking->type }}
                                </td>
                                <td>
                                    {{ $booking->place_pool }}
                                </td>
                                <td>
                                    {{ $booking->first_name }} {{ $booking->last_name }}
                                </td>
                                <td>
                                    @if ($booking->payment_type == 'Full Payment')
                                        <span class="badge bg-success">
                                            Fully Paid
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            Partially Paid
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->payment_status == 1)
                                        <span class="badge bg-success">
                                            Approved
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            TBC
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="dropdown">
                                            <a class="btn-sm" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v text-secondary fa-2x"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal{{ $booking->id }}">View</button>
                                                </li>
                                                <li><button class="dropdown-item">Edit</button></li>
                                                @if ($booking->payment_type == 'Down Payment')
                                                    <li><button class="dropdown-item"
                                                            id="checkFullPaymentBtn{{ $booking->id }}"
                                                            data-id="{{ $booking->id }}">Check Full Payment</button>
                                                @endif
                                                </li>
                                                <li><button class="dropdown-item"
                                                        id="approvePaymentBtn{{ $booking->id }}"
                                                        data-id="{{ $booking->id }}">Approve
                                                        Payment Status</button></li>
                                                <li><button class="dropdown-item"
                                                        id="deleteBookingBtn{{ $booking->id }}"
                                                        data-id="{{ $booking->id }}">Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <script>
                                //check full payment
                                $('#checkFullPaymentBtn{{ $booking->id }}').on('click', () => {
                                    swal({
                                        title: 'Are you sure?',
                                        text: 'Do you want approve this booking is already fully paid?',
                                        icon: 'warning',
                                        buttons: {
                                            cancel: 'Cancel',
                                            true: 'OK'
                                        }
                                    }).then((response) => {
                                        if (response == 'true') {
                                            swal({
                                                title: 'Success',
                                                text: 'You have changed the payment type for this booking!',
                                                icon: 'success'
                                            }).then((response) => {
                                                let id = $('#checkFullPaymentBtn{{ $booking->id }}').data('id');
                                                let totalPrice = {{ $booking->total_price }}
                                                console.log(totalPrice);
                                                console.log(id);

                                                const formdata = new FormData();
                                                formdata.append('book_id', id);
                                                formdata.append('total_price', totalPrice);
                                                axios.post('/checkFullPayment/' + id, formdata)
                                                    .then((response) => {
                                                        location.reload();
                                                    })
                                            })
                                        }
                                    })
                                })


                                // approve payment function
                                $('#approvePaymentBtn{{ $booking->id }}').on('click', () => {
                                    swal({
                                        title: 'Are you sure?',
                                        text: 'Do you want to approve this payment?',
                                        icon: 'warning',
                                        buttons: {
                                            cancel: 'Cancel',
                                            true: 'OK'
                                        }
                                    }).then((response) => {
                                        if (response == 'true') {
                                            swal({
                                                title: 'Success',
                                                text: 'You have approved the payment for this booking!',
                                                icon: 'success'
                                            }).then((response) => {
                                                let id = $('#approvePaymentBtn{{ $booking->id }}').data('id');
                                                console.log(id);

                                                const formdata = new FormData();
                                                formdata.append('book_id', id);
                                                axios.post('/approvePaymentStatus/' + id, formdata)
                                                    .then((response) => {
                                                        location.reload();
                                                    })
                                            })
                                        }
                                    })
                                })

                                //delete function

                                $('#deleteBookingBtn{{ $booking->id }}').on('click', () => {
                                    swal({
                                        title: 'Are you sure?',
                                        text: 'Do you want to delete this booking?',
                                        icon: 'warning',
                                        buttons: {
                                            cancel: 'Cancel',
                                            true: 'OK'
                                        }
                                    }).then((response) => {
                                        if (response == 'true') {
                                            swal({
                                                title: 'Success',
                                                text: 'You have successfully deleted this booking!',
                                                icon: 'success'
                                            }).then((response) => {
                                                let id = $('#deleteBookingBtn{{ $booking->id }}').data('id');
                                                console.log(id);

                                                const formdata = new FormData();
                                                formdata.append('book_id', id);
                                                axios.post('/deleteBooking/' + id, formdata)
                                                    .then((response) => {
                                                        location.reload();
                                                    })
                                            })
                                        }
                                    })
                                })
                            </script>

                            <!-- Modal for View Button -->
                            <div class="modal fade" id="viewModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel">View Booking Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <h6>Booking Details</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <b>Reservation Type:</b>
                                                            {{ $booking->reservation_type }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Booking Date:</b>
                                                            @if ($booking->type == 'overnight')
                                                                {{ date('M d, Y', strtotime($booking->date_start)) }} -
                                                                {{ date('M d, Y', strtotime($booking->date_end)) }}
                                                            @else
                                                                {{ date('M d, Y', strtotime($booking->date_start)) }}
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Time:</b>
                                                            @if ($booking->type == 'day')
                                                                8:00 AM - 5:00 PM
                                                            @elseif ($booking->type == 'night')
                                                                7:00 PM - 11:00 PM
                                                            @else
                                                                7:00 PM - 8:00 AM
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Pool:</b>
                                                            {{ $booking->place_pool }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Adults:</b>
                                                            {{ $booking->adults }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Children:</b>
                                                            {{ $booking->children }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <h6>Personal Information</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <b>Guest Name:</b>
                                                            {{ $booking->first_name }} {{ $booking->last_name }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Email:</b>
                                                            {{ $booking->email }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Birthday:</b>
                                                            {{ $booking->birthday }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Address:</b>
                                                            {{ $booking->address }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Contact Number:</b>
                                                            {{ $booking->contact_no }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mt-5">
                                                <div class="col-12 col-lg-6">
                                                    <h6>Event Information</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <b>Functional Hall:</b>
                                                            @if ($booking->functional_hall != '0')
                                                                {{ $booking->functional_hall }}
                                                            @else
                                                                No functional hall reserved.
                                                            @endif
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Inclusions:</b>
                                                            @if ($booking->inclusions != '0')
                                                                {{ $booking->inclusions }}
                                                            @else
                                                                No inclusions added.
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <h6>Payment Information</h6>

                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <b>Total Paid:</b>
                                                            {{ $booking->total_paid }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Total Price:</b>
                                                            {{ $booking->total_price }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Payment Type:</b>
                                                            {{ $booking->payment_type }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Payment Status:</b>
                                                            @if ($booking->payment_status == 1)
                                                                <span class="badge bg-success">
                                                                    Paid
                                                                </span>
                                                            @else
                                                                <span class="badge bg-warning">
                                                                    TBC
                                                                </span>
                                                            @endif
                                                        </li>

                                                        @if ($booking->payment_image != null)
                                                            <li class="list-group-item">
                                                                <b>Receipt:</b>
                                                                <br>
                                                                <img src="{{ asset('img/payments/' . $booking->user_id . '/' . $booking->payment_image) }}"
                                                                    alt="" width="200">
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of modal -->
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
