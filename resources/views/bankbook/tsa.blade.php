@extends('project.admin_master2')

@section('project')
<style>
.ui-datatable tbody td.wrap {
    white-space: normal;
    word-wrap: break-word;
}

</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Reports</a>
        <a class="breadcrumb-item" href="index.html">BankBook</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>TSA Approved

                      </h4>



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
            <table id="example" width="100%" class="table display responsive nowrap">
              <thead>
                <tr>
                <th class="wd-10p"> Id </th>
                <th class="wd-10p">Receiving Party Code</th>
                <th class="wd-10p">Receiving Party Name</th>
                <th class="wd-15p">Transaction Code</th>
                  <th class="wd-15p">Transaction Key</th>
                  <th class="wd-10p">Component Code</th>
                  <th class="wd-15p">Expense Type</th>
                  <th class="wd-10p">Amount</th>
                  <th class="wd-10p">Remarks</th>
                  <th class="wd-10p">Action Type</th>
                  <th class="wd-10p">Account Number</th>
                  <th class="wd-10p">Payment Method</th>
                  <th class="wd-10p">NarrationForPassBook</th>

           

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
      <td>{{$payorder->tsacode}}</td>
      <td>{{$payorder->vendor}}</td>
      
      <td>GP</td>
      <td></td>
			<td>
      {{ Str::limit($payorder->pfms,5,'') }} </td>

    
      <td>R</td>
 
      <td>{{$payorder->sum}}</td>
   <td></td>
   <td></td>
   <td>{{$payorder->acno}}</td>
   <td></td>
      <td>
      <?php  
      $igst = DB::table('ledgers')
      ->select('projects.name as ham')
        ->join('projects','projects.id', '=', 'ledgers.costcentre')
        ->where('ledgers.transaction_id', $payorder->id)
        ->first()
        ?>
      {{ $igst->ham }}</td>
			
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