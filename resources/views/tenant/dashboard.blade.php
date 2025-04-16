<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tenant Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col">
      <div class="px-6 py-6 text-2xl font-bold border-b border-green-600">
        {{ tenant()->name }}
      </div>
      <nav class="flex-1 px-4 py-6 space-y-4">
        <a href="#" class="block px-4 py-2 rounded hover:bg-green-600">Dashboard</a>
        <a href="#" class="block px-4 py-2 rounded hover:bg-green-600">Inventory</a>
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
      <h1 class="text-3xl font-bold text-green-700 mb-8">Dashboard</h1>

      <!-- Summary Cards -->
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

      <!-- Recent Activity -->
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
    </main>
  </div>

</body>
</html>
