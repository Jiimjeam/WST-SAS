@extends('layouts.tenant_admin_layout')

@section('title', 'Users')
@section('page-title', 'Users')

@section('Admin_layout_content')

<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="fw-bold">{{ $tenant->name }}'s Clinic</h1>
        <p class="text-muted"><i class="fas fa-envelope me-1 text-success"></i>{{ $tenant->email }}</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Clinic Storage</h5>
            <button class="btn btn-light btn-sm fw-medium" data-bs-toggle="modal" data-bs-target="#addMedicineModal">
                <i class="fas fa-plus me-1"></i> Add User
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tenantTable" class="table table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $users)
                            <tr>
                                <td>{{ $users->id }}</td>
                                <td class="fw-medium">{{ $users->name }}</td>
                                <td><span class="badge bg-light text-dark px-3 py-2">{{ $users->email }}</span></td>
                                <td>{{ $users->position }}</td>
                                <td>{{ $users->created_at }}</td>
                                <td>{{ $users->updated_at }}</td>
                                <td class="text-center">

                                    <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editMedicineModal-{{ $users->id }}">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ route('addUser.destroy', $users->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-button">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit user Modal -->
                            <div class="modal fade" id="editMedicineModal-{{ $users->id }}" tabindex="-1" aria-labelledby="editMedicineModalLabel-{{ $users->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('addUser.update', $users->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editMedicineModalLabel-{{ $users->id }}">
                                                    <i class="fas fa-pen me-2"></i>Edit User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name_{{ $users->id }}" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name_{{ $users->id }}" name="name" value="{{ $users->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_{{ $users->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email_{{ $users->id }}" name="email" value="{{ $users->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="position_{{ $users->id }}" class="form-label">Position</label>
                                                    <input type="text" class="form-control" id="position_{{ $users->id }}" name="position" value="{{ $users->position }}" placeholder="e.g. admin/user"  required>
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
</div>

<!-- Add user Modal (unchanged) -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('addUser.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addMedicineModalLabel"><i class="fas fa-plus-circle me-2"></i>Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select class="form-select @error('position') is-invalid @enderror" id="position" name="position" required>
                            <option value="">-- Select Position --</option>
                            <option value="admin" {{ old('position') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('position') == 'user' ? 'selected' : '' }}>User</option>
                        </select>

                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

<!-- Delete Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

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

@endsection
