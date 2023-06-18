@extends('layouts.auth')
@section('title', 'Purchase and Rental Inventory')
@section('content')
    <h4>Purchase and Rental Inventory</h4>
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
            Add Inventory
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="row-border" style="width:100%">
                    <thead>

                        <tr>
                            <th>Item Name</th>
                            <th>Item Description</th>
                            <th>Item Price</th>
                            <th>Item Count</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td>P{{ $item->item_price }}</td>
                                <td>{{ $item->item_count }}</td>
                                <td>{{ $item->item_count }}</td>
                                <td><img src="{{ asset('img/purchaseandrentals/' . $item->item_image) }}" height="100"
                                        width="100">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" id="delete{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <script>
                                $("#delete{{ $item->id }}").click(() => {
                                    swal({
                                        icon: "warning",
                                        title: "Delete Item?",
                                        text: "Are you sure you want to delete the item?",
                                        buttons: true,
                                        dangerMode: true
                                    }).then(response => {
                                        const formdata = new FormData()
                                        formdata.append("id", "{{ $item->id }}")
                                        if (response) {
                                            axios.post('/deletepurchaseandrental', formdata)
                                                .then(response => {
                                                    swal({
                                                        icon: "success",
                                                        title: "Item Deleted!",
                                                        text: "The item has been deleted!",
                                                        buttons: false
                                                    }).then(() => {
                                                        location.reload()
                                                    })
                                                })
                                        }
                                    })
                                })
                            </script>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Item Name</label>
                                    <input type="text" class="form-control" id="itemName">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Item Description</label>
                                    <input type="text" class="form-control" id="itemDescription">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Item Price</label>
                                    <input type="text" class="form-control" id="itemPrice">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Item Count</label>
                                    <input type="text" class="form-control" id="itemCount">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Is Rental</label>
                                    <div class="row px-2">
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                value="true" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                value="false" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Item Image</label>
                                    <input type="file" class="form-control" id="itemImage"
                                        accept="image/png, image/gif, image/jpg, image/jpeg">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addItemBtn">Add Item</button>
                    </div>
                </form>


                <script>
                    $("#addItemBtn").click(() => {
                        $itemName = $("#itemName").val()
                        $itemDesc = $("#itemDescription").val()
                        $itemPrice = $("#itemPrice").val()
                        $itemCount = $("#itemCount").val()
                        $itemImage = $("#itemImage").val().split('\\').pop()
                        $fileExtension = ['jpeg', 'jpg', 'png', 'gif']
                        $isRental = $('input[name="flexRadioDefault"]:checked').val();
                        console.log($isRental)

                        if ($itemName == '' || $itemDesc == '' || $itemPrice == "" || $itemCount == '' || $itemImage == '') {
                            swal({
                                icon: "warning",
                                title: "Empty Fields!",
                                text: "Please fill up the required fields!"
                            })
                        } else if ($.inArray($itemImage.split('.').pop().toLowerCase(), $fileExtension) == -1) {
                            swal({
                                icon: "warning",
                                title: "Invalid File Format!",
                                text: `The image is invalid, or not supported. Allowed types: ${fileExtension}`
                            })
                        } else {
                            const formdata = new FormData()
                            formdata.append('item_name', $itemName)
                            formdata.append('item_description', $itemDesc)
                            formdata.append('item_price', $itemPrice)
                            formdata.append('item_count', $itemCount)
                            formdata.append('is_rental', $isRental)
                            formdata.append('item_image', document.getElementById('itemImage').files[0])
                            axios.post("/addpurchaseandrental", formdata, {
                                    headers: {
                                        'content-type': 'multipart/form-data'
                                    }
                                })
                                .then(response => {
                                    if (response.data == 1) {
                                        swal({
                                            icon: "success",
                                            title: "Success!",
                                            text: "Item has been added!",
                                            buttons: false
                                        }).then(() => {
                                            location.reload()
                                        })
                                    } else {
                                        swal({
                                            icon: "error",
                                            title: "Error!",
                                            text: "There was a problem submitting your form!",
                                            buttons: false
                                        })
                                    }
                                })
                        }
                    })
                </script>
            </div>
        </div>
    </div>
@endsection
