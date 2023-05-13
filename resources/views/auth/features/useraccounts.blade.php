@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('showAddAdmin') }}" class="btn btn-primary">Add Admin</a>
                </div>
            </div>
        </div>
    </div>
@endsection
