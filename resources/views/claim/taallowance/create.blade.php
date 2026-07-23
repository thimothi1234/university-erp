@extends('project.admin_master')

@section('project')

<style>



.required {
  color: red;
}
</style>

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Tour & TA Advance</a>
        <span class="breadcrumb-item active">Submit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Tour & TA Advance</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('claim.store') }}" method="POST">
                                            @csrf


										
												<div class="form-group">
												
                                                    @error('class')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>


											
											

												<div class="row">
                                               <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Name<span class="required">*</span></label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name" Required>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Designatiion</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="designation" placeholder="Designatiion">
                                                    @error('designation')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Paylevel</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="paylevel" placeholder="Paylevel">
                                                    @error('paylevel')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">ID No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="idno" placeholder="ID No">
                                                    @error('idno')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>

												<div class="row">
                                               <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Type</label>
													<select name="type" class="form-control" id="exampleFormControlInput1">
														<option value="Student">Student</option>
														<option value="faculty">faculty</option>
														<option value="staff">staff</option>
													

													</select>

                                                    @error('type')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Department.</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="department" placeholder="Department.">
                                                    @error('department')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>


											

												<div class="col-sm">

											



												<div class="form-group">
													<label for="exampleFormControlInput1">Purpose of travel/ purchase</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="purpose" placeholder="Purpose of travel /purchase">
                                                    @error('purpose')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div></div>

												<div class="row">
                                               <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Proposed date of journey From</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="proposeddate" placeholder="Proposed date of journey">
                                                    @error('proposeddate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">To</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="todate" placeholder="To">
                                                    @error('todate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>


												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Proposed Class of Journey</label>
													<select name="class" class="form-control" id="exampleFormControlInput1">
														<option value="Air(Economy)">Air(Economy)</option>
														<option value="Train (1AC/2AC/3AC/ACC/SL/CC)">Train (1AC/2AC/3AC/ACC/SL/CC)</option>
														<option value="Road (AC/Non-AC)">Road (AC/Non-AC)</option>
													

													</select>
                                                    @error('class')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div></div>


											<div class="row">
                                              </div>



												
												<div class="form-group">
    

              
												<label>Pay to:</label> <a href="{{route('vendor.create')}}" target="_blank">Add new Vendor</a><br />  
												<select name="vendor" class="form-control js" id="state" required="required">
															<option value="">-- Select Vendor --</option>
															@foreach ($statess as $state)
																<option value="{{ $state->id }}">{{ ucfirst($state->name) }}</option>
															@endforeach
														</select>

											</div> 




<div>

																				
																					<table class="table" id="dynamicTable1" style="width: 50%">
																					<STRONg><label for="exampleFormControlInput1">Estimated & Requested Amount</label></STRONg>
																					<tr>
																					<th scope="col" span="1" style="width: 25%;" >Type</th>
																						<th scope="col" span="1" style="width: 25%;">Onward Amount</th>
																						<th scope="col" span="1" style="width: 25%;">Return Amount</th>
																						
																					</tr>




																					<tr>
																					<td> <select name="addmore1[0][type]" id="" class="form-control" required="required">
																					<option value="">--Please select--</option>
																				
																						<option value="Travel Fare">Travel Fare</option>
																						<option value="Accommodation Charges">Accommodation Charges</option>
																						<option value="Registration Fee">Registration Fee</option>
																						<option value="Conveyance / TA / Misc">Conveyance / TA / Misc</option>
																						
																					
																					</select></td>  

																	<td>
																	<input name="addmore1[0][onward]" type="text" class="form-control onward" placeholder="onward" required="required">	
																</td> 
																<td>
																	<input name="addmore1[0][return]" type="text" class="form-control return" placeholder="return" required="required">	
																</td>  

 

																	<td><button type="button" name="add" id="add1" class="btn btn-success">+</button></td>  </tr>

																		



																</table>

						<table class="table" id="dynamicTable12" style="width: 50%">
											<STRONg><label for="exampleFormControlInput1">Projects</label></STRONg>
											<tr>
											<th scope="col" span="1" style="width: 25%;" >projects</th>
												<th scope="col" span="1" style="width: 25%;">Subhead</th>
												<th scope="col" span="1" style="width: 25%;">Amount</th>
												
											</tr>




											<tr>
               
                <td>  <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Project --</option>
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                 </td>
                  <td>  <select name="addmore[0][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Head --</option>
				    </select>
                  </td>
                  
                 
                    <td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control" required="required"/></td>  

                    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>  </tr>

								

							</table>

																	<table class="table">
																	<tr>

																	
																	<td width="25%">Total
<input class="sum form-control" type="text" id="net12" name="total" value="0" readonly /></td>
<td width="25%"></td>
	</tr>
</table></div><div></div><div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
											</div>
											</div>
											
									
										


											<script>


let initializeSelect2 =  function() {
$('.js').select2();
}

var i = 0;
$("#add12").click(function(){
	++i;
	$("#dynamicTable12").append('<tr><td> <select id="state" class="costcentre form-control js" name="addmore['+i+'][costcentre]" required="required"><option value="">--select Project--</option>@foreach ($countrie as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td> <td> <select name="addmore['+i+'][sub]" class="sub form-control js" id="city'+i+'"><option>-- Select Head--</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
	initializeSelect2()
});
$(document).on('click', '.remove-tr', function(){  
	$(this).parents('tr').remove();
}); 
$(document).ready(function() {
	initializeSelect2()
});


</script>










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
