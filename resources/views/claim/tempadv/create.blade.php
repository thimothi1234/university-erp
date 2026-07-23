@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Temporary Advance/Pay Order (Purchases/ Services)</a>
        <span class="breadcrumb-item active">Submit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4 style="text-align:center">Temporary Advance/Pay Order (Purchases/ Services)</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('tempadv.store') }}" method="POST" enctype="multipart/form-data">
										<div class="container">
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
													<label for="exampleFormControlInput1">Department.</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="department" placeholder="Department." required>
                                                    @error('department')
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
    

              
												<label>The following items are required for</label> 
												<input type="text" class="form-control" id="exampleFormControlInput1" name="description" placeholder="The following items are required for" required>
                        

											</div> 

                      <div class="form-group">
                    <input type="file" name="file" class="form-control">
                    @error('file')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                </div>




<div>

																				
														<table class="table" id="dynamicTable1" style="width: 100%">
														<STRONg><label for="exampleFormControlInput1">Estimated & Requested Amount</label></STRONg>
														<tr>
                            <th scope="col" span="1" style="width: 25%;" >Budjet Head</th>
                            <th scope="col" span="1" style="width: 25%;" >Sub Head</th>
														<th scope="col" span="1" style="width: 25%;" >Details of items</th>
															<th scope="col" span="1" style="width: 5%;">Quantity</th>
															<th scope="col" span="1" style="width: 10%;">Rate(Rs)</th>
															<th scope="col" span="1" style="width: 10%;">Estimated Cost (Rs.)</th>
															
															
														</tr>




																					<tr>

                                          <td>  <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Budget Head --</option>
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                 </td>
                  <td>  <select name="addmore[0][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Sub Head --</option>
				    </select>
                  </td>


																					<td> <input name="addmore1[0][details]" type="text" class="form-control" placeholder="Details of items" required="required"></td>  

																	<td>
																	<input name="addmore1[0][quantity]" type="text" class="form-control" placeholder="Quantity" required="required">	
																</td> 
																<td>
																	<input name="addmore1[0][rate]" type="text" class="form-control" placeholder="Rate(Rs)" required="required">	
																</td>  
																<td>
																	<input name="addmore1[0][amount]" type="text" class="form-control return" placeholder="Estimated Cost (Rs.)" required="required">	
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
</div>
<script type="text/javascript">
let initializeSelect2 =  function() {
$('.js').select2();
}
var i = 0;

   

$("#add1").click(function(){
	++i;
	$("#dynamicTable1").append('<tr><td><select name="addmore1['+i+'][costcentre]" class="costcentre form-control js" id="state" required="required"><option value="">-- Select Budget Head --</option>@foreach ($countries as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td><td>  <select name="addmore1['+i+'][sub]" class="sub form-control js" id="city0"><option value="">-- Select Sub Head --</option></select></td><td><input type="text" name="addmore1['+i+'][details]" id="" class="form-control" required="required" placeholder="Details of items"></td><td><input type="text" name="addmore1['+i+'][quantity]" id="" class="form-control" required="required" placeholder="Quantity"></td><td><input type="text" name="addmore1['+i+'][rate]" id="" class="form-control" required="required" placeholder="Rate(Rs)"></td><td><input type="text" name="addmore1['+i+'][amount]" id="" class="form-control return" required="required" placeholder="Estimated Cost (Rs.)"></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
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
