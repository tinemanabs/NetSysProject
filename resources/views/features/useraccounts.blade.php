@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>User Accounts Management</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                Add Admin
            </button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>Birthday</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->birthday }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact_no }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">

                                </div>
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confPassword" id="confPassword">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addAdminBtn">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });


        // NOTE: 
        // - PUT VALIDATION IF THE EMAIL EXISTS

        $('#addAdminBtn').on('click', () => {
            $email = $('#email').val();
            $password = $('#password').val();
            $confPassword = $('#confPassword').val();

            if ($email == '' || $password == '' || $confPassword == '') {
                swal({
                    icon: 'warning',
                    title: 'Error!',
                    text: 'Please fill up the fields!'
                });
            } else if ($password != $confPassword) {
                swal({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Confirm password should match the password!'
                })
            } else {
                swal({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Are you sure you want to add this as an admin?',
                    buttons: {
                        cancel: 'Cancel',
                        true: 'OK'
                    }
                }).then((response) => {
                    if (response == 'true') {
                        swal({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Admin added successfully!'
                        }).then((response) => {
                            const formdata = new FormData();
                            formdata.append('email', $email);
                            formdata.append('password', $password)

                            //console.log([...formdata])

                            axios.post('/addadmin', formdata)
                                .then(response => {
                                    location.reload();
                                })
                        })
                    }
                })
            }
        });
    </script>
@endsection
