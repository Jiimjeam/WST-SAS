@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin All Tenants')

@section('Admindashboard')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
        "responsive": true, // Make it responsive
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
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="myDataTable" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Barangay</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Clinic Name</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Domain</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Contact#</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Database</th>
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
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->clinic_name ?? 'N/A' }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <a href="http://{{ $tenant->domain }}:8000" target="_blank" class="text-primary text-xs font-weight-bold">
                        {{ $tenant->domain ?? 'N/A' }}
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->email ?? 'N/A' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->contact_number ?? 'N/A' }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->database ?? 'N/A' }}</span>
                    </td>
                    <td class="text-center">




                    <button class="btn btn-sm btn-info view-btn" data-id="{{ $tenant->id }}" data-bs-toggle="modal" data-bs-target="#viewTenantModal">
                        <i class="fas fa-eye"></i>
                    </button>

                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" >
                          <i class="fas fa-edit"></i>
                      </button> 

                      <button class="btn btn-sm btn-danger" onclick="deleteStudent()">
                          <i class="fas fa-archive"></i>
                      </button>

                      <form method="POST" action="" id="student-form-">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- View Tenant Modal -->
<div class="modal fade" id="viewTenantModal" tabindex="-1" aria-labelledby="viewTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewTenantModalLabel">Tenant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="tenantID"></span></p>
                <p><strong>Name:</strong> <span id="tenantName"></span></p>
                <p><strong>Clinic Name:</strong> <span id="tenantClinic_name"></span></p>
                <p><strong>Email:</strong> <span id="tenantEmail"></span></p>
                <p><strong>Contact#:</strong> <span id="tenantContact"></span></p>
                <p><strong>Barangay Name:</strong> <span id="tenant_barangay_name"></span></p>
                <p><strong>Domain</strong> <span id="tenantDomain"></span></p>
                <p><strong>Database:</strong> <span id="tenantDatabase"></span></p>
                <p><strong>Created At:</strong> <span id="tenantCreated"></span></p>
                <p><strong>Updated At:</strong> <span id="tenantUpdated"></span></p>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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