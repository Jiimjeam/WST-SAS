@extends('layouts.tenant_admin_layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('Admin_layout_content')
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
      <h2 class="text-lg font-semibold text-gray-600">Appointments</h2>
      <p class="text-4xl font-bold text-green-600 mt-2">12</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
      <h2 class="text-lg font-semibold text-gray-600">Patients</h2>
      <p class="text-4xl font-bold text-green-600 mt-2">48</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
      <h2 class="text-lg font-semibold text-gray-600">Medicines</h2>
      <p class="text-4xl font-bold text-green-600 mt-2">230</p>
    </div>
  </div>

  <section>
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Recent Activity</h2>
    <ul class="space-y-4">
      <li class="bg-white p-4 rounded shadow flex justify-between items-center">
        <span class="text-gray-700">New appointment added</span>
        <span class="text-sm text-gray-500">5 mins ago</span>
      </li>
      <li class="bg-white p-4 rounded shadow flex justify-between items-center">
        <span class="text-gray-700">Inventory updated</span>
        <span class="text-sm text-gray-500">30 mins ago</span>
      </li>
    </ul>
  </section>
@endsection
