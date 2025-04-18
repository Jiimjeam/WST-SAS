@extends('layouts.tenant_layout')

@section('title', 'Medicines')
@section('page-title', 'Medicines')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showFeatureDisabledAlert(action = 'This') {
        Swal.fire({
        icon: 'warning',
        title: 'Feature Disabled',
        text: 'feature is disabled by the admin.',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
        });
    }
    </script>

<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="fw-bold">{{ $tenant->name }}'s Clinic</h1>
        <p class="text-muted"><i class="fas fa-envelope me-1 text-success"></i>{{ $tenant->email }}</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Clinic Storage</h5>
            @php
                $add_medicine = \App\Models\FeatureSetting::where('feature_name', 'add_medicine')->first()?->is_enabled;
            @endphp

            <button
                class="btn btn-light btn-sm fw-medium {{ !$add_medicine ? 'opacity-50 cursor-not-allowed' : '' }}"
                @if ($add_medicine)
                    data-bs-toggle="modal" data-bs-target="#addMedicineModal"
                @else
                    onclick="showFeatureDisabledAlert()"
                @endif
        >
                <i class="fas fa-plus me-1"></i> Add Medicine
        </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tenantTable" class="table table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Medicine</th>
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
                                <td class="fw-medium">{{ $medicineeee->medicine_name }}</td>
                                <td><span class="badge bg-light text-dark px-3 py-2">{{ $medicineeee->quantity }}</span></td>
                                <td>{{ $medicineeee->created_at }}</td>
                                <td>{{ $medicineeee->updated_at }}</td>
                                <td class="text-center">

                                @php
                                    $update_medicine = \App\Models\FeatureSetting::where('feature_name', 'update_medicine')->first()?->is_enabled;
                                @endphp

                                <a href="#"
                                    class="btn btn-sm btn-outline-primary me-1 {{ !$update_medicine ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        @if ($update_medicine)
                                            data-bs-toggle="modal" data-bs-target="#editMedicineModal-{{ $medicineeee->id }}"
                                        @else
                                            onclick="showFeatureDisabledAlert('Editing')"
                                        @endif
                                    >
                                        <i class="fas fa-pen"></i>
                                </a>

                                    <form action="{{ route('addMedicine.destroy', $medicineeee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        @php
                                            $delete_medicine = \App\Models\FeatureSetting::where('feature_name', 'delete_medicine')->first()?->is_enabled;
                                        @endphp

                                        <button type="button"
    class="btn btn-sm btn-outline-danger delete-button {{ !$delete_medicine ? 'opacity-50 cursor-not-allowed' : '' }}"
    data-delete-enabled="{{ $delete_medicine ? '1' : '0' }}"
>
    <i class="fas fa-archive"></i>
</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Medicine Modal (unchanged) -->
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
                                                    <input type="text" class="form-control" id="medicine_name_{{ $medicineeee->id }}" name="medicine_name" value="{{ $medicineeee->medicine_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity_{{ $medicineeee->id }}" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity_{{ $medicineeee->id }}" name="quantity" value="{{ $medicineeee->quantity }}" required>
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

<!-- Add Medicine Modal (unchanged) -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('addMedicine.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addMedicineModalLabel"><i class="fas fa-plus-circle me-2"></i>Add Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="medicine_name" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" required>
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

<!-- Delete Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const isEnabled = this.getAttribute('data-delete-enabled') === '1';

            if (!isEnabled) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Feature Disabled',
                    text: 'Deleting feature is disabled by the admin.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

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
