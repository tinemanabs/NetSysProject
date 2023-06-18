@extends('layouts.auth')
@section('title', 'Cottages')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h4>Cottages Management</h4>
            <div class="cottages-button">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCottageModal">
                    Add Cottage
                </button>

                <a href="{{ route('checkcottage') }}" class="btn btn-success">Check Cottages</a>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cottage</th>
                                <th>Place of Pool</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cottages as $cottage)
                                @if ($cottage->cottage_name != null)
                                    <tr>
                                        <td>{{ $cottage->cottage_name }}</td>
                                        <td>{{ $cottage->place_room_cottage }}</td>
                                        <td>P {{ $cottage->room_cottage_price }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $cottage->id }}">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <button class="btn btn-danger btn-sm" id="deleteBtn{{ $cottage->id }}"
                                                data-id="{{ $cottage->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- VIEW COTTAGE --}}
                                    @include('features.cottages.viewcottage')

                                    {{-- DELETE COTTAGE --}}
                                    @include('features.cottages.deletecottage')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('features.cottages.addcottage')
    </div>
@endsection
