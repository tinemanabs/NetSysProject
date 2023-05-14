@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('showAddAdmin') }}" class="btn btn-primary">Add Admin</a>
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
                                <th>Contact Address</th>
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

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
