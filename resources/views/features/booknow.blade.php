@extends('layouts.auth')

@section('content')
    @if (Auth::user()->user_role == 1)
        @include('features.booking.admin')
    @elseif (Auth::user()->user_role == 2)
        @include('features.booking.guest')
    @endif
@endsection
