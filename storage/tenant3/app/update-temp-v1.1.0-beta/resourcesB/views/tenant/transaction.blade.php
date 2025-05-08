@extends('layouts.tenant_layout')

@section('title', 'Visitation Form')
@section('page-title', 'Visitation Form')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8 form-container">
    <h2 class="text-2xl font-semibold text-green-700 mb-6 text-center">Visitation Form</h2>

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Patient Name -->
            <div>
                <label for="patientName" class="block text-sm font-medium text-gray-700 mb-2">Patient's Name</label>
                <input type="text" name="patientName" id="patientName" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control">
            </div>

            <!-- Age -->
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                <input type="number" name="age" id="age" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control">
            </div>

           
            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                <select name="gender" id="gender" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Medicine -->
            <div>
                <label for="medicine" class="block text-sm font-medium text-gray-700 mb-2">Medicine Given</label>
                <input type="text" name="medicine" id="medicine" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control">
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control">
            </div>

            <!-- Description (textarea full width) -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 form-control"></textarea>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-green-700 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 btn-success">
                Submit
            </button>
        </div>
    </form>
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

@endsection

@section('styles')
<style>
    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        border: 2px solid #28a745;
    }

    h2 {
        font-size: 2rem;
        color: #28a745;
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
        color: #495057;
    }

    .form-control {
        border-radius: 6px;
        border-color: #ccc;
    }

    .btn-success {
        background-color: #28a745;
        color: #ffffff;
        border-radius: 6px;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>
@endsection
