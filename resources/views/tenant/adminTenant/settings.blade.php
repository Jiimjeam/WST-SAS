@extends('layouts.tenant_admin_layout')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('Admin_layout_content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-8">
    <h2 class="text-2xl font-semibold text-green-700 mb-6">Change Password</h2>

    @if (session('success'))
        <div class="mb-4 text-green-700 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tenant.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
            <input type="password" name="current_password" id="current_password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('current_password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" name="new_password" id="new_password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('new_password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-green-700 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection
