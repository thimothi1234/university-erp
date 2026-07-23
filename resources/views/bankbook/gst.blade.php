
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
        <a class="breadcrumb-item" href="index.html">TDS</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>TDS Report - @foreach($bud as $bud)  {{$bud->name}}  @endforeach
                     From : 
                     
                     {{ \Carbon\Carbon::parse($from)->format('d/F/Y')}}
                     To : {{ \Carbon\Carbon::parse($to)->format('d/F/Y')}} 

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
                <th class="wd-15p">s.no</th>
                <th class="wd-15p">Voucher No</th>
                 <th class="wd-15p">Invoice No</th>
                 <th class="wd-15p">Invoice Date</th>
                <th class="wd-15p">Bank</th>
                <th class="wd-15p">Transaction Date</th>
                <th class="wd-15p">Gross</th>
                <th class="wd-10p">Benificiary </th>
                <th class="wd-10p">PFMS </th>
                <th class="wd-10p">  GST N.o.</th>
                <th class="wd-10p"> PAN</th>
                <th class="wd-10p"> TDS Payable</th>
                <th class="wd-10p"> TDS Payable amount</th>
                <th class="wd-10p"> Enetered By</th>
                <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
        @if ($payorder->taxx == 0 )
        @else
			<tr>
      <td>{{$payorder->id}}</td>
      <td>{{$payorder->voucherno_bvrno}}</td>
      <td>{{$payorder->invno}}</td>
      <td>{{$payorder->invdate}}</td>
      <td>{{$payorder->bankkk->name}}</td>
			<td>{{$payorder->transactiondate}}</td>
      <td>{{$payorder->grosis}}</td>
      <td>{{$payorder->vendor}}</td>
      <td>{{$payorder->pfmss->name}}</td>
      <td>@if ($payorder->gst == 'NULL') @else {{$payorder->gst}} @endif </td>
      <td>@if ($payorder->pan == 'NULL') @else {{$payorder->pan}} @endif </td>    
      <td>{{$payorder->heead}}</td>
      <td> {{$payorder->taxx}} </td>
      <td> {{$payorder->entereds->email}} </td>
			<td><a class="btn btn-info" href="{{ route('voucher.show',$payorder->id) }}">Show</a></td>
			</tr>
      @endif
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
        ],
        order: [[2, 'asc'],[9, 'asc']]
    } );
} );
</script>
@endsection