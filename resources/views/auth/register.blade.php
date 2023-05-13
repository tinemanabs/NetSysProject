@extends('layouts.auth')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card auth-card shadow-md border-0">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid" width="100">
                        </div>

                        <div class="auth-header">
                            <h4>Register</h4>
                            <p>Create your account</p>
                        </div>

                        <hr class="auth-header-divider">

                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="{{ old('first_name') }}"
                                        name="first_name">
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="{{ old('last_name') }}"
                                        name="last_name">
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Birthdate</label>
                                    <input type="date" name="birthday" class="form-control"
                                        value="{{ old('birthday') }}">
                                    @error('birthday')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Contact Number</label>
                                    <input type="text" name="contact_no" class="form-control"
                                        value="{{ old('contact_no') }}">
                                    @error('contact_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" name="confpwd" class="form-control">
                                    @error('confpwd')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="form-check">
                                        <input type="hidden" class="form-check-input" name="is_notify" value="0">
                                        <input type="checkbox" class="form-check-input" name="is_notify" value="1">
                                        <label for="" class="form-check-label">Get SMS Notifications from us for
                                            updates
                                            and promos.</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
