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
                                                {{$project->name }} Sub Head wise Expenditure
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
            <table id="example1" width="100%" class="table display responsive nowrap">
              <thead>
               
              </thead>
              <tbody>
              
              <html>
<header>
  
</header>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #DDD;
}

tr:hover {background-color: #D6EEEE;}
</style>
<body>
<table id="example1" width="100%" class="table display responsive nowrap">
<tr>
                <th class="wd-15p">Head</th>
                  <th class="wd-15p">Dr Total</th>
                  <th class="wd-15p">Cr Total</th>
                  <th class="wd-15p">Nett Total</th>
               

                </tr>
    <tbody>

    @foreach($payorders as $payorder)
    @if($payorder->id == 0)
    <tr class='clickable-row' data-href="{{ url('trans1',['id' => $payorder->cos, 'from' => $from, 'to' => $to]) }}" >
        @else
    
        <tr class='clickable-row' data-href="{{ url('trans',['id' => $payorder->id, 'from' => $from, 'to' => $to]) }}" >
            @endif
            <td onclick="toggleElement(this)">
            
            {{$payorder->costcentre}}


            </td>
            <td>{{$payorder->dr_total}}</td>
            <td> {{$payorder->cr_total}}</td>
            <td> {{$payorder->dr_total-$payorder->cr_total}}</td>
        </tr>
        
        
        
        

        @endforeach
       
    </tbody>
</table>
</body>
</html>
                
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
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
@endsection