@extends('layouts.auth')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <h4>Dashboard</h4>

        <!-- Content Row -->
        <div class="row mt-4">
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border border-primary border-top-0 border-end-0 border-bottom-0 border-4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                    Registered Users</div>
                                <div class="h5 mb-0 fw-bold text-black">{{ $users }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div
                    class="card border border-success border-top-0 border-end-0 border-bottom-0 border-4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                    Total Bookings Today</div>
                                <div class="h5 mb-0 fw-bold text-black">{{ $bookingToday }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div
                    class="card border border-secondary border-top-0 border-end-0 border-bottom-0 border-4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-secondary text-uppercase mb-1">
                                    Total Website Visits</div>
                                <div class="h5 mb-0 fw-bold text-black">{{ $webVisits }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-globe fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border border-info border-top-0 border-end-0 border-bottom-0 border-4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                    Total Sales of Booking</div>
                                <div class="h5 mb-0 fw-bold text-black">P {{ $totalSalesBookingFormat }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-peso-sign fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div
                    class="card border border-warning border-top-0 border-end-0 border-bottom-0 border-4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                    Total Rental Sales</div>
                                <div class="h5 mb-0 fw-bold text-black">P {{ $totalSalesPurchaseFormat }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-peso-sign fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div>
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        let month = {!! json_encode($month) !!};
        let nonExclusive = {!! json_encode($nonExclusive) !!};
        let exclusive = {!! json_encode($exclusive) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: 'Non-exclusive',
                    data: nonExclusive,
                    borderWidth: 2
                }, {
                    label: 'Exclusive',
                    data: exclusive,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Monthly Booking per Reservation Type'
                    }
                }

            }

        });
    </script>

    <script>
        const ctx2 = document.getElementById('myChart2');
        let time = {!! json_encode($time) !!};
        let typeOfTime = {!! json_encode($typeOfTime) !!}
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: time,
                datasets: [{
                    data: typeOfTime,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: '# of Bookings per Time'
                    }
                }

            }

        });
    </script>
@endsection
