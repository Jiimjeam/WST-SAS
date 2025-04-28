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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto&display=swap" rel="stylesheet">



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

<style>
    #uploadForm:hover img {
        opacity: 0.7;
        transition: 0.3s;
    }
</style>



</head>
<body class="bg-gray-100 font-sans" style="font-family: {{ auth()->user()->font_family ?? 'sans-serif' }} ">

  
<div class="flex h-screen {{ auth()->user()->sidebar_is === 'right' ? 'flex-row-reverse' : '' }}">

    <!-- Sidebar -->
<aside 
  id="sidebar" 
  class="w-64 flex flex-col" 
  style="background-color: {{ auth()->user()->sidebar_color ?? '#047857' }}; color: {{ auth()->user()->text_color ?? '#ffffff' }}">

  <div id="sidebarText" style="" class="px-6 py-6 text-center">

    <!-- Profile Picture UI -->
    <form id="uploadForm" action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data" class="relative w-24 h-24 mx-auto">
    @csrf

    <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
        class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer z-10"
        onchange="document.getElementById('uploadForm').submit();">

    <img src="{{ auth()->user()->profile_picture ? asset('profile_pictures/' . auth()->user()->profile_picture) : asset('img/arvin.jpg') }}"
        alt="Logo">

    @error('profile_picture')
        <div class="text-red-500 text-sm mt-1 text-center">{{ $message }}</div>
    @enderror
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
    <button style="background-color: {{ auth()->user()->Logoutbutton_color ?? '#059669' }}" type="button" class="w-full   py-2 px-4 rounded" id="logout-button">
      <i class="fas fa-sign-out-alt me-1"></i> Logout
    </button>
  </form>
</aside>


    <main class="flex-1 p-8  overflow-y-auto" >
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



<!-- Logout button bg color customization -->
<script>
    const logoutColorInput = document.getElementById('logoutBtnColor');
    logoutColorInput.addEventListener('input', function () {
    const newColor = this.value;
    const logoutBtn = document.getElementById('logout-button');
    if (logoutBtn) logoutBtn.style.backgroundColor = newColor;

    fetch("{{ route('tenant.settings.logoutbtn-color') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ color: newColor })
    }).then(response => response.json())
      .then(data => {
        if (data.success) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Logout button color updated!',
                showConfirmButton: false,
                timer: 1500
            });
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
