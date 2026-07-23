@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Travelling Allowance Bill</a>
        <span class="breadcrumb-item active">Submit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4 style="text-align:center">Travelling Allowance Bill</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('travel.store') }}" method="POST" enctype="multipart/form-data">
									
                                            @csrf


										
												<div class="form-group">
												
                                                    @error('class')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>


											
											

												<div class="row">
                                               <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name">
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
													<label for="exampleFormControlInput1">Department.</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="department" placeholder="Department.">
                                                    @error('department')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">ID No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="eid" placeholder="ID No">
                                                    @error('idno')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>


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
                      <div class="form-group">
												<label for="file">Email Approval Attachment</label>
                    <input type="file" name="file" class="form-control" required>
                    @error('file')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                </div>

											<div class="form-group">
													<label for="exampleFormControlInput1">Purpose</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="remarks" placeholder="Purpose" required>
                                                    @error('remarks')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>



<div>

																				
														<table class="table" id="dynamicTable1" style="width: 100%">
														<STRONg><label for="exampleFormControlInput1">Amount in detail</label></STRONg>
														<tr>
                            <th scope="col" span="1" style="width: 20%;" >Budget Head</th>
															<th scope="col" span="1" style="width: 15%;">Subhead</th>
														<th scope="col" span="1" style="width: 15%;" >Type</th>
                            <th scope="col" span="1" style="width: 15%;" >Station</th>
															<th scope="col" span="1" style="width: 10%;">Date & Time</th>
															<th scope="col" span="1" style="width: 10%;">Class</th>
															<th scope="col" span="1" style="width: 5%;">Distance</th>
                              <th scope="col" span="1" style="width: 15%;">Ticket No/Invoice No.</th>
															<th scope="col" span="1" style="width: 10%;">Amount</th>
															
														</tr>		<tr>

                                          <td>  <select name="addmore1[0][costcentre]" class="costcentre form-control js" id="state" required="required">
															<option value="">-- Select Budget Head --</option>
															@foreach ($countries as $key => $value)
																<option value="{{ $key }}">{{ $value }}</option>
																@endforeach
															</select>
															</td>
															<td>  <select name="addmore1[0][sub]" class="sub form-control js" id="city0">
															<option value="">-- Select Head --</option>
																</select>
															</td>

																					<td> 
                                            
                                          <select name="addmore1[0][type]" id="" class="form-control">

                                          <option value="Departure">Travel-Departure</option>
                                          <option value="Arrival">Travel-Arrival</option>
                                          <option value="Accommodation">Accommodation</option>
                                          <option value="Food">Food</option>
                                          <option value="Porter">Porter</option>
                                          <option value="Registration Fee">Registration Fee</option>
                                          <option value="Other">Other</option>

                                          </select>
                                          
                                          </td>  
                                         
                                        <td><input name="addmore1[0][station]" type="text" class="form-control" placeholder="Station" required="required"></td>
                                        <td><input name="addmore1[0][date]" type="datetime-local" class="form-control" placeholder="Date & Time" required="required"></td> 
																	<td>
                                  <select name="class" class="form-control" id="exampleFormControlInput1" required>
                                      <option value="">Please select</option>
                                      <option value="Air(Business)">Air(Business)</option>
                                        <option value="Air(Economy)">Air(Economy)</option>
                                        <option value="Train (1AC)">Train (1AC)</option>
                                        <option value="Train (2AC)">Train (2AC)</option>
                                        <option value="Train (3AC)">Train (3AC)</option>
                                        <option value="Train (ACC)">Train (ACC)</option>
                                        <option value="Train (SL)">Train (SL)</option>
                                        <option value="Train (CC)">Train (CC)</option>
                                        <option value="Road (AC)">Road (AC)</option>
                                        <option value="Road (Non-AC)">Road (Non-AC)</option>
																				</select>
																</td> 
																<td>
																	<input name="addmore1[0][distance]" type="text" class="form-control" placeholder="Distance in kms" required="required">	
																</td>  
																<td>
																	<input name="addmore1[0][ticket]" type="text" class="form-control" placeholder="Ticket No/Invoice No." required="required">	
																</td>  
																<td>
																	<input name="addmore1[0][amount]" type="text" class="form-control return" placeholder="Amount" required="required">	
																</td>  
															

 

																	<td><button type="button" name="add" id="add1" class="btn btn-success">+</button></td>  </tr>

																		



																</table>


																	<table class="table">
																	<tr>

																	
																	<td width="25%">Total
<input class="sum form-control" type="text" id="net12" name="amount" value="0" readonly /></td>
<input type="hidden" value="inward" name="status">
<input type="hidden" name="submittedby" value="{{ auth()->user()->id }}">
<td width="25%"></td>
	</tr>
</table></div><div></div><div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
											</div>
																		
</div>
<script type="text/javascript">
let initializeSelect2 =  function() {
$('.js').select2();
}
var i = 0;

   

$("#add1").click(function(){
	++i;
	$("#dynamicTable1").append('<tr><td><select name="addmore1['+i+'][costcentre]" class="costcentre form-control js" id="state" required="required"><option value="">-- Select Budget Head --</option>@foreach ($countries as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td><td>  <select name="addmore1['+i+'][sub]" class="sub form-control js" id="city0"><option value="">-- Select Sub Head --</option></select></td><td> <select name="addmore1['+i+'][type]" id="" class="form-control"><option value="Departure">Travel-Departure</option><option value="Arrival">Travel-Arrival</option><option value="Accommodation">Accommodation</option><option value="Food">Food</option><option value="Porter">Porter</option><option value="Registration Fee">Registration Fee</option><option value="Other">Other</option></select></td> <td><input name="addmore1['+i+'][station]" type="text" class="form-control" placeholder="Station" required="required"></td> <td><input name="addmore1['+i+'][date]" type="datetime-local" class="form-control" placeholder="Date & Time" required="required"></td><td><select name="class" class="form-control" id="exampleFormControlInput1" required><option value="">Please select</option><option value="Air(Business)">Air(Business)</option><option value="Air(Economy)">Air(Economy)</option><option value="Train (1AC)">Train (1AC)</option><option value="Train (2AC)">Train (2AC)</option><option value="Train (3AC)">Train (3AC)</option><option value="Train (ACC)">Train (ACC)</option><option value="Train (SL)">Train (SL)</option><option value="Train (CC)">Train (CC)</option><option value="Road (AC)">Road (AC)</option><option value="Road (Non-AC)">Road (Non-AC)</option></select></td> <td><input name="addmore1['+i+'][distance]" type="text" class="form-control" placeholder="Distance in kms" required="required">	</td>  <td><input name="addmore1['+i+'][ticket]" type="text" class="form-control" placeholder="Ticket No/Invoice No.">	</td>  <td><input name="addmore1['+i+'][amount]" type="text" class="form-control return" placeholder="Amount" required="required">	</td>  <td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
	initializeSelect2()
});



$(document).on('click', '.remove-tr', function(){  

	 $(this).parents('tr').remove();

});  
$(document).ready(function() {
	initializeSelect2()
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



                                    
