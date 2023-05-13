@extends('layouts.auth')

@section('content')
    <div class="card w-50">
        <div class="card-body">
            <form action="" method="post">
                @csrf
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

                    <div class="d-flex justify-content-start">
                        <button class="btn btn-primary me-2" type="button" id="addAdminBtn">Add</button>
                        <a class="btn btn-outline-secondary" href="{{ route('useraccounts') }}">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
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

                            axios.post('/saveadmin', formdata)
                                .then(response => {
                                    location.reload();
                                })
                        })
                    }
                })
            }
        })
    </script>
@endsection
