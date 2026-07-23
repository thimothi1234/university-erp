@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="{{ route('projects.index') }}">Budget Heads</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4 style="text-align:center">New Budget Head</h4>
										</div>
										<div class="card-body">
										<div class="container">
                                        <form action="{{ route('projects.store') }}" method="POST">
                                            @csrf

											<div class="row">
											
											
												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Budget code</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Projectcode" placeholder="Budget code">
                                                    @error('Projectcode')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div></div>
												<div class="form-group">
													<label for="exampleFormControlInput1">Budget Head</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Budget Head">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>

												

												


												<div class="row">
											    <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Sanction No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Sanctionno" placeholder="Sanction no">
                                                    @error('Sanctionno')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Sanction Date</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="date" placeholder="Sanction date">
                                                    @error('date')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">


												<div class="form-group">
													<label for="exampleFormControlInput1">Sanctioned Amount</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="sanctioned" placeholder="Sanctioned Amount">
                                                    @error('sanctioned')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>


												<div class="row">

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Start date</label>
													<input type="date" class="form-control" id="datepicker" name="start_date" placeholder="Start date">
                                                    @error('start_date')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>


												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">End date</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="end_date" placeholder="End date">
                                                    @error('end_date')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

										
											
												
											
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlPassword">PFMS scheme code</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="pfms" placeholder="PFMS scheme code">
                                                    @error('pfms')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												</div>
												
											

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlPassword">status</label>
													<select class="form-control" id="exampleFormControlPassword" name="status">
														<option value="1">Running</option>
														<option value="0">Closed</option>
													</select>
                                                    @error('status')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												</div>
												</div>
												
												
												

																													<div>
																					<table class="table" id="dynamicTable" style="width: 100%">
																					<STRONg><label for="exampleFormControlInput1">Approving Authority</label></STRONg>

																					<tr>
																						<th scope="col" span="1" style="width: 100%;" >Name of the faculty</th>
																				
																					</tr>




																					<tr>
																					<td> <select name="addmore[0][name]" id="" class="form-control livesearch" required="required">
																					<option value="">--Please select--</option>
																					@foreach ($payorders as $payorderss)
																						<option value="{{$payorderss->id}}">{{$payorderss->name}}</option>
																						@endforeach
																					</select></td>  

														
																
 

																	 </tr>




																	</table>
																

                </div>




				
				<div>
																					<table class="table" id="dynamicTable1" style="width: 100%">
																					<STRONg><label for="exampleFormControlInput1">Head wise Funds</label></STRONg>
																					<tr>
																					<th scope="col" span="1" style="width: 50%;" >Name of the Sub Head</th>
																						<th scope="col" span="1" style="width: 50%;">Amount</th>
																					</tr>




																					<tr>
																					<td> 
																				</td>  

																	<td>
															
																</td>  

 

																	<td><button type="button" name="add" id="add1" class="btn btn-success">+</button></td>  </tr>




																	</table>
																

                </div>





															<div>
															
										

															</div>
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
									</div>

				<script type="text/javascript">
				var i = 0;
				$("#add").click(function(){
					++i;
					$("#dynamicTable").append('<tr><td><select name="addmore['+i+'][name]" id="" class="form-control livesearch" required="required"><option value="">--Please select--</option>@foreach ($payorders as $payorderss)<option value="{{$payorderss->id}}">{{$payorderss->name}}</option>@endforeach	</select></td><td><select name="addmore['+i+'][role]" id="" class="form-control" required="required"><option value="">--select--</option><option value="PI">PI</option><option value="Co-PI">CO-PI</option></select></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');});
				$(document).on('click', '.remove-tr', function(){  
				$(this).parents('tr').remove();
				});  
				</script>
				<script type="text/javascript">
				var i = 0;
				$("#add1").click(function(){
				++i;
				$("#dynamicTable1").append('<tr><td><input name="addmore1['+i+'][head]" id="" class="form-control" placeholder="Sub Head" /></td><td><input type="text" name="addmore1['+i+'][amount]" id="" class="form-control"  placeholder="Amount"></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
				});
				$(document).on('click', '.remove-tr', function(){  
				$(this).parents('tr').remove();
				});  
				</script>
@endsection
