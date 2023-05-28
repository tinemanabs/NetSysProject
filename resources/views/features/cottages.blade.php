@extends('layouts.auth')

@section('content')
    <h4>Cottages Management</h4>
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCottageModal">
            Add Cottage
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cottage</th>
                            <th>Place</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cottages as $cottage)
                            @if ($cottage->cottage_name != null)
                                <tr>
                                    <td>{{ $cottage->cottage_name }}</td>
                                    <td>{{ $cottage->place_room_cottage }}</td>
                                    <td>P{{ $cottage->room_cottage_price }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addCottageModal" tabindex="-1" aria-labelledby="addCottageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCottageModalLabel">Add Cottage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Cottage Name</label>
                                    <input type="text" class="form-control" id="cottageName">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Cottage Price</label>
                                    <input type="text" class="form-control" id="cottagePrice">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Cottage Image</label>
                                    <input type="file" class="form-control" name="cottage_image" id="cottageImage">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addCottageBtn">Add Cottage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        // NOTE: ADD VALIDATION FOR UNIQUE COTTAGE NAME

        $('#addCottageBtn').on('click', () => {
            $cottage_name = $('#cottageName').val();
            $cottage_price = $('#cottagePrice').val();
            $cottage_image = $('#cottageImage').val().split('\\').pop();
            $fileExtension = ['jpeg', 'jpg', 'png', 'gif'];

            //console.log($cottage_id, $cottage_name, $cottage_price)

            if ($cottage_name == '' || $cottage_price == '' || $cottage_image == '') {
                swal({
                    icon: 'warning',
                    title: 'Empty Fields!',
                    text: 'Please fill up the required fields!'
                });
            } else if ($.inArray($cottage_image.split('.').pop().toLowerCase(), $fileExtension) == -1) {
                swal({
                    icon: 'warning',
                    title: 'Invalid File Format!',
                    text: `The image is invalid, or not supported. Allowed types: ${$fileExtension}`
                });
            } else {
                swal({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Cottage has been added!',
                    buttons: false
                }).then((response) => {
                    const formdata = new FormData();
                    formdata.append('cottage_name', $cottage_name);
                    formdata.append('cottage_price', $cottage_price);
                    formdata.append('cottage_image', document.getElementById('cottageImage').files[0]);

                    console.log([...formdata]);

                    let settings = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }

                    axios.post('/addcottage', formdata, settings)
                        .then(response => {
                            location.reload();
                        })
                })

            }
        })
    </script>
@endsection
