@extends('layouts.tenant_admin_layout')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('Admin_layout_content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-10 space-y-10">
    <!-- Change Password Section -->
    <div>
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

    <hr class="border-t">

    <!-- Interface Customization -->
    <div>
        <h2 class="text-3xl font-bold text-green-700 mb-6 border-b pb-2">🎨 Interface Customization</h2>

        <div class="space-y-4">
            <h1 class="text-lg font-bold text-gray-800">Sidebar</h3>
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
            </div>
        </div>
    </div>
</div>

<script>
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
</script>

@if(auth()->check())
<script>
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
</script>
@endif
@endsection
