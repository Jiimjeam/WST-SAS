@extends('layouts.admin_layout_dashboard')

@section('title', 'Admin All Tenants')

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
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Barangay Name</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Clinic Name</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Domain</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Contact#</th>
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
                          <h6 class="badge badge-sm bg-gradient-warning">{{ $tenant->data['barangayName'] ?? 'N/A' }}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span  class="text-secondary text-xs font-weight-bold">clinic name</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">domain</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">email</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">contact#</span>
                    </td>
                    <td class="text-center">

                      <a href="">
                        <button class="btn btn-md btn-info view-btn">
                          <i class="fas fa-eye"></i>
                        </button>
                      </a> &nbsp;
                      
                      <a href="">
                      <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                          <i class="fas fa-edit"></i>  
                        </button>
                      </a> &nbsp;

                      <a href="#" onclick="deleteStudent()">
                        <button class="btn btn-md btn-danger">
                          <i class="fas fa-archive"></i>
                        </button>
                      </a>
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
@endsection