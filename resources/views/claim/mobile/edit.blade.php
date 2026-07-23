@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Telephone Reimbursement</a>
        <span class="breadcrumb-item active">Submit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4 style="text-align:center">Telephone Reimbursement</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('mobile.store') }}" method="POST">
										<div class="container">
                                            @csrf


										
												<div class="form-group">
												
                                                    @error('class')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>


											
                        <input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">

												<div class="row">
                                               <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" Value="{{$bud->name}}" required>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Designatiion</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="designation" Value="{{$bud->designation}}" required>
                                                    @error('designation')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">ID No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="eid" Value="{{$bud->eid}}" required>
                                                    @error('idno')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>

												<div class="row">
												<input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Department.</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="department" Value="{{$bud->department}}" required>
                                                    @error('department')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>


											


												
                                               <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">From month</label>
													<input type="month" class="form-control" id="exampleFormControlInput1" name="from" value="{{$bud->from}}" required>
                                                    @error('proposeddate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">To month</label>
													<input type="month" class="form-control" id="exampleFormControlInput1" name="to" Value="{{$bud->to}}" required>
                                                    @error('todate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div></div>


											


											
                        <input type="hidden" name="status" value="inward">


												
												<div class="form-group">
    

              
												<label>Pay to:</label> <a href="{{route('vendor.create')}}" target="_blank">Add new Vendor</a><br />  
												<select name="vendor" class="form-control js" id="state" required="required">
															<option value="{{$bud->vendor}}">{{$bud->nmmms->name}}</option>
															@foreach ($statess as $state)
																<option value="{{ $state->id }}">{{ ucfirst($state->name) }}</option>
															@endforeach
														</select>

											</div> 




<div>

																				
																				


																	<table class="table">
																	<tr>

																	
																	<td width="25%">Amount Claimed
<input class="form-control" type="text" id="ne" name="amount" value="{{$bud->amount}}" required/></td>
<td width="25%"></td>
	</tr>
</table></div><div></div><div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
											</div>
											</div>
											</div>
											
									
										













<script type="text/javascript">

   

var i = 0;

   

$("#add1").click(function(){



	++i;



	$("#dynamicTable1").append('<tr><td><select name="addmore1['+i+'][type]" id="" class="form-control" required="required"><option value="">--Please select--</option><option value="Travel Fare">Travel Fare</option><option value="Accommodation Charges">Accommodation Charges</option><option value="Registration Fee">Registration Fee</option><option value="Conveyance / TA / Misc">Conveyance / TA / Misc</option>	</select></td><td><input type="text" name="addmore1['+i+'][onward]" id="" class="form-control onward" required="required" placeholder="onward"></td><td><input type="text" name="addmore1['+i+'][return]" id="" class="form-control return" required="required" placeholder="return"></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');

});



$(document).on('click', '.remove-tr', function(){  

	 $(this).parents('tr').remove();

});  

function sumIt2() {
  var total = 0, val;
  $('.onward').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('#net').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","onward").val(0))
      .before("<br/>");
    sumIt2();  
  });


  $(document).on('input', '.onward', sumIt2);
  sumIt2() // run when loading
})

function sumIt3() {
  var total = 0, val;
  $('.return').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('#net1').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","return").val(0))
      .before("<br/>");
    sumIt2();  
  });


  $(document).on('input', '.return', sumIt3);
  sumIt3() // run when loading
})


function sumIt5() {
  var total = 0, val;
  $('.return,.onward').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('#net12').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","return,.onward").val(0))
      .before("<br/>");
    sumIt2();  
  });


  $(document).on('input', '.return,.onward', sumIt5);
  sumIt5() // run when loading
})




</script>

<script type="text/javascript">
        $(document).ready(function () {

            $(document.body).on("change.select2", ".costcentre", function () {
                var id_country = $(this).val();
                var token = $("input[name='_token']").val();
                var el = $(this)
                $.ajax({
                    url: "<?php echo route('select-ajax') ?>",
                    method: 'GET',
                    dataType: 'json',
                    data: { id_country: id_country, _token: token },
                    success: function (data) {
                        el.closest("tr").find(".sub").html('');
                        el.closest("tr").find(".sub").html(data.options);
                    }
                });
            });
        });
    </script>


                                    @endsection
