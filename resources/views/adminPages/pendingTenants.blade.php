@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin Pending Tenants')

@section('Admindashboard')

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Pending Tenants Table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="myDataTable" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">status</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Barangay</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Clinic Name</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($pendingTenantList as $tenant)
                  <tr>
                    <td>   
                        <h6 class="mb-0 text-sm">{{$tenant->id}}</h6>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $tenant->status ?? 'N/A' }}</span>
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
                    <td class="text-center">

                    <form method="POST" action="{{ route('tenants.approve', $tenant->id) }}" class="d-inline approve-form">
                        @csrf
                        <button type="button" class="btn btn-success btn-sm approve-btn">Approve</button>
                    </form>

                    <form method="POST" action="{{ route('tenants.reject', $tenant->id) }}" class="d-inline reject-form">
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm reject-btn">Reject</button>
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
@endsection



<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.approve-btn').forEach(button => {
      button.addEventListener('click', function () {
        Swal.fire({
          title: 'Approve Tenant?',
          text: "Are you sure you want to approve this tenant?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#198754',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, approve!'
        }).then((result) => {
          if (result.isConfirmed) {
            this.closest('form').submit();
          }
        });
      });
    });

    // Reject Button Logic
    document.querySelectorAll('.reject-btn').forEach(button => {
      button.addEventListener('click', function () {
        Swal.fire({
          title: 'Reject Tenant?',
          text: "This action cannot be undone. Proceed?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, reject!'
        }).then((result) => {
          if (result.isConfirmed) {
            this.closest('form').submit();
          }
        });
      });
    });
  });
</script>