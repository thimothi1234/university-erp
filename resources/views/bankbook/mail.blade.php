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
											<h4>
                    
                   

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
                <th class="wd-15p">s.No</th>
             
                  <th class="wd-15p">Transaction Date</th>
                 
                  <th class="wd-15p">Net</th>
                  <!-- <th class="wd-15p">Gross</th> -->
                  <th class="wd-10p">Benificiary </th>
                  <th class="wd-10p">Cheque No. </th>
                  <th class="wd-10p"> Po/agmt/inv N.o </th>
                  <th class="wd-10p"> Budget Head</th>
                  <th class="wd-10p"> Sub Head</th>
                  <th class="wd-10p"> Narration</th>
                  <th class="wd-10p"> Mail</th>
                  <th class="wd-10p"> Entered by</th>
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>

      <td style="white-space:normal;">{{$payorder->id}}</td>
      
			<td style="white-space:normal;">{{$payorder->transactiondate}}</td>

    
      <td style="white-space:normal;">{{$payorder->sum}}</td>
 <?php //$gross =  \App\Models\ledger::where(['cr_dr' => 'Dr'])->where(['transaction_id' => $payorder->id])->sum('amount') ;
      
      ?>
     

      <!-- <td style="white-space:normal;"></td> -->
      <td style="white-space:normal;">{{$payorder->vendor}}</td>
   
      <td style="white-space:normal;">{{$payorder->chequeno}}</td>
      <td style="white-space:normal;">{{$payorder->po}}</td>
     
      <td style="white-space:normal;">
      {{$payorder->costcentre}}
      </td>
     
      
      <td style="white-space:normal;"> {{$payorder->sub}}</td>
     
      <td style="white-space:normal;">{{$payorder->narration}}</td>
      <td style="white-space:normal;">{{$payorder->mail}}</td>
    
           <td style="white-space:normal;"></td>


			<td style="white-space:normal;"><form action="{{ route('Tally.destroy',$payorder->id) }}" method="POST">
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