@extends('layouts.auth')
@section('title', 'Login')
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
                            <h4>Login</h4>
                            <p>Login your account</p>
                        </div>

                        <hr class="auth-header-divider">

                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
