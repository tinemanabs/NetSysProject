@extends('layouts.auth')

@section('content')
    @if (Auth::user()->user_role == 1)
        @include('features.booknow.admin')
    @elseif (Auth::user()->user_role == 2)
        @include('features.booknow.guest')
    @endif

    {{-- NOTE:
        - POPULATE THE DATES THAT ARE ALREADY RESERVED 
        - DATE SHOULD BE DRAGGABLE INTO TO 2 DATES
        - DISABLE THE DAY / NIGHT IF NOT AVAILABLE
        - FILL OUT THE GUEST INFO FORMS
        - DESIGN THE UI FOR SUMMARY
        --}}
@endsection
