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
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Payment</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>All Vouchers</h4>

                      <div class="pull-right">
               
            </div>


										</div>
  

                <form action="{{ route('search.index') }}" method="GET">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name (or) Narration from entire vouchers...">
        
        <button type="submit" class="btn btn-primary">Search by Name (or) Narration from entire vouchers</button>
        </div>
    </form>



          <div class="table-wrapper">
            <table id="example" class="table display responsive nowrap">
              <thead>
                <tr>
                <th class="wd-15p">S.No</th>    
        
                <th class="wd-15p">Gross</th>       
                  <th class="wd-15p">Net</th>
                  <th class="wd-15p">vendor </th>
                 
                  <th class="wd-30p">Narration </th>
                  <th class="wd-15p">Status </th>
                
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              

<div class="row">

       
			  @foreach($results as $payorder)
			<tr>
      <td style="white-space:normal;">{{$payorder->id}}</td>
  
      <td style="white-space:normal;">{{$payorder->gross}}</td>
      <td style="white-space:normal;">{{$payorder->sum}}</td>

      <td style="white-space:normal;">{{$payorder->ven}}</td>
      <td style="white-space:normal;">{{$payorder->narration}}</td> 
      <td style="white-space:normal;">

      @if ($payorder->status == 1)
      <span >Pending with AR(F&A)</span>
      @elseif ($payorder->status == 2)
      <span >Pending with DDO</span>
      @elseif ($payorder->status == 3)
      <span >Pending with DR(F&A)</span>
      @elseif ($payorder->status == 4)
      <span >Pending with Cashier to issue cheque </span>
      @elseif ($payorder->status == 'paid')
      <span >Transaction Sucess with Cheque {{$payorder->chequeno}} dated  {{$payorder->transactiondate}}</span>
      @endif
      </td>
      
			<td style="white-space:normal;"><form action="{{ route('voucher.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
</td>
			</tr>
			@endforeach

      @foreach($resultsb as $payorder)
			<tr>
      <td style="white-space:normal;">{{$payorder->id}}</td>
      <td style="white-space:normal;">{{$payorder->gross}}</td>
      <td style="white-space:normal;">{{$payorder->sum}}</td>

      <td style="white-space:normal;">{{$payorder->ven}}</td>
      <td style="white-space:normal;">{{$payorder->narration}}</td> 
      <td style="white-space:normal;">

@if ($payorder->status == 1)
<span >Pending with AR(F&A)</span>
@elseif ($payorder->status == 2)
<span >Pending with DDO</span>
@elseif ($payorder->status == 3)
<span >Pending with DR(F&A)</span>
@elseif ($payorder->status == 4)
<span >Pending with Cashier to issue cheque </span>
@elseif ($payorder->status == 'paid')
<span >Transaction Sucess with Cheque {{$payorder->chequeno}} dated  {{$payorder->transactiondate}}</span>
@endif
</td>
      
			<td style="white-space:normal;"><form action="{{ route('voucher.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
</td>
			</tr>
			@endforeach
      
 
      </div>
  
                
              </tbody>
              
            </table>

            <center class="mt-5">
        
         
                    </center>
          </div><!-- table-wrapper -->
        </div><!-- card -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
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
        order: [[0, 'desc']],
        scrollY: '400px',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>



<script>
$(document).ready(function() {
    $('#search').keyup(function() {
        var searchTerm = $(this).val();
        
        $.ajax({
            url: '{{ route("search.index") }}',
            type: 'GET',
            data: { search: searchTerm },
            success: function(response) {
                $('#search-results').html(response);
            }
        });
    });
});


</script>
@endsection