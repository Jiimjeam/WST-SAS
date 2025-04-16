@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin All Tenants')

@section('Admindashboard')

<!-- Include necessary CSS and JS for DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include additional required libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
   $('#myDataTable').DataTable({
     "paging": true,
     "lengthChange": true,
     "pageLength": 25,
     "searching": true,
     "ordering": true,
     "info": false,
     "autoWidth": false,
     "responsive": true,
     "language": {
       "paginate": {
         "previous": "<i class='bi bi-chevron-left'></i>",
         "next": "<i class='bi bi-chevron-right'></i>"
       }
     }
   });
      $.extend(true, $.fn.dataTable.defaults, {
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: ["copy", "csv", "excel", "pdf", "print"]
      });
    });
  </script>


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Tenant's Table</h6>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">
              <i class="fas fa-plus me-1"></i> Add Tenant
            </button>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="myDataTable" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Barangay</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Clinic Name</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Domain</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($tenantList as $tenant)
                  <tr>
                    <td>   
                        <h6 class="mb-0 text-sm">{{$tenant->id}}</h6>
                    </td>
                    <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="badge badge-sm bg-gradient-warning">{{ $tenant->barangay_name ?? 'N/A' }}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->name ?? 'N/A' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->clinic_name ?? 'N/A' }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <a href="http://{{ $tenant->domain }}:8000" target="_blank" class="text-primary text-xs font-weight-bold">
                        {{ $tenant->domain ?? 'N/A' }}
                      </a>
                    </td>
                  
                    <td class="text-center">
                    <button class="btn btn-sm btn-info view-btn" 
                        data-id="{{ $tenant->id }}" data-bs-toggle="modal" 
                        data-bs-target="#viewTenantModal">
                        <i class="fas fa-eye"></i>
                    </button>

                    <button class="btn btn-sm btn-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTenantModal-{{ $tenant->id }}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <form id="delete-form-{{ $tenant->id }}" action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $tenant->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                   <!-- Edit tenant modal -->
                    <div class="modal fade" id="editTenantModal-{{ $tenant->id }}" tabindex="-1" aria-labelledby="editTenantModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Tenant</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $tenant->name }}" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                <label>Clinic Name</label>
                                <input type="text" name="clinic_name" value="{{ $tenant->clinic_name }}" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $tenant->email }}" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" value="{{ $tenant->contact_number }}" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                <label>Barangay Name</label>
                                <input type="text" name="barangay_name" value="{{ $tenant->barangay_name }}" class="form-control" required>
                              </div>
                              <div class="mb-3">
                                <label>Domain</label>
                                <input type="text" name="domain" value="{{ $tenant->domain }}" class="form-control" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



     <!-- Tenant SignUp Modal -->
     <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="tenantForm" action="{{ route('tenant.register') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register New Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tenant Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="domain" class="form-label">Tenant Domain</label>
                        <input type="text" class="form-control" name="domain" value="{{ old('domain') }}" required/>
                        @error('domain')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Tenant Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e.g., john@example.com" required/>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Tenant Contact Number</label>
                        <input type="text" class="form-control" name="contactNumber" value="{{ old('contactNumber') }}" required/>
                    </div>

                    <div class="mb-3">
                        <label for="barangayName" class="form-label">Tenant Barangay Name</label>
                        <input type="text" class="form-control" name="barangayName" value="{{ old('barangayName') }}" required/>
                    </div>
                    <div class="mb-3">
                        <label for="clinicName" class="form-label">Clinic Name</label>
                        <input type="text" class="form-control" name="clinicName" value="{{ old('clinicName') }}" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register Tenant</button>
                </div>
            </form>
        </div>
    </div>




  <!-- Delete Confirmation popup -->
  <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the tenant!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>



  <!-- Success Delete tenant -->
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif




@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif


  <!-- View Tenant Modal -->
<div class="modal fade" id="viewTenantModal" tabindex="-1" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewTenantModalLabel">
                    <i class="bi bi-person-lines-fill me-2"></i>Tenant Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-light shadow-sm">
                            <div class="card-body">
                                <p class="mb-1"><strong>ID:</strong> <span id="tenantID" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Name:</strong> <span id="tenantName" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Clinic Name:</strong> <span id="tenantClinic_name" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Email:</strong> <span id="tenantEmail" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Contact #:</strong> <span id="tenantContact" class="text-muted"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-light shadow-sm">
                            <div class="card-body">
                                <p class="mb-1"><strong>Barangay Name:</strong> <span id="tenant_barangay_name" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Domain:</strong> <span id="tenantDomain" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Database:</strong> <span id="tenantDatabase" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Created At:</strong> <span id="tenantCreated" class="text-muted"></span></p>
                                <p class="mb-1"><strong>Updated At:</strong> <span id="tenantUpdated" class="text-muted"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).on('click', '.view-btn', function (e) {
        e.preventDefault();
        var tenantId = $(this).data('id'); // Get tenant ID

        // Make AJAX call to fetch tenant data
        $.ajax({
            url: '/tenants/' + tenantId, // Correct URL to fetch tenant
            type: 'GET',
            success: function (response) {
                if (response.tenant) {
                    $('#tenantID').text(response.tenant.id ?? 'N/A');
                    $('#tenantName').text(response.tenant.name ?? 'N/A');
                    $('#tenantClinic_name').text(response.tenant.clinic_name ?? 'N/A');
                    $('#tenantEmail').text(response.tenant.email ?? 'N/A');
                    $('#tenantContact').text(response.tenant.contact_number ?? 'N/A');
                    $('#tenant_barangay_name').text(response.tenant.barangay_name ?? 'N/A');
                    $('#tenantDomain').text(response.tenant.domain ?? 'N/A');
                    $('#tenantDatabase').text(response.tenant.database ?? 'N/A');
                    $('#tenantCreated').text(response.tenant.created_at ?? 'N/A');
                    $('#tenantUpdated').text(response.tenant.updated_at ?? 'N/A');
                    
                    $('#viewTenantModal').modal('show');
                }
            },
            error: function () {
                alert('Something went wrong while fetching tenant data.');
            }
        });
    });
</script>

@endsection