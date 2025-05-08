@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin All Tenants')

@section('Admindashboard')
<div class="container py-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row mb-4">
        <!-- Pending Accounts -->
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Pending Tenants</h5>
                    <p class="card-text display-6">{{ $pendingCount }}</p>
                </div>
            </div>
        </div>

        <!-- Rejected Accounts -->
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Rejected Tenants</h5>
                    <p class="card-text display-6">{{ $rejectedCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Tenants -->
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Tenants</h5>
                    <p class="card-text display-6">{{ $totalTenants }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart for Tenant Status -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Tenant Status Distribution</h5>
                    <canvas id="tenantStatusChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Initialization -->
<script>
    const ctx = document.getElementById('tenantStatusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['total', 'Pending', 'Rejected'],
            datasets: [{
                label: 'Tenant Status',
                data: [{{ $totalTenants }}, {{ $pendingCount }}, {{ $rejectedCount }}],
                backgroundColor: [
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    'rgba(25, 135, 84, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
            }
        }
    });
</script>
@endsection
