<!DOCTYPE html>
<html>
<head>
    <title>Multi-Tenancy SaaS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="mb-4">Welcome to the Barangay Clinic Storage Platform</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
            Sign up now!
        </button>
        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#adminLoginModal">
            Login as Admin
        </button>
    </div>

    <!-- SignUp Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="tenantForm" action="{{ route('tenant.register') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register New Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tenant Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="domain" class="form-label">Tenant Domain</label>
                        <input type="text" class="form-control" name="domain" value="{{ old('domain') }}" required/>
                        @error('domain')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Tenant Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e.g., john@example.com" required/>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Tenant Contact Number</label>
                        <input type="text" class="form-control" name="contactNumber" value="{{ old('contactNumber') }}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="barangayName" class="form-label">Tenant Barangay Name</label>
                        <input type="text" class="form-control" name="barangayName" value="{{ old('barangayName') }}" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register Tenant</button>
                </div>
            </form>
        </div>
    </div>

    

    <!-- Admin Login Modal -->
<div class="modal fade" id="adminLoginModal" tabindex="-1" aria-labelledby="adminLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="adminLoginModalLabel">Admin Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session('admin_error'))
                    <div class="alert alert-danger">{{ session('admin_error') }}</div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@clinic.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="secret123">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

    @if (session('showAdminLogin'))
    <script>
        var adminLoginModal = new bootstrap.Modal(document.getElementById('adminLoginModal'));
        adminLoginModal.show();
    </script>
    @endif




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (required for Bootstrap 5 if you're using Bootstrap JS features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    @if ($errors->any())
        var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        registerModal.show();
    @endif
</script>



<script>
    @if ($errors->any())
        var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        registerModal.show();
    @endif

    @if (session('admin_error'))
        var adminModal = new bootstrap.Modal(document.getElementById('adminLoginModal'));
        adminModal.show();
    @endif
</script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
