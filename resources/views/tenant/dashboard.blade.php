<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white shadow-lg h-auto md:h-screen">
            <div class="p-6 border-b">
                <h2 class="text-2xl font-bold text-blue-600">Tenant Panel</h2>
            </div>
            <nav class="mt-6 space-y-2 px-4">
                <a href="#" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600">Dashboard</a>
                <a href="#" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600">Appointments</a>
                <a href="#" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600">Inventory</a>
                <a href="#" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600">Reports</a>
                <a href="#" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600">Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}</h1>
                <div class="flex items-center space-x-3">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-xl shadow hover:bg-blue-700">Notifications</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Appointments</h2>
                    <p class="text-3xl font-bold text-blue-600">12</p>
                    <p class="text-gray-500 text-sm mt-1">Today</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Patients</h2>
                    <p class="text-3xl font-bold text-green-500">48</p>
                    <p class="text-gray-500 text-sm mt-1">This Month</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Medicines in Stock</h2>
                    <p class="text-3xl font-bold text-yellow-500">230</p>
                    <p class="text-gray-500 text-sm mt-1">Inventory</p>
                </div>
            </div>

            <!-- Section Example -->
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Recent Activities</h3>
                <ul class="space-y-2">
                    <li class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <span>New appointment scheduled</span>
                        <span class="text-sm text-gray-500">10 mins ago</span>
                    </li>
                    <li class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <span>Inventory updated by staff</span>
                        <span class="text-sm text-gray-500">1 hour ago</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
