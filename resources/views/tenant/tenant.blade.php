<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $tenant->name }}'s App</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            /* background: linear-gradient(120deg, #e3ffe7, #d9e7ff); */
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem;
        }

        h1 {
            font-weight: 700;
            color: #198754;
        }

        .card {
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(to right, #16a34a, #22c55e);
            color: white;
            padding: 1.2rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        table.dataTable {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #dcfce7;
            color: #065f46;
        }

        .table-hover tbody tr:hover {
            background-color: #f0fdf4;
        }

        .btn {
            border-radius: 50px;
            padding: 6px 12px;
        }

        .btn i {
            transition: transform 0.2s ease-in-out;
        }

        .btn:hover i {
            transform: scale(1.3);
        }

        .badge-material {
            background-color: #bbf7d0;
            color: #065f46;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-1">Welcome to {{ $tenant->name }}'s App</h1>
    <p class="text-center text-muted mb-4"><i class="fas fa-envelope me-1 text-success"></i>{{ $tenant->email }}</p>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Clinic Storage</h5>
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                <i class="fas fa-plus me-1"></i> Add Medicine
            </button>
        </div>
        <div class="card-body">
            <table id="tenantTable" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medecine</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicine as $medicineeee)
                        <tr>
                            <td>{{ $medicineeee->id }}</td>
                            <td>{{ $medicineeee->medicine_name }}</td>
                            <td>{{ $medicineeee->quantity }}</td>
                            <td>{{ $medicineeee->created_at }}</td>
                            <td>{{ $medicineeee->updated_at }}</td>
                            <td class="text-center">
                                <!-- Example actions -->
                                <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editMedicineModal-{{ $medicineeee->id }}">
                                    <i class="fas fa-pen"></i>
                                </a>


                                <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteStudent()" title="Archive">
                                    <i class="fas fa-archive"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Edit Medicine Modal -->
<div class="modal fade" id="editMedicineModal-{{ $medicineeee->id }}" tabindex="-1" aria-labelledby="editMedicineModalLabel-{{ $medicineeee->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('addMedicine.update', $medicineeee->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editMedicineModalLabel-{{ $medicineeee->id }}">
            <i class="fas fa-pen me-2"></i>Edit Medicine
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="medicine_name_{{ $medicineeee->id }}" class="form-label">Medicine Name</label>
            <input type="text" 
                   class="form-control" 
                   id="medicine_name_{{ $medicineeee->id }}" 
                   name="medicine_name" 
                   value="{{ $medicineeee->medicine_name }}" 
                   required>
          </div>

          <div class="mb-3">
            <label for="quantity_{{ $medicineeee->id }}" class="form-label">Quantity</label>
            <input type="number" 
                   class="form-control" 
                   id="quantity_{{ $medicineeee->id }}" 
                   name="quantity" 
                   value="{{ $medicineeee->quantity }}" 
                   required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('addMedicine.store') }}"> 
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addMedicineModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>Add Medicine
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="medicine_name" class="form-label">Medicine Name</label>
                        <input type="text" 
                            class="form-control @error('medicine_name') is-invalid @enderror" 
                            id="medicine_name" 
                            name="medicine_name" 
                            value="{{ old('medicine_name') }}" 
                            required>
                        @error('medicine_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: @json(session('success')),
            confirmButtonColor: '#198754'
        });
    </script>
@endif


@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('addMedicineModal'));
            modal.show();
        });
    </script>
@endif








<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tenantTable').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });
</script>

</body>
</html>
