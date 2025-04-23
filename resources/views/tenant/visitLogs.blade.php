@extends('layouts.tenant_layout')

@section('title', 'All Transactions')
@section('page-title', 'All Transactions')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow p-8">
    <h2 class="text-2xl font-semibold text-green-700 mb-6">Transaction Records</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-200 rounded-lg">

        <div class="mb-4 flex justify-end">
    @if (tenant()->plan === 'Premium')
        <a href="{{ route('tenant.transactions.pdf') }}" target="_blank"
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

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showPremiumAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Premium Feature',
            text: 'This feature is available for Premium tenants only. Please upgrade your plan to access it.',
            confirmButtonColor: '#10b981',
            confirmButtonText: 'Okay'
        });
    }
</script>




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
                        <a href="" class="text-blue-600 hover:underline">Edit</a>
                        <form action="" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
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

@endsection
