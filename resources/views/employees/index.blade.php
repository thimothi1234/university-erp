@extends('project.admin_master')

@section('project')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyledgers</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Vandor/Faculty/Staff</h4>

                      <div class="pull-right">
                @can('Tally-create')
                <a class="btn btn-success" href="{{ route('vendor.create') }}"> Create New Vendor</a>
                @endcan
            </div>


										</div>
          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
          <div class="table-wrapper">
            <table  class="table display responsive nowrap user_datatable">
              
              <thead>
                <tr>
            
                  <th class="wd-10p">Branch	</th>
                  <th class="wd-15p">Name of the Employee</th>
                  <th class="wd-10p">Bank Name	</th>
                  <th class="wd-10p">Action	</th>
              
                  
                </tr>
              </thead>
              <tbody>
              

                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
        <script type="text/javascript">
  $(function () {
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('vendor.index') }}",
        columns: [
            {data: 'Branch', name: 'Branch'},
            {data: 'name', name: 'name'},
            {data: 'Bank_Name', name: 'Bank_Name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  });
</script>
@endsection