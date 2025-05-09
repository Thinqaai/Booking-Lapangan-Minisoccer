@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="font-weight-bold text-primary">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2 shadow-sm hover-shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                USER</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success h-100 py-2 shadow-sm hover-shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                BOOKING</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bookings }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-success-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning h-100 py-2 shadow-sm hover-shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                PENDING</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendings }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-warning-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info h-100 py-2 shadow-sm hover-shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                SUCCESS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $success }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-info-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list mr-2"></i>Recent Bookings
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>User</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>Lapangan {{ $booking->arena->number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->time_from)->format('d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #1a73e8;
    --secondary-color: #1557b0;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.text-primary {
    color: var(--primary-color) !important;
}

.text-success {
    color: var(--success-color) !important;
}

.bg-primary {
    background-color: var(--primary-color) !important;
}

.border-left-primary {
    border-left: 4px solid var(--primary-color);
}

.border-left-success {
    border-left: 4px solid var(--success-color);
}

.border-left-warning {
    border-left: 4px solid var(--warning-color);
}

.border-left-info {
    border-left: 4px solid var(--info-color);
}

.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-top-left-radius: 10px !important;
    border-top-right-radius: 10px !important;
}

.table {
    margin-bottom: 0;
}

.badge {
    padding: 0.5em 1em;
    border-radius: 30px;
    font-weight: 500;
}

.text-primary-light {
    color: rgba(26, 115, 232, 0.7);
}

.text-success-light {
    color: rgba(40, 167, 69, 0.7);
}

.text-warning-light {
    color: rgba(255, 193, 7, 0.7);
}

.text-info-light {
    color: rgba(23, 162, 184, 0.7);
}
</style>
@endsection