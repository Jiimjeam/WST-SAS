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


<a href="javascript:void(0);" 
   onclick="checkForUpdate()" 
   class="flex items-center gap-2 px-4 py-2 rounded hover:bg-blue-600">
    <i class="fa-solid fa-magnifying-glass"></i>
    Check for Updates
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



    function checkForUpdate() {
    Swal.fire({
        title: 'Checking for updates...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch("{{ route('app.check_update') }}")
        .then(response => response.json())
        .then(data => {
            if (data.has_update && data.available_updates.length > 0) {
                const options = data.available_updates.map(release => 
                    `<option value="${release.version}">${release.version} - ${release.name}</option>`
                ).join('');

                Swal.fire({
                    title: 'Select version to update',
                    html: `
                        <p>You are currently on version <strong>${data.current_version}</strong>.</p>
                        <select id="release-select" class="swal2-select" style="width:80%;">
                            ${options}
                        </select>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    preConfirm: () => {
                        const selectedVersion = document.getElementById('release-select').value;
                        if (!selectedVersion) {
                            Swal.showValidationMessage('Please select a version');
                        }
                        return selectedVersion;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const selected = result.value;
                        Swal.fire({
                            icon: 'info',
                            title: `Preparing update to ${selected}`,
                            text: `You chose to update from ${data.current_version} to ${selected}.`,
                        });
                        // Here you can call your update API
                    }
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Up to Date',
                    text: 'You are using the latest version.',
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Could not check for updates.',
            });
        });
}

</script>

@endsection
