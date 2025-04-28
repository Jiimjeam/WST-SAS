@extends('layouts.tenant_layout')

@section('title', 'All Transactions')
@section('page-title', 'All Transactions')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow p-8">
    <h2 class="text-2xl font-semibold text-green-700 mb-6">Transaction Records</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-200 rounded-lg">

        <div class="mb-4 flex justify-end">
    @if (tenant()->plan === 'Premium')
        <a href="{{ route('tenant.transaction.pdf') }}" target="_blank"
           class="block px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white font-semibold shadow">
            Generate PDF Report <i class="fa-solid fa-download ml-1 text-white"></i>
        </a>
    @else
        <a href="javascript:void(0);" class="block px-4 py-2 rounded bg-gray-400 hover:bg-gray-500 cursor-not-allowed text-white font-semibold shadow"
           onclick="showPremiumAlert()">
            Generate PDF Report <i class="fa-solid fa-lock ml-1 text-white"></i>
        </a>
    @endif
</div>




            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">Patient Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Age</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Gender</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Medicine Given</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Quantity</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Created on</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Updated on</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse($transactions as $transaction)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $transaction->patient_name }}</td>
                    <td class="px-6 py-4">{{ $transaction->age }}</td>
                    <td class="px-6 py-4 capitalize">{{ $transaction->gender }}</td>
                    <td class="px-6 py-4">{{ $transaction->description }}</td>
                    <td class="px-6 py-4">{{ $transaction->medicine_given }}</td>
                    <td class="px-6 py-4">{{ $transaction->quantity }}</td>
                    <td class="px-6 py-4">{{ $transaction->created_at }}</td>
                    <td class="px-6 py-4">{{ $transaction->updated_at }}</td>



                   
    <td class="px-6 py-4 flex gap-2">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $transaction->id }}">
            Edit
        </button>

        <form action="{{ route('tenant.transactions.destroy', $transaction->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
        </form>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $transaction->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('tenant.transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $transaction->id }}">Edit Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Patient Name -->
                        <div class="mb-3">
                            <label class="form-label">Patient Name</label>
                            <input type="text" name="patient_name" class="form-control" value="{{ $transaction->patient_name }}" required>
                        </div>

                        <!-- Age -->
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="{{ $transaction->age }}" required>
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="male" {{ $transaction->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $transaction->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $transaction->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" required>{{ $transaction->description }}</textarea>
                        </div>

                        <!-- Medicine -->
                        <div class="mb-3">
                            <label class="form-label">Medicine Given</label>
                            <input type="text" name="medicine_given" class="form-control" value="{{ $transaction->medicine_given }}" required>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</td>

                </tr>
            @empty
        <tr>
            <td colspan="7" class="text-center py-4 text-gray-500">No transactions found.</td>
        </tr>
@endforelse

            </tbody>
        </table>
    </div>
</div>



@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif





<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>


@endsection
