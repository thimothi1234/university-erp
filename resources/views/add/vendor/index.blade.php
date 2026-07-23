@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Vendor/Faculty/Staff</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Vendors</h4>

											<a href="{{route('beneficiary.create')}}" class="btn btn-primary">Insert</a>
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
            <table id="example" class="table display responsive nowrap">
              <thead>
                <tr>
                
                  <th class="wd-15p">ID</th>
                  <th class="wd-20p">name</th>
                  <th class="wd-20p">type</th>
                  <th class="wd-15p">bankname</th>  
                  <th class="wd-20p">branch</th>
                  <th class="wd-15p">acno</th>
                  <th class="wd-20p">PAN</th>
                  <th class="wd-20p">E-Mail</th>
                 
                  <th class="wd-15p">PFMS code</th>
                  <th class="wd-15p">Action</th>
                </tr>
              </thead>
              <tbody>


             



              
			  @foreach($payorders as $payorder)
			<tr>
			<td>{{$payorder->id}}</td>
			<td>{{$payorder->name}}</td>
      <td>{{$payorder->Under}}</td>
			<td>{{$payorder->Bank_Name}}</td>
      <td>{{$payorder->Branch}}</td>
      <td>{{$payorder->Account_Number}}</td>
			<td>{{$payorder->Income_Tax}}</td>
      <td>{{$payorder->Mail_ID}}</td>
      <td>{{$payorder->Contract1}}</td>
      
			<td><a href="{{route('beneficiary.edit',$payorder->id)}}" class="btn btn-outline-primary">Edit</a>
				<!-- <a href="{{url('/add/pfmsschemes/delete/'.$payorder->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a></td> -->
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Blfrtip',
        scrollX: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        scrollY: '400px',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
@endsection