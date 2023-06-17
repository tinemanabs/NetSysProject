{{-- VIEW ROOM MODAL --}}
<div class="modal fade" id="viewModal{{ $room->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Room Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('img/rooms/' . $room->room_id . '/' . $room->room_cottage_image) }}"
                        alt="" width="400">
                </div>
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item">
                        <b>Room ID:</b>
                        {{ $room->room_id }}
                    </li>
                    <li class="list-group-item">
                        <b>Room Name:</b>
                        {{ $room->room_name }}
                    </li>
                    <li class="list-group-item">
                        <b>Place of Pool:</b>
                        {{ $room->place_room_cottage }}
                    </li>
                    <li class="list-group-item">
                        <b>Price:</b>
                        {{ $room->room_cottage_price }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
