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
                            title: `Updating to ${selected}...`,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        fetch("{{ route('app.perform_update') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ version: selected })
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.message) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update Downloaded',
                                    text: result.message
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.error || 'Something went wrong.'
                                });
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Request Failed',
                                text: 'Unable to complete the update request.'
                            });
                        });
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
