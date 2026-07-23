@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">​Medical Claim form A (OPT)</a>
        <span class="breadcrumb-item active">Submit</span>
      </nav>

                                <div class="row">
									
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4 style="text-align:center">​Medical Claim form A (OPT) (submission of Hard copy in F&A with original bills is mandatory)</h4>
										</div>
										<div class="card-body">
										<div class="container">
                                        <form action="{{ route('medical.store') }}" method="POST" enctype="multipart/form-data">
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
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name" required>
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Designatiion</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="designation" placeholder="Designatiion" required>
                                                    @error('designation')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
											
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">ID No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="eid" placeholder="ID No" required>
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
													<select name="type" class="form-control" id="exampleFormControlInput1" required>
													<option value="">select one</option>
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
													<label for="exampleFormControlInput1">Patient Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="patientname" placeholder="Patient Name" required>
                                                    @error('patientname')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>


											

												<div class="col-sm">

											



												<div class="form-group">
													<label for="exampleFormControlInput1">Patient Age</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="patientage" placeholder="Patient Age" required>
                                                    @error('patientage')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div></div>

												<div class="row">
                                               <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Relation with employee</label>
												

													<select name="relation" class="form-control" id="exampleFormControlInput1" required>
													<option value="">select one</option>
													<option value="self">self</option>
														<option value="Wife">Wife</option>
														<option value="Husband">Husband</option>
														<option value="Mother">Mother</option>
														<option value="Mother-In-Law">Mother-In-Law</option>
														<option value="Father">Father</option>
														<option value="Father-In-Law">Father-In-Law</option>
														<option value="Son">Son</option>
														<option value="Daughter">Daughter</option>
														<option value="Brother">Brother</option>
														<option value="Sister">Sister</option>

													

													</select>



                                                    @error('relation')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Doctor</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="doctor" placeholder="Doctor" required>
                                                    @error('doctor')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Address</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="address" placeholder="Address" required>
                                                    @error('address')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>


												</div>

												<div class="row">
                                               <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Disease</label>
													
													<input type="text" class="form-control" id="exampleFormControlInput1" name="disease" placeholder="Disease" required>

                                                    @error('disease')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">From</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="from" placeholder="From" required>
                                                    @error('from')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">To</label> 
													<input type="date" class="form-control" id="exampleFormControlInput1" name="to" placeholder="To" required>
                                                    @error('to')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div></div>






											<div class="row">
                                            



											  
											  <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Reffered By</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="reffered" placeholder="Reffered By" required>
                                                    @error('reffered')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>
												<div class="col-sm">

												<div class="form-group">
    

              
												<label>Pay to:</label> <br />  
												<select name="vendor" class="form-control js" id="state" required="required">
															<option value="">-- Select Vendor --</option>
															@foreach ($statess as $state)
																<option value="{{ $state->id }}">{{ ucfirst($state->name) }}</option>
															@endforeach
														</select>
														</div>
											</div> 

											</div>



											<div class="form-group">
												<label for="file">Email Referral Attachment</label>
                    <input type="file" name="file" class="form-control" required>
                    @error('file')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                </div>

											<div class="form-group">
													<label for="exampleFormControlInput1">Remarks if any</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="remarks" placeholder="Remarks">
                                                    @error('remarks')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>




<div>

																				
																					<table class="table" id="dynamicTable1" style="width: 100%">
																					<STRONg><label for="exampleFormControlInput1">Estimated & Requested Amount</label></STRONg>
																					<tr>
																					<th scope="col" span="1" style="width: 25%;" >Type</th>
																						<th scope="col" span="1" style="width: 25%;">Name of the doctor/ medicine/procedure/tests</th>
																						<th scope="col" span="1" style="width: 15%;">Cash Memo no</th>
																						<th scope="col" span="1" style="width: 5%;">Date</th>
																						<th scope="col" span="1" style="width: 10%;">Quantity</th>
																						<th scope="col" span="1" style="width: 15%;">Amount</th>
																						

																						
																					</tr>




																					<tr>
																					<td> <select name="addmore1[0][type]" id="" class="form-control" required="required">
																					<option value="">--Please select--</option>
																				
																						<option value="Consultation fee">Consultation fee</option>
																						<option value="Fee for injection(s)">Fee for injection(s)</option>
																						<option value="Medicines">Medicines</option>
																						<option value="Investigations">Investigations</option>
																						<option value="Travel Allownace">Travel Allownace</option>
																						
																						
																					
																					</select></td>  

																					<td>
																	<input name="addmore1[0][name]" type="invoice" class="form-control name" placeholder="Name of the medicine/procedure/tests" required="required">	
																</td> 
																					<td>
																	<input name="addmore1[0][invoice]" type="invoice" class="form-control name" placeholder="Cash Memo N.o" required="required">	
																</td> 
																	<td>
																	<input name="addmore1[0][date]" type="date" class="form-control name" placeholder="Date" required="required">	
																</td> 
																<td>
																	<input name="addmore1[0][quantity]" type="text" class="form-control name" placeholder="quantity" required="required">	
																</td> 
																<td>
																	<input name="addmore1[0][amount]" type="text" class="form-control return" placeholder="Amount" required="required">	
																</td> 
																	<td><button type="button" name="add" id="add1" class="btn btn-success">+</button></td>  </tr>
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
											</div>
									
										













<script type="text/javascript">

   

var i = 0;

   

$("#add1").click(function(){

	++i;
	$("#dynamicTable1").append('<tr><td> <select name="addmore1['+i+'][type]" id="" class="form-control" required="required"><option value="">--Please select--</option><option value="Consultation fee">Consultation fee</option><option value="fee for injection(s)">Fee for injection(s)</option><option value="medicines">Medicines</option><option value="investigations">Investigations</option><option value="TA">TA</option></select></td><td><input name="addmore1['+i+'][name]" type="invoice" class="form-control name" placeholder="Name of the medicine/procedure/tests" required="required"></td><td><input name="addmore1['+i+'][invoice]" type="invoice" class="form-control name" placeholder="Cash Memo N.o" required="required"></td><td><input name="addmore1['+i+'][date]" type="date" class="form-control name" placeholder="Date" required="required"></td><td><input name="addmore1['+i+'][quantity]" type="text" class="form-control name" placeholder="quantity" required="required"></td><td><input name="addmore1['+i+'][amount]" type="text" class="form-control return" placeholder="Amount" required="required"></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
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
	<script type="text/javascript">
$(document).ready(function(){
    $('.js').select2({})
})
</script>


                                    @endsection
