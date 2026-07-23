@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Repots</a>
        <a class="breadcrumb-item" href="index.html">tallyledgers</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
@foreach($project as $payorder)
											<h4>{{$payorder->name}} --- {{$payorder->Projectcode}} </h4>
											<h5></h5>
											@endforeach

                   


										</div>
          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
       
				<div class="row">
											    <div class="col-sm">

				<div class="col-12 col-lg-12">
			  <div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title">Payments</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-striped mb-0">
						  <thead class="thead-light">
							<tr>
							<th scope="col">s.No</th>
							  <th scope="col">Voucher No</th>
							  <th scope="col">Vendor</th>
							  <th scope="col">Amount</th>
							  <th scope="col">Narration</th>
							  <th scope="col">Date</th>
							  <th scope="col">View</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $sum_tot_Price = 0 ?>

							@foreach($payorders as $payorder)
              
			  <tr>
			  <td>{{$payorder->id}}</td>
			  <td>{{$payorder->voucherno_bvrno}}</td>
			  <td>{{$payorder->vendor}}</td>
			  <td>{{$payorder->sum}}</td>
			  <td>{{$payorder->narration}}</td>
		<td>{{$payorder->transactiondate}}</td>
		<td><a class="btn btn-info" href="{{ route('voucher.show',$payorder->id) }}">Show</a></td>	
							</tr>

							<?php $sum_tot_Price += $payorder->sum ?>

							@endforeach
					
						  </tbody>
						</table>



					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div></div>
			<div class="col-sm">
			<div class="col-12 col-lg-12">
			  <div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title">Receipts</h4>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table class="table table-striped table-dark mb-0">
						  <thead>
							<tr>
							<th scope="col">BVR No</th>
							  <th scope="col">Vendor</th>
							  <th scope="col">Amount</th>
							  <th scope="col">Narration</th>
							  <th scope="col">Date</th>
							  <th scope="col">View</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $sum_tot_Price1 = 0 ?>
						  @foreach($payordeer as $pay)
              
			  <tr>
			  <td>{{$pay->voucherno_bvrno}}</td>
			  <td>{{$pay->vendor}}</td>
			  <td>{{$pay->sum}}</td>
			  <td>{{$pay->narration}}</td>
		<td>{{$pay->transactiondate}}</td>
	<td><a class="btn btn-info" href="{{ route('voucher.show',$pay->id) }}">Show</a></td>	
							</tr>
							<?php $sum_tot_Price1 += $pay->sum ?>
							@endforeach

						
						  </tbody>
						</table>
					</div>
				</div>



				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  
			</div>
			

			</div>

			
			</div>
		
		<br><br>
			<table class="table">
  <thead>
    <tr>
   
      <th scope="col">Payments</th>
      <th scope="col">Receipts</th>
      <th scope="col">Available</th>
    </tr>
  </thead>
  <tbody>
    <tr>
 
      <td>{{ $sum_tot_Price}}</td>
      <td> {{ $sum_tot_Price1}}</td>
      <td>{{ $sum_tot_Price1-$sum_tot_Price}}</td>
    </tr>
    
  </tbody>
</table>




</div>
			

@endsection