
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
              
                <th class="wd-15p">Bank</th>
                  <th class="wd-15p">Transaction Date</th>
                 
                  <th class="wd-15p">Gross</th>
                  <th class="wd-10p">Benificiary </th>
                  <th class="wd-10p">PFMS </th>
                  <th class="wd-10p">  GST N.o.</th>
                  <th class="wd-10p"> PAN</th>
                  <th class="wd-10p"> TDS Payable</th>
                  <th class="wd-10p"> TDS Payable amount</th>
                  <th class="wd-10p"> SGST TDS Payable</th>
                  <th class="wd-10p">  SGST TDS Payable amount</th>
                  <th class="wd-10p"> CGST TDS Payable</th>
                  <th class="wd-10p">  CGST TDS Payable amount</th>
                  <th class="wd-10p"> IGST TDS Payable</th>
                  <th class="wd-10p">  IGST TDS Payable amount</th>
                  
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>

      <td>{{$payorder->id}}</td>
      <td>{{$payorder->voucherno_bvrno}}</td>
   
      <?php $tdssii =  \App\Models\ledger::where(['banks' => 1])->where(['transaction_id' => $payorder->id])->pluck('ledger')->first() ;
      $bank =  \App\Models\tally::where(['id' => $tdssii])->pluck('name')->first() ; 
      ?>
      <td>{{$bank}}</td>
			<td>{{$payorder->transactiondate}}</td>
      <?php $gross =  \App\Models\ledger::where(['banks' => '0.5'])->where(['transaction_id' => $payorder->id])->sum('amount') ;
      
      ?>
      <td>
      @if ( $payorder->id== $payorder->bullk)  
      {{$payorder->sum}}
      @else
      {{$gross}}
      @endif</td>
      
    
      <td>{{$payorder->vendor}}</td>
      <td>{{$payorder->pfms}}</td>
      <td>@if ($payorder->gst == 'NULL')
      @else
      {{$payorder->gst}}
      @endif
      </td>
     
      
      <td>@if ($payorder->pan == 'NULL')
      @else
      {{$payorder->pan}}
      @endif
      </td>
      
      
    
      <?php  
      $tds = DB::table('ledgers')
      ->select('ledgers.amount as ham','tallies.name as ledger')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.transaction_id', $payorder->id)
        ->whereIn('tallies.group',['3.6.4.1'])
        ->first();
        
$tdsb = DB::table('bulks')
      ->select('bulks.tds as ham')
        ->where('bulks.id', $payorder->bu)
        ->first();
        ?>
    
      @if($tds == '' and $tdsb == '')


      
      <td></td><td></td>
      @else
<td>{{$tds->ledger}}</td>
@if ( $payorder->id == $payorder->bullk)  
<td> {{$tdsb->ham}} </td>
      @else
    <td>  {{$tds->ham}}</td>
      @endif

@endif
<?php  
      $sgst = DB::table('ledgers')
      ->select('ledgers.amount as ham','tallies.name as ledger')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.transaction_id', $payorder->id)
        ->whereIn('tallies.group',['3.6.4.2'])
        ->first()
        ?>
@if($sgst == '')
<td></td><td></td>
      @else
<td>{{$sgst->ledger}}</td>
<td>{{$sgst->ham}}</td>
@endif
<?php  
      $cgst = DB::table('ledgers')
      ->select('ledgers.amount as ham','tallies.name as ledger')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.transaction_id', $payorder->id)
        ->whereIn('tallies.group',['3.6.4.3'])
        ->first()
        ?>
@if($cgst == '')
<td></td><td></td>
      @else
<td>{{$cgst->ledger}}</td>
<td>{{$cgst->ham}}</td>
@endif
<?php  
      $igst = DB::table('ledgers')
      ->select('ledgers.amount as ham','tallies.name as ledger')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.transaction_id', $payorder->id)
        ->whereIn('tallies.group',['3.6.4.4'])
        ->first()
        ?>
@if($igst == '')
<td></td><td></td>
      @else
<td>{{$igst->ledger}}</td>
<td>{{$igst->ham}}</td>
@endif
      
    
     
			<td><form action="{{ route('Tally.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                 


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