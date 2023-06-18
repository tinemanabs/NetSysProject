@extends('layouts.auth')
@section('title', 'Check Cottages')
@section('content')
    <div class="container-fluid">
        <h4>Check Cottages</h4>

        <form action="{{ route('checkcottage') }}" method="get">
            @csrf
            <div class="row mt-4 mb-4">
                <div class="col">
                    <input type="date" name="date" id="checkCottageDate" class="form-control">
                </div>
                <div class="col">
                    <select name="time" id="checkCottageTime" class="form-select">
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

        {{-- TODO: CHECK THE COTTAGES --}}
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
                                    <th>Cottage Name</th>
                                    <th>Availability Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cottages as $cottage)
                                    <tr>
                                        <td>{{ $cottage->id }}</td>
                                        <td>{{ $cottage->cottage_name }}</td>
                                        <td>
                                            @if (in_array($cottage->id, $bookings))
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
