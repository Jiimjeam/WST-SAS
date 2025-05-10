@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin All Tenants')

@section('Admindashboard')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
          <h5 class="mb-0">Notifications</h5>
        </div>
        <div class="card-body">

          <!-- Notification item -->
          <div class="d-flex align-items-start border-bottom py-3 notification-card">
            <div class="notification-icon me-3 bg-primary text-white">
              <i class="fas fa-bell"></i>
            </div>
            <div>
              <h6 class="mb-1">New Tenant Application</h6>
              <p class="mb-0 text-muted small">You have a new tenant request pending approval.</p>
              <small class="text-muted">5 minutes ago</small>
            </div>
          </div>

          <!-- Notification item -->
          <h2>Tenant Upgrade Requests</h2>

            <ul>
                @forelse ($notifications as $note)
                    <li>
                        <strong>{{ $note->tenant_name }}</strong> {{ $note->message }} <br>
                        <small>{{ $note->created_at->diffForHumans() }}</small>
                    </li>
                @empty
                    <li>No upgrade requests yet.</li>
                @endforelse
            </ul>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Extra styling -->
<style>
  .notification-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
  }
  .notification-card:hover {
    background-color: #f9f9f9;
  }
</style>
@endsection
