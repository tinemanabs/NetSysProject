@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <h4>Book an Event</h4>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guest Name</th>
                                <th>Booking Date</th>
                                <th>Time</th>
                                <th>Functional Hall</th>
                                <th>Inclusions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->first_name }} {{ $event->last_name }}</td>
                                    <td>
                                        @if ($event->type == 'overnight')
                                            {{ date('M d, Y', strtotime($event->date_start)) }} -
                                            {{ date('M d, Y', strtotime($event->date_end)) }}
                                        @else
                                            {{ date('M d, Y', strtotime($event->date_start)) }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $event->type }}
                                    </td>
                                    <td>
                                        {{ $event->functional_hall }}
                                    </td>
                                    <td>
                                        {{ $event->inclusions }}
                                    </td>
                                    <td>
                                        <a href="{{ route('viewBooking', $event->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [
                    [2, 'asc']
                ]
            });
        });
    </script>
@endsection
