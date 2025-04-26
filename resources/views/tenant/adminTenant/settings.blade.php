@extends('layouts.tenant_admin_layout')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('Admin_layout_content')
<div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-xl p-10">
    <div class="flex flex-col md:flex-row gap-10">

        <!-- Change Password Section -->
        <div class="w-full md:w-1/2 space-y-6">
            <h2 class="text-3xl font-bold text-green-700 mb-6 border-b pb-2">🔒 Change Password</h2>

            @if (session('success'))
                <div class="mb-4 text-green-700 font-medium bg-green-100 p-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('tenant.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('current_password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('new_password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-green-700 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-200">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Interface Customization Section -->
        <div class="w-full md:w-1/2 space-y-6">
            <h2 class="text-3xl font-bold text-green-700 mb-6 border-b pb-2">🎨 Interface Customization</h2>

            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-800">Sidebar</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="sidebarColor" class="block text-sm font-semibold mb-2">Sidebar Background Color</label>
                        <input type="color" id="sidebarColor" value="{{ auth()->user()->sidebar_color ?? '#047857' }}"
                            class="w-16 h-10 border rounded-md cursor-pointer">
                    </div>

                    <div>
                        <label for="sidebartextColor" class="block text-sm font-semibold mb-2">Sidebar Text Color</label>
                        <input type="color" id="sidebartextColor" value="{{ auth()->user()->text_color ?? '#ffffff' }}"
                            class="w-16 h-10 border rounded-md cursor-pointer">
                    </div>

                    <div>
                        <label for="logoutBtnColor" class="block text-sm font-semibold mb-2">Logout Button Color</label>
                        <input type="color" id="logoutBtnColor" value="{{ auth()->user()->logout_btn_color ?? '#ef4444' }}"
                            class="w-16 h-10 border rounded-md cursor-pointer">
                    </div>

                    <form action="{{ route('tenant.settings.updateFont') }}" method="POST">
                        @csrf
                        <label for="font_family" class="block mb-2">Choose Font:</label>
                        <select name="font_family" id="font_family" class="border rounded p-2">
                            <option value="sans-serif">Sans Serif (Default)</option>
                            <option value="Arial, sans-serif">Arial</option>
                            <option value="'Courier New', monospace">Courier New</option>
                            <option value="'Georgia', serif">Georgia</option>
                            <option value="'Times New Roman', serif">Times New Roman</option>
                            <option value="'Trebuchet MS', sans-serif">Trebuchet MS</option>
                            <option value="'Comic Sans MS', cursive, sans-serif">Comic Sans MS</option>
                            <option value="'Poppins', sans-serif">Poppins</option>
                            <option value="'Roboto', sans-serif">Roboto</option>
                        </select>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded mt-4">
                            Save Font
                        </button>
                    </form>


                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Dark Mode</span>
                        <label for="darkModeToggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="darkModeToggle" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-green-500 dark:bg-gray-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                        </label>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="pt-8">
                <form action="{{ route('tenant.settings.resetDefaut') }}" method="POST" id="reset-defaults-form">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-undo-alt"></i> Reset to Default Settings
                    </button>
                </form>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Scripts --}}
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

    document.getElementById('sidebarColor').addEventListener('input', function () {
        const newColor = this.value;
        document.getElementById('sidebar').style.backgroundColor = newColor;

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
                    title: 'Sidebar background updated!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });

    const textColorInputs = document.querySelectorAll('#sidebartextColor');
    textColorInputs.forEach(input => {
        input.addEventListener('input', function () {
            const newColor = this.value;
            const sidebarTextElements = ['sidebarText', 'sidebarText2'];
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

    const toggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;
    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
        toggle.checked = true;
    }

    toggle.addEventListener('change', function () {
        if (this.checked) {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    });

    
</script>
@endsection
