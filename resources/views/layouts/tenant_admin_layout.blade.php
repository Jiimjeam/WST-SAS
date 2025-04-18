<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Tenant Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- CSS Links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col">
      <div class="px-6 py-6 text-2xl font-bold border-b border-green-600 text-center">
        {{ tenant()->name }}
        
        @if (Auth::check())
            <div class="text-base font-medium text-green-100 mt-1">
                {{ Auth::user()->name }}
            </div>
            <div class="text-xs font-normal text-green-300">
                {{ Auth::user()->position ?? 'N/A' }}
            </div>
        @endif
    </div>
      <nav class="flex-1 px-4 py-6 space-y-4">
        <a href="{{ route('tenant.admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-600">Dashboard</a>
        <a href="{{ route('tenants.admin.users') }}" class="block px-4 py-2 rounded hover:bg-green-600">Users</a>
        <a href="{{ route('tenant.admin.features') }}" class="block px-4 py-2 rounded hover:bg-green-600">Feature Control</a>
        <a href="{{ route('tenant.admin.settings') }}" class="block px-4 py-2 rounded hover:bg-green-600">Settings</a>
      </nav>
      <form action="{{ route('tenant.logout') }}"  method="POST" class="px-4 pb-6" id="logout-form">
        @csrf
        <button type="button" class="w-full bg-green-600 hover:bg-green-500 text-white py-2 px-4 rounded" id="logout-button">
          <i class="fas fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
      <h1 class="text-3xl font-bold text-green-700 mb-8">@yield('page-title', 'Dashboard')</h1>

      @yield('Admin_layout_content')

    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("logout-button").addEventListener("click", function (e) {
        Swal.fire({
            title: 'Logout?',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, log out',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logout-form").submit();
            }
        });
    });
</script>
</body>
</html>
