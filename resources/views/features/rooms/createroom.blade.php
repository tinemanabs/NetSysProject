<!-- Create Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomModalLabel">Add Rooms</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="" class="form-label">Room ID</label>
                                <input type="text" class="form-control" name="room_id" id="roomID">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="" class="form-label">Room Name</label>
                                <input type="text" class="form-control" name="room_name" id="roomName">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="" class="form-label">Place of Pool</label>
                                <select name="place_pool" id="placePool" class="form-select">
                                    <option selected disabled>Select...</option>
                                    <option value="Taas">Taas</option>
                                    <option value="Baba">Baba</option>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="" class="form-label">Room Price</label>
                                <input type="text" class="form-control" name="room_price" id="roomPrice">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="" class="form-label">Room Image</label>
                                <input type="file" class="form-control" name="room_image" id="roomImage">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addRoomBtn">Add Room</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    // NOTE: ADD VALIDATION FOR UNIQUE ROOM ID

    $('#addRoomBtn').on('click', () => {
        $room_id = $('#roomID').val();
        $room_name = $('#roomName').val();
        $place_pool = $('#placePool').val();
        $room_price = $('#roomPrice').val();
        $room_image = $('#roomImage').val().split('\\').pop();
        $fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        //console.log($room_id, $room_name, $room_price)

        if ($room_id == '' || $room_name == '' || $place_pool == null || $room_price == '' || $room_image ==
            '') {
            swal({
                icon: 'warning',
                title: 'Empty Fields!',
                text: 'Please fill up the required fields!'
            });
        } else if ($.inArray($room_image.split('.').pop().toLowerCase(), $fileExtension) == -1) {
            swal({
                icon: 'warning',
                title: 'Invalid File Format!',
                text: `The image is invalid, or not supported. Allowed types: ${$fileExtension}`
            });
        } else {
            swal({
                icon: 'success',
                title: 'Success!',
                text: 'Room has been added!',
            }).then((response) => {
                const formdata = new FormData();
                formdata.append('room_id', $room_id);
                formdata.append('room_name', $room_name);
                formdata.append('place_room_cottage', $place_pool);
                formdata.append('room_price', $room_price);
                formdata.append('room_image', document.getElementById('roomImage').files[0]);

                console.log([...formdata]);

                let settings = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                axios.post('/addroom', formdata, settings)
                    .then(response => {
                        location.reload();
                    })
            })

        }
    })
</script>
