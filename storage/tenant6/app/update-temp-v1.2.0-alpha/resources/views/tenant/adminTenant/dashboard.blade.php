@extends('layouts.tenant_admin_layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('Admin_layout_content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
  <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
    <h2 class="text-lg font-semibold text-gray-600">Users</h2>
    <p class="text-4xl font-bold text-green-600 mt-2">{{ $usersCount }}</p>
  </div>
  <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
    <h2 class="text-lg font-semibold text-gray-600">Medicines</h2>
    <p class="text-4xl font-bold text-green-600 mt-2">{{ $medicinesCount }}</p>
  </div>
</div>

<section>
  <div class="p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-xl font-bold text-green-700 mb-4 flex items-center gap-2">
      <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M19 11H5m14 0a2 2 0 100-4H5a2 2 0 000 4m14 0a2 2 0 110 4H5a2 2 0 110-4" />
      </svg>
      Recent Activities
    </h2>

    <!-- {{-- Clear All Logs Button --}} -->
    <div class="flex justify-end mb-4">
      <form id="clearLogsForm" method="POST" action="{{ route('tenant.admin.logs.clear') }}">
        @csrf
        @method('DELETE')
        <button type="button" id="clearLogsBtn"
          class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-1 px-3 rounded-lg shadow-sm transition-all">
          Clear All Logs
        </button>
      </form>
    </div>
<!-- logs -->
    <ul class="divide-y divide-gray-200">
      @forelse($logs as $log)
        <li class="py-3">
          <div class="flex items-start justify-between">
            <div>
              <p class="text-sm text-gray-800">
                <span class="font-semibold text-green-600">{{ $log->user->name ?? 'System' }}</span>
                <span class="ml-1">
                  <span class="inline-block px-2 py-0.5 text-xs rounded-full 
                    @if($log->event == 'created') bg-green-100 text-green-700 
                    @elseif($log->event == 'updated') bg-yellow-100 text-yellow-700 
                    @elseif($log->event == 'deleted') bg-red-100 text-red-700 
                    @else bg-gray-100 text-gray-600 @endif">
                    {{ ucfirst($log->event) }}
                  </span>
                </span>
                <span class="italic text-gray-500 ml-2">on {{ class_basename($log->auditable_type) }}</span>
              </p>
              <p class="text-xs text-gray-400 mt-1">{{ $log->created_at->diffForHumans() }}</p>

              @php
                  $old = $log->old_values ?? [];
                  $new = $log->new_values ?? [];
              @endphp

              {{-- Show modified fields for update --}}
              @if($log->event === 'updated')
                <div class="mt-2 text-sm text-gray-700 space-y-1">
                  @foreach($new as $key => $value)
                    @if(isset($old[$key]) && $old[$key] != $value)
                      <div>
                        <strong>{{ ucfirst($key) }}:</strong>
                        <span class="text-red-600 line-through">{{ $old[$key] }}</span>
                        <span class="mx-1">→</span>
                        <span class="text-green-600">{{ $value }}</span>
                      </div>
                    @endif
                  @endforeach
                </div>
              @elseif($log->event === 'created')
                <div class="mt-2 text-sm text-green-700 space-y-1">
                  @foreach($new as $key => $value)
                    <div><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</div>
                  @endforeach
                </div>
              @elseif($log->event === 'deleted')
                <div class="mt-2 text-sm text-red-700 space-y-1">
                  @foreach($old as $key => $value)
                    <div><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </li>
      @empty
        <li class="py-3 text-gray-500 italic">No recent activity yet.</li>
      @endforelse
    </ul>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('clearLogsBtn').addEventListener('click', function (e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete all logs!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, clear logs!',
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('clearLogsForm').submit();
      }
    });
  });
</script>
@endsection
