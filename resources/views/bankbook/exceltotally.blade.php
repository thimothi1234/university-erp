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
											<h4>Tally Import

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
                <th class="wd-10p"> Date </th>
           
                <th class="wd-10p">Mode</th>
                <th class="wd-15p">Vch. type</th>
                  <th class="wd-15p">Ref .No</th>
                  <th class="wd-10p">Voucher No </th>
                  <th class="wd-10p">Ledgers </th>


                  <th class="wd-10p">Amount </th>
                  <th class="wd-15p">Narration</th>
                  <th class="wd-15p">vendor</th>
                  <th class="wd-15p">Cheque</th>
                  
                  <th class="wd-15p">amount</th>
                  <th class="wd-15p">Cheque</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-15p">Nill</th>
                  <th class="wd-15p">Nill</th>
                  <th class="wd-15p">Date</th>


   
                
           

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
      <td>{{$payorder->transactiondate}}</td>
      <td>Payment</td>
      <td></td>
      <td></td>
			<td>


      @if($payorder->voucherno_bvrno == 0)
       
       @else 
       {{$payorder->voucherno_bvrno}}/{{ date('m', strtotime($payorder->transactiondate)) }}/{{$payorder->fy}} @endif


      </td>
      <td>{{$payorder->bankd}}</td>
      <td>
      @if ($payorder->cr_dr == 'Cr')  
      {{$payorder->ham}}
      @else ($payorder->cr_dr == 'Dr')
      -{{$payorder->ham}}
      @endif
      </td>
      <td>{{$payorder->narration}}

      @if($payorder->voucherno_bvrno == 0)
       
       @else Pvr No : 
       {{$payorder->voucherno_bvrno}}/{{ date('m', strtotime($payorder->transactiondate)) }}/{{$payorder->fy}} Cheque No : {{$payorder->chequeno}} In favour of : {{$payorder->vendor}}
      @endif

      </td>

      <td>{{$payorder->bankd}}</td>
      <td>Cheque</td>
      <td>{{$payorder->sum}}</td>
      <td>{{$payorder->chequeno}}</td>
      <td>{{$payorder->transactiondate}}</td>
      <td></td>
      <td></td>
      <td>{{$payorder->transactiondate}}</td>
      

 
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