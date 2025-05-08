@extends('layouts.tenant_admin_layout')

@section('title', 'Feature Control')
@section('page-title', 'Feature Control')

@section('Admin_layout_content')

<div class="p-8 max-w-6xl mx-auto bg-white rounded-lg shadow-lg">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Feature Control</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-6 py-3 rounded-md shadow mb-6">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left font-medium text-gray-600">Feature</th>
                    <th class="p-4 text-left font-medium text-gray-600">Status</th>
                    <th class="p-4 text-left font-medium text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($features as $feature)
                    <tr class="border-t">
                        <td class="p-4">{{ ucfirst(str_replace('_', ' ', $feature->feature_name)) }}</td>
                        <td class="p-4">
                            <span class="{{ $feature->is_enabled ? 'text-green-600' : 'text-red-600' }}">
                                {{ $feature->is_enabled ? 'Enabled' : 'Disabled' }}
                            </span>
                        </td>
                        <td class="p-4">
                            <form method="POST" action="{{ route('tenant.admin.feature.toggle', $feature->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-4 py-2 rounded-lg transition-all duration-300 
                                           {{ $feature->is_enabled ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-600' }} 
                                           text-white font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ $feature->is_enabled ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
