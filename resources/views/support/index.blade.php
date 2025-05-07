@extends('layouts.tenant_admin_layout')

@section('title', 'Support')
@section('page-title', 'Support')

@section('Admin_layout_content')
<a href="javascript:void(0);" 
   onclick="triggerUpdate()" 
   class="flex items-center gap-2 px-4 py-2 rounded hover:bg-green-600">
    <i class="fa-solid fa-arrow-rotate-right"></i>
    Update Application
</a>

<script>
    function triggerUpdate() {
        Swal.fire({
            title: 'Update App?',
            text: 'This will download and apply the latest update.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                // Show loading spinner
                Swal.fire({
                    title: 'Updating...',
                    text: 'Please wait while the update is being applied.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                return fetch("{{ route('app.update') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    console.log(response); // Log the response for debugging
                    if (!response.ok) throw new Error("Update failed.");
                    return response.json();
                })
                .catch(error => {
                    console.error('Error during update:', error); // Log any errors
                    throw error;
                });
            }
        }).then(result => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'The application has been updated successfully.',
                });
            }
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: error.message || 'An error occurred during update.',
            });
        });
    }
</script>

@endsection
