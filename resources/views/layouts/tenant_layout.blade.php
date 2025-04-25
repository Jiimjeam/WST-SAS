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
    <script src="https://unpkg.com/feather-icons"></script>


</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside 
        id="sidebar2" 
        class="w-64 flex flex-col" 
        style="background-color: {{ auth()->user()->sidebar_color ?? '#047857' }}; color: {{ auth()->user()->text_color ?? '#ffffff' }}">
      <div  class="px-6 py-6 text-2xl font-bol text-center">
        {{ tenant()->name }}
        
        @if (Auth::check())
            <div class="text-base font-medium  mt-1">
                {{ Auth::user()->name }}
            </div>
            <div class="text-xs font-normal ">
                {{ Auth::user()->position ?? 'N/A' }}
            </div>
        @endif
      </div>
      <nav id="sidebarText3" style="color: {{ auth()->user()->text_color ?? '#ffffff' }}" class="flex-1 px-4 py-6 space-y-4">
    <a href="{{ route('tenant.dashboard') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('tenants.tenants') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3h18v18H3V3z"></path>
        </svg>
        Inventory
    </a>

    <a href="{{ route('tenant.settings') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 15.5a3.5 3.5 0 0 0 0-7"></path>
            <path d="M19.4 15a2 2 0 0 1-.4 2.6l-1.5 1.5a2 2 0 0 1-2.6.4l-1.4-.7a2 2 0 0 0-2.4 0l-1.4.7a2 2 0 0 1-2.6-.4L5 17.6a2 2 0 0 1-.4-2.6l.7-1.4a2 2 0 0 0 0-2.4l-.7-1.4a2 2 0 0 1 .4-2.6L6.6 5a2 2 0 0 1 2.6-.4l1.4.7a2 2 0 0 0 2.4 0l1.4-.7a2 2 0 0 1 2.6.4l1.5 1.5a2 2 0 0 1 .4 2.6l-.7 1.4a2 2 0 0 0 0 2.4z"></path>
        </svg>
        Settings
    </a>

    <a href="{{ route('tenant.transaction') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 8v4l3 3"></path>
            <circle cx="12" cy="12" r="10"></circle>
        </svg>
        Visitation Form
    </a>

    <a href="{{ route('tenant.visit.logs') }}" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 12H9m12 0A9 9 0 1 1 3 12a9 9 0 0 1 18 0z"></path>
        </svg>
        Visitation Logs
    </a>
</nav>

      <form action="{{ route('tenant.logout') }}"  method="POST" class="px-4 pb-6" id="logout-form">
        @csrf
        <button style="background-color: {{ auth()->user()->Logoutbutton_color ?? '#047857' }}; type="button" class="w-full  py-2 px-4 rounded" id="logout-button">
          <i class="fas fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
      <h1 class="text-3xl font-bold text-green-700 mb-8">@yield('page-title', 'Dashboard')</h1>

      @yield('content')

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



<!-- sidebar color customization -->
<script>
document.getElementById('sidebarColor').addEventListener('input', function () {
    const newColor = this.value;
    // Live preview
    document.getElementById('sidebar2').style.backgroundColor = newColor;

    fetch("{{ route('tenant.settings.sidebar-color') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ color: newColor })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Sidebar color updated!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});
</script>



<!-- sidebar text custom -->
@if(auth()->check())
<script>
    const textColorInputs = document.querySelectorAll('#sidebartextColor');

    textColorInputs.forEach(input => {
        input.addEventListener('input', function () {
            const newColor = this.value;
            const sidebarTextElements = ['sidebar2', 'sidebarText3'];

            sidebarTextElements.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.color = newColor;
            });

            fetch("{{ route('tenant.settings.sidebartext-color') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ color: newColor })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Sidebar text color updated!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    });
</script>
@endif


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


</body>
</html>
