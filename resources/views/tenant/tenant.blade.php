<!DOCTYPE html>
<html>
<head>
    <title>{{ $tenant->name }}'s App</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body {
            padding: 2rem;
            background-color: #f8f9fa;
        }
        h1 {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Welcome to {{ $tenant->name }}'s App!</h1>
        <p class="text-center">Email: {{ $tenant->email }}</p>

        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">{{ $tenant->name }}'s Clinic Storage</h5>
            </div>
            <div class="card-body">
                <table id="tenantTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Material</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Example data: Replace with real tenant data --}}
                        <tr>
                            <td>1</td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>{{ $tenant->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery, Bootstrap JS, and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tenantTable').DataTable();
        });
    </script>

</body>
</html>
