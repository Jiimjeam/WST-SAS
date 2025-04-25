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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script>
          function showPremiumAlert() {
              Swal.fire({
                  icon: 'info',
                  title: 'Premium Feature',
                  text: 'This feature is available for Premium users only.',
                  confirmButtonColor: '#3085d6'
              });
          }
      </script>


</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
<aside 
  id="sidebar" 
  class="w-64 flex flex-col" 
  style="background-color: {{ auth()->user()->sidebar_color ?? '#047857' }}; color: {{ auth()->user()->text_color ?? '#ffffff' }}">

  <div id="sidebarText" style="color: {{ auth()->user()->text_color ?? '#ffffff' }}" class="px-6 py-6 text-center">

    <!-- Profile Picture UI -->
    <form action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <img src="{{ auth()->user()->profile_picture ? Storage::url(auth()->user()->profile_picture) : asset('img/arvin.jpg') }}"
        alt="Profile Picture"
        class="w-24 h-24 mx-auto rounded-full border-1 border-white shadow-md object-cover">
    </div>
    

    <div class="mb-4 text-center">
        <label for="profile_picture" class="block mb-2 text-sm font-medium text-gray-700">Choose Profile Picture</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" 
               class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
        @error('profile_picture')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Update Profile Picture
        </button>
    </div>
</form>

    <div class="text-2xl font-bold">
        {{ tenant()->name }}
    </div>

    @if (Auth::check())
        <div class="text-base font-medium mt-1">
            {{ Auth::user()->name }}
        </div>
        <div class="text-xs font-normal">
            {{ Auth::user()->position ?? 'N/A' }}
        </div>
    @endif
  </div>

  <nav class="flex-1 px-4 py-6 space-y-4" id="sidebarText2" style="color: {{ auth()->user()->text_color ?? '#ffffff' }}">
    <a href="{{ route('tenant.admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
      <i class="fa-solid fa-gauge"></i>
      Dashboard
    </a>

    <a href="{{ route('tenants.admin.users') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
      <i class="fa-solid fa-users"></i>
      Users
    </a>

    @if (tenant()->plan === 'Premium')
        <a href="{{ route('tenant.admin.features') }}" class="block px-4 py-2 rounded hover:bg-green-600">
        <i class="fa-solid fa-check-circle mr-2"></i> Feature Control
        </a>
    @else
        <a href="javascript:void(0);" class="block px-4 py-2 rounded hover:bg-gray-400 cursor-not-allowed"
          onclick="showPremiumAlert()">
          <i class="fa-solid fa-lock ml-1 "></i> Feature Control 
        </a>
    @endif

    <a href="{{ route('tenant.admin.settings') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
      <i class="fa-solid fa-gear"></i>
      Settings
    </a>
  </nav>
  
  <form action="{{ route('tenant.logout') }}"  method="POST" class="px-4 pb-6" id="logout-form">
    @csrf
    <button type="button" class="w-full bg-green-600 hover:bg-green-500 text-white py-2 px-4 rounded" id="logout-button">
      <i class="fas fa-sign-out-alt me-1"></i> Logout
    </button>
  </form>
</aside>


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

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif
</body>
</html>
