@extends('layouts.auth')
@section('content')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3">Back</a>
        <div class="card">
            <div class="card-body">


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
                                <b>Room or Cottage:</b>
                                @foreach (json_decode($booking->room_id) as $reservedRoom)
                                    @foreach ($rooms as $room)
                                        @switch($reservedRoom)
                                            @case($room->id)
                                                {{ $room->room_name }}{{ $room->cottage_name }},
                                            @break
                                        @endswitch
                                    @endforeach
                                @endforeach

                                @if ($booking->room_id == '[0]')
                                    No room or cottage reserved.
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
                                    <img src="https://labaksamorong.com/NetSysProject-main/public/img/payments/{{ $booking->user_id }}/{{ $booking->payment_image }}"
                                        alt="" width="200" height="300">
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-lg-6">
                        <h6>Purchase and Rentals</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($purchaseAndRentals as $purchaseAndRental)
                                <li class="list-group-item">
                                    <b>Item Name:</b>
                                    {{ $purchaseAndRental->item_name }}
                                </li>
                                <li class="list-group-item">
                                    <b>Price: </b>
                                    P{{ $purchaseAndRental->price }}
                                </li>
                                <li class="list-group-item">
                                    <b>Receipt: </b>
                                </li>
                                <img src="https://labaksamorong.com/NetSysProject-main/public/img/payments/{{ $purchaseAndRental->item_payment_image }}"
                                    height="300" width="200" />
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->user_role == 1)
            <div class="d-flex flex-row justify-content-end mt-3">
                <button class="btn btn-success mb-3" id="completeBooking" data-id="{{ $booking->id }}">Complete
                    Booking</button>
            </div>
        @endif
    </div>


    <script>
        $('#completeBooking').on('click', () => {
            swal({
                title: 'Are you sure?',
                text: 'Do you want to complete this booking?',
                icon: 'warning',
                buttons: {
                    cancel: 'Cancel',
                    true: 'OK'
                }
            }).then((response) => {
                let id = {!! json_encode($booking->id) !!};
                let user_id = {!! json_encode($booking->user_id) !!}
                console.log(id);
                if (response == 'true') {
                    swal({
                        title: 'Success',
                        text: 'Changes have been made!',
                        icon: 'success'
                    }).then((response) => {
                        const formdata = new FormData();

                        formdata.append('booking_status', 'Completed')
                        formdata.append('is_booked', '0')
                        formdata.append('id', id);
                        formdata.append('user_id', user_id)

                        axios.post('/completeBooking/' + id, formdata)
                            .then(response => {
                                location.reload();
                            })
                    })
                }
            })
        })
    </script>
@endsection
