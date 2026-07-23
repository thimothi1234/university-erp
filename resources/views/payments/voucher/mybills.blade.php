@extends('project.admin_master2')

@section('project')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.uikit.min.css">
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Payments</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Payment</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>My Payments</h4>

                      


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
            <table id="example" class="uk-table uk-table-hover uk-table-striped">
              <thead>
                <tr>
                <th class="wd-15p">S.No</th>
                  <th class="wd-15p">Entered on</th>
            
                  <th class="wd-15p">amount</th>
                  <th class="wd-15p">vendor </th>
                  <th class="wd-15p">Details </th>
                  <th class="wd-15p">Status </th>
    
                  

                </tr>
              </thead>
              <tbody>
              @php
$statusLabels = [
    1 => 'Pending with AR(F&A)',
    2 => 'Pending with DDO',
    3 => 'Pending with DR(F&A)',
    4 => 'Pending with Cashier to issue cheque',
];
@endphp
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
			<td>{{$payorder->created_at}}</td>
			
    
      <td>{{$payorder->sum}}</td>
 
      <td>{{$payorder->ven}}</td>
      <td>{{$payorder->narration}}</td>
      <td>

    

@isset($statusLabels[$payorder->status])
    <span class="badge badge-pill badge-primary">{{ $statusLabels[$payorder->status] }}</span>
@endisset

@if ($payorder->status === 'paid')
    <span class="badge badge-pill badge-success">
        Transaction Success with Cheque {{ $payorder->chequeno }} dated {{ $payorder->transactiondate }}
    </span>
@endif


      </td>

     
      
	
			</tr>
			@endforeach

      @foreach($queries as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
			<td>{{$payorder->created_at}}</td>
			
    
      <td>{{$payorder->sum}}</td>
 
      <td>{{$payorder->ven}}</td>
      <td>{{$payorder->narration}}</td>
      <td>

    

@isset($statusLabels[$payorder->status])
    <span class="badge badge-pill badge-primary">{{ $statusLabels[$payorder->status] }}</span>
@endisset

@if ($payorder->status === 'paid')
    <span class="badge badge-pill badge-success">
        Transaction Success with Cheque {{ $payorder->chequeno }} dated {{ $payorder->transactiondate }}
    </span>
@endif


      </td>

     
      
	
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
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.uikit.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Blfrtip',
        order: [[0, 'desc']],
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