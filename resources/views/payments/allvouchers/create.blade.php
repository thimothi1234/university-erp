@extends('project.admin_master')

@section('project')





<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyhead</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
								
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Advanced Search</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('search.index') }}" id="productForm" method="GET">
                                            
										


											<div class="form-group">
											<label>Search By Type:</label><br /> 
											<select name="Payment" id="" class="form-control myselection" >
											<option value="">--Please select--</option>
											@foreach ($paymenttype as $buds)
											<option value="{{$buds->debit_credit}}">{{$buds->debit_credit}}</option>
											@endforeach
											</select>
											</div>



											<div class="form-group">
											<label>Search by Vendor:</label><br /> 
											<select name="name" id="" class="form-control myselection" >
											<option value="">--Please select--</option>
											@foreach ($employees as $buds)
											<option value="{{$buds->id}}">{{$buds->name}}</option>
											@endforeach
											</select>
											</div>
											<div class="row">
    										<div class="col-sm">
                                            <div class="form-group">

											
											<label>Search by Amount:</label><br /> 
											<input type="number" name="amount" placeholder="Amount" class="txt form-control" />
											</div></div>
											

											<div class="col-sm">
											<div class="form-group">
											<label>Search by Forwarding no:</label><br /> 
											<input type="number" name="id" placeholder="ID" class="txt form-control" />
											</div></div>

											<div class="col-sm">
											<div class="form-group">
											<label>Search by Cheque number:</label><br /> 
											<input type="text" name="cheque" placeholder="Cheque No." class="txt form-control" />
											</div></div>
											
											<div class="col-sm">
											<div class="form-group">
											<label>Search by voucher number:</label><br /> 
											<input type="number" name="voucher" placeholder="Voucher No" class="txt form-control" />
											</div>
											</div>
											</div>


											<div class="row">
											    <div class="col-sm">
											<div class="form-group">
											<label>Search by Payment Period</label>
											<label> | From:</label><br /> <input type="date" class="form-control"  name="from"> </div></div>
											<div class="col-sm">
											<div class="form-group">
											<label>To:</label><br /> <input type="date" class="form-control"  name="to"> </div></div></div>
											
											<div class="form-group">
				<button type="submit" class="btn btn-primary">Get Report</button>
				</div>
										
											</form>
										</div>
									</div>
                               
								


    <script type="text/javascript">
	$(document).ready(function(){
        

		$('.myselection').select2(
            {theme: "classic"
            }
        );
        
   });


</script>



                                    @endsection
