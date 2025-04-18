@extends('layouts.tenant_admin_layout')

@section('title', 'Feature Control')
@section('page-title', 'Feature Control')

@section('Admin_layout_content')



<div class="bg-white rounded-xl shadow p-6 mt-8 border-l-4 border-yellow-500">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Feature Control</h2>

  <form method="POST" action="{{ route('tenant.admin.feature-control.update') }}">
    @csrf
    @method('PUT')

    <div class="space-y-4">
      <div class="flex items-center justify-between">
        <span class="text-gray-700">Allow Add Medicine</span>
        <label class="inline-flex relative items-center cursor-pointer">
          <input type="checkbox" name="allow_add" value="1" class="sr-only peer" {{ $settings->allow_add ? 'checked' : '' }}>
          <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition"></div>
          <div
            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-full">
          </div>
        </label>
      </div>

      <div class="flex items-center justify-between">
        <span class="text-gray-700">Allow Update Medicine</span>
        <label class="inline-flex relative items-center cursor-pointer">
          <input type="checkbox" name="allow_update" value="1" class="sr-only peer" {{ $settings->allow_update ? 'checked' : '' }}>
          <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition"></div>
          <div
            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-full">
          </div>
        </label>
      </div>

      <div class="flex items-center justify-between">
        <span class="text-gray-700">Allow Delete Medicine</span>
        <label class="inline-flex relative items-center cursor-pointer">
          <input type="checkbox" name="allow_delete" value="1" class="sr-only peer" {{ $settings->allow_delete ? 'checked' : '' }}>
          <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition"></div>
          <div
            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-full">
          </div>
        </label>
      </div>
    </div>

    <div class="mt-6 text-right">
      <button type="submit"
        class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-all">
        Save Settings
      </button>
    </div>
  </form>
</div>




@endsection