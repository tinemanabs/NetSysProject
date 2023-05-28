@extends('layouts.auth')

@section('content')
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
                                <th>Booking Date</th>
                                <th>Time</th>
                                <th>Pool</th>
                                <th>Room or Cottage</th>
                                <th>Guest Name</th>
                                <th>Payment Status</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
    {{-- @if (Auth::user()->user_role == 1)
        @include('features.booknow.admin')
    @elseif (Auth::user()->user_role == 2)
        @include('features.booknow.admin')
    @endif --}}

    {{-- NOTE:
        - POPULATE THE DATES THAT ARE ALREADY RESERVED 
        - DATE SHOULD BE DRAGGABLE INTO TO 2 DATES
        - DISABLE THE DAY / NIGHT IF NOT AVAILABLE
        - FILL OUT THE GUEST INFO FORMS
        - DESIGN THE UI FOR SUMMARY
        --}}
@endsection
