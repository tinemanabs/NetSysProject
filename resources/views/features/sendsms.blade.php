@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Create a Message</h4>

        <form action="{{ route('sendsms') }}" method="post">
            @csrf

            <label for="" class="form-label">Message</label>
            <textarea name="message" id="" cols="30" rows="10" class="form-control"
                placeholder="Type your message here"></textarea>

            @error('message')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="d-flex justify-content-between align-content-center mt-3">
                <a href="{{ route('smsDashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Send</button>

            </div>
        </form>
    </div>
@endsection
