{{-- VIEW COTTAGE MODAL --}}
<div class="modal fade" id="viewModal{{ $cottage->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Cottage Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('img/cottages/' . $cottage->cottage_name . '/' . $cottage->room_cottage_image) }}"
                        alt="" width="400">
                </div>
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item">
                        <b>Cottage Name:</b>
                        {{ $cottage->cottage_name }}
                    </li>
                    <li class="list-group-item">
                        <b>Place of Pool:</b>
                        {{ $cottage->place_room_cottage }}
                    </li>
                    <li class="list-group-item">
                        <b>Price:</b>
                        {{ $cottage->room_cottage_price }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
