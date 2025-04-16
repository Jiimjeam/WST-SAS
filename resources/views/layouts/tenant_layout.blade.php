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
      <div class="px-6 py-6 text-2xl font-bold border-b border-green-600">
        {{ tenant()->name }}
      </div>
      <nav class="flex-1 px-4 py-6 space-y-4">
        <a href="{{ route('tenant.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-600">Dashboard</a>
        <a href="{{ route('tenants.tenants') }}" class="block px-4 py-2 rounded hover:bg-green-600">Inventory</a>
        <a href="#" class="block px-4 py-2 rounded hover:bg-green-600">Settings</a>
      </nav>
      <form method="POST" action="{{ route('logout') }}" class="px-4 pb-6">
        @csrf
        <button class="w-full bg-green-600 hover:bg-green-500 text-white py-2 px-4 rounded">
          Logout
        </button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
      <h1 class="text-3xl font-bold text-green-700 mb-8">@yield('page-title', 'Dashboard')</h1>

      @yield('content')

    </main>
  </div>

</body>
</html>
