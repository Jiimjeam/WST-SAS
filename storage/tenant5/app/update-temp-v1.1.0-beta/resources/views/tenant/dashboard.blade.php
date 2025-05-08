@extends('layouts.tenant_layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
      <h2 class="text-lg font-semibold text-gray-600">Medicines</h2>
      <div class="flex items-center mt-4">
        <!-- Medicine Icon -->
        <div class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center text-green-700">
          <i class="fas fa-pills text-4xl"></i> <!-- Increased icon size -->
        </div>
        <!-- Large number for Medicines -->
        <p class="text-6xl font-bold text-green-600 ml-4">230</p> <!-- Increased text size -->
      </div>
    </div>
  </div>

  <section>
    <!-- Additional sections could be added here -->
  </section>
@endsection
