@extends('layouts.auth')
@section('title', 'Edit Profile')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Personal Information</h4>

                <hr class="auth-header-divider">

                <form action="" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-6 mb-3">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                value="{{ $user->first_name }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                value="{{ $user->last_name }}">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="" class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="birthday" id="birthday"
                                value="{{ $user->birthday }}">
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="contact_no" id="contact_no"
                                value="{{ $user->contact_no }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <input type="text" id="user_id" value="{{ $user->id }}" hidden>
                            <button class="btn btn-primary me-md-2" type="button" id="changePersonalInfotBtn">Save
                                Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h4>Change Password</h4>

                <hr class="auth-header-divider">

                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="newPassword" id="newPassword">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confNewPassword" id="confNewPassword">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <input type="text" id="user_id" value="{{ $user->id }}" hidden>
                        <button class="btn btn-primary me-md-2" type="button" id="changePasswordBtn">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        // NOTE: 
        // - PUT VALIDATION TO LIMIT THE DATE TO 18 YEARS OLD
        // - PUT VALIDATION ON CONTACT NUMBER WHEN EXISTING

        $('#changePersonalInfotBtn').on('click', () => {
            $user_id = $('#user_id').val();
            $first_name = $('#first_name').val();
            $last_name = $('#last_name').val();
            $birthday = $('#birthday').val();
            $contact_no = $('#contact_no').val();

            if ($first_name == '' ||
                $last_name == '' ||
                $birthday == '' ||
                $contact_no == ''
            ) {
                swal({
                    title: 'Empty Fields!',
                    text: 'Please fill up the fields!',
                    icon: 'warning',
                })


            } else {
                swal({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Are you sure you want to make these changes?',
                    buttons: {
                        cancel: 'Cancel',
                        true: 'OK'
                    }

                }).then((response) => {
                    if (response == 'true') {
                        swal({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Profile has beeen successfully updated.',
                            buttons: false,
                        }).then((response) => {
                            const formdata = new FormData();
                            formdata.append('user_id', $user_id);
                            formdata.append('first_name', $first_name);
                            formdata.append('last_name', $last_name);
                            formdata.append('birthday', $birthday);
                            formdata.append('contact_no', $contact_no);

                            //console.log([...formdata])

                            axios.post('/editprofile', formdata)
                                .then(response => {
                                    location.reload();
                                });
                        })
                    }
                })
            }
        });


        // NOTE: 
        // - PUT VALIDATION ON THE CURRENT PASSWORD

        $('#changePasswordBtn').on('click', () => {
            $user_id = $('#user_id').val();
            $password = $('#password').val();
            $newPassword = $('#newPassword').val();
            $confPassword = $('#confNewPassword').val();

            //console.log($password, $newPassword, $confPassword)

            if ($password == '' ||
                $newPassword == '' ||
                $confPassword == ''
            ) {
                swal({
                    title: 'Empty Fields!',
                    text: 'Please fill up the fields!',
                    icon: 'error',
                });
            } else if ($newPassword !== $confPassword) {
                swal({
                    title: 'Passwords Mismatch!',
                    text: 'Confirm password should match new password!',
                    icon: 'error',
                });
            } else {
                swal({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Are you sure you want to make these changes?',
                    buttons: {
                        cancel: 'Cancel',
                        true: 'OK',
                    }
                }).then((response) => {

                    if (response == 'true') {
                        swal({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Password has been changed!',
                            buttons: false
                        }).then((response) => {
                            const formdata = new FormData();
                            formdata.append('user_id', $user_id)
                            formdata.append('password', $newPassword)

                            //console.log([...formdata])
                            axios.post('/editpassword', formdata)
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
