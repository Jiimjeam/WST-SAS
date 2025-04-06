<!DOCTYPE html>
<html>
<head>
    <title>Multi-Tenancy SaaS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="mb-4">Welcome to the SaaS Platform</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register as Tenant
        </button>
        <a href="/admin/login" class="btn btn-outline-secondary">Login as Admin</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('tenant.register') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Register New Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tenant Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g., John's Store" required/>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Tenant Email</label>
                        <input type="email" class="form-control" name="email" placeholder="e.g., john@example.com" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Register Tenant</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
