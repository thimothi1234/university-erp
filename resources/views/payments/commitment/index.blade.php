@extends('project.admin_master')

@section('project')

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Commitments</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Commitments</h4>

                      <div class="pull-right">
                @can('Tally-create')
                <a class="btn btn-success" href="{{ route('commitment.create') }}"> Commitment Entry</a>
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
            <table id="example" class="table display responsive nowrap">
              <thead>
                <tr>
                <th class="wd-15p" style="white-space:normal;">Commitmnet Id</th>
                 
                <th class="wd-15p" style="white-space:normal;">Date</th>
                  <th class="wd-15p" style="white-space:normal;">Commitment value</th>
                  <th class="wd-15p" style="white-space:normal;">Balance Amount</th>
                  <th class="wd-15p" style="white-space:normal;">Budget Head</th>
                  <th class="wd-15p" style="white-space:normal;">Sub Head</th>
                  <th class="wd-15p" style="white-space:normal;" >narration</th>
          
                  <th class="wd-15p" style="white-space:normal;" >View</th>
             

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td style="white-space:normal;">COM-00{{$payorder->sub }}</td>
      <td style="white-space:normal;">{{ $payorder->created_at }}</td>

      
   <td style="white-space:normal;">{{$payorder->drtotal}}</td>
    
      <td style="white-space:normal;">{{$payorder->sum}}</td>
      <td style="white-space:normal;">{{$payorder->costcentre}}</td>
      @if ($payorder->subs == '')
<td></td>
      @else
      <td style="white-space:normal;">{{$payorder->subs}}</td>
      @endif
      <td style="white-space:normal;">{{$payorder->narration}}</td>
      
			<td style="white-space:normal;">  <a class="btn btn-info" target="_blank" href="{{ route('commitment.show',$payorder->id) }}">Show</a>
      <a class="btn btn-primary" target="_blank" href="{{ route('commitment.edit',$payorder->id) }}">Edit</a>
     
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