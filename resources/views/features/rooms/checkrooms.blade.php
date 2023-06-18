@extends('layouts.auth')
@section('title', 'Check Rooms')
@section('content')
    <div class="container-fluid">
        <h4>Check Rooms</h4>

        <form action="{{ route('checkroom') }}" method="get">
            @csrf
            <div class="row mt-4 mb-4">
                <div class="col">
                    <input type="date" name="date" id="checkRoomDate" class="form-control">
                </div>
                <div class="col">
                    <select name="time" id="checkRoomTime" class="form-select">
                        <option selected disabled>Select Time</option>
                        <option value="day"{{ isset($_GET['time']) == 'day' ? 'selected' : '' }}>Day</option>
                        <option value="night"{{ isset($_GET['time']) == 'night' ? 'selected' : '' }}>Night</option>
                        <option value="overnight"{{ isset($_GET['overnight']) == 'overnight' ? 'selected' : '' }}>Overnight
                        </option>
                    </select>
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>

        {{-- TODO: CHECK THE ROOMS --}}
        @isset($_GET['date'])
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Date: {{ date('F d, Y', strtotime($_GET['date'])) }}</h5>
                    <h5 class="card-title">Time: {{ ucfirst($_GET['time']) }}</h5>
                    <div class="table-responsive mt-4">
                        <table id="myTable" class="row-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th>Availability Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->room_id }}</td>
                                        <td>{{ $room->room_name }}</td>
                                        <td>
                                            @if (in_array($room->id, $bookings))
                                                <span class="badge bg-danger">Reserved</span>
                                            @else
                                                <span class="badge bg-success">Available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- @foreach ($bookings as $booking)
                {{ $booking }}
            @endforeach --}}
        @endisset
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
