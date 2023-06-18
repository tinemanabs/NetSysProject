<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Booking</h4>
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
                                                    {{-- <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal{{ $booking->id }}">View</button> --}}
                                                    <a href="{{ route('viewBooking', $booking->id) }}"
                                                        class="dropdown-item">View</a>
                                                </li>
                                                {{-- <li><button class="dropdown-item">Edit</button></li> --}}
                                                @if ($booking->payment_type == 'Down Payment')
                                                    <li><button class="dropdown-item"
                                                            id="checkFullPaymentBtn{{ $booking->id }}"
                                                            data-id="{{ $booking->id }}">Check Full Payment</button>
                                                    </li>
                                                @endif
                                                @if ($booking->payment_status != 1)
                                                    <li>
                                                        <button class="dropdown-item"
                                                            id="approvePaymentBtn{{ $booking->id }}"
                                                            data-id="{{ $booking->id }}">Approve
                                                            Payment Status</button>
                                                    </li>
                                                @endif
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
