@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h4>Rooms Management</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                Add Room
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Name</th>
                                <th>Place of Pool</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                @if ($room->room_name != null)
                                    <tr>
                                        <td>{{ $room->room_id }}</td>
                                        <td>{{ $room->room_name }}</td>
                                        <td>{{ $room->place_room_cottage }}</td>
                                        <td>P {{ $room->room_cottage_price }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $room->id }}">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <button class="btn btn-danger btn-sm" id="deleteBtn{{ $room->id }}"
                                                data-id="{{ $room->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    {{-- VIEW MODAL --}}
                                    @include('features.rooms.viewroom')

                                    {{-- DELETE ROOM --}}
                                    @include('features.rooms.deleteroom')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- CREATE ROOM MODAL AND JS FUNCTION --}}
        @include('features.rooms.createroom')

    </div>
@endsection
