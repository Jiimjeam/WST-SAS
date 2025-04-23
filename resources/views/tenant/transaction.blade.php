@extends('layouts.tenant_layout')

@section('title', 'Transaction Form')
@section('page-title', 'Transaction Form')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-8">
        <h2 class="text-2xl font-semibold text-green-700 mb-6">Transaction Form</h2>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="patientName" class="block text-sm font-medium text-gray-700 mb-1">Patient's Name</label>
                <input type="text" name="patientName" id="patientName" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                <input type="number" name="age" id="age" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" id="gender" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="medicine" class="block text-sm font-medium text-gray-700 mb-1">Medicine Given</label>
                <input type="text" name="medicine" id="medicine" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity" id="quantity" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-700 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
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
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            border-radius: 5px;
            border-color: #ddd;
        }

        .btn-success {
            background-color: #28a745;
            color: #ffffff;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
@endsection
