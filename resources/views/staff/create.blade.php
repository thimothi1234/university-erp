@extends('project.admin_master')

@section('project')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyhead</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>New Staff/Faculty</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('staff.store') }}" method="POST">
                                            @csrf

											<div class="row">
											    <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name">
                                                    @error('Name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm"><div class="form-group">
													<label for="exampleFormControlInput1">E-Id</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="eid" placeholder="E-Id">
                                                    @error('E-Id')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>
												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Designation</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="designation" placeholder="Designation">
                                                    @error('Projectcode')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div></div>



												<div class="row">
											    <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Category</label>
													<select name="category" class="form-control" id="exampleFormControlInput1">
													<option value="Faculty">Faculty</option>
												<option value="Staff">Satff</option>
												</select>
                                                    @error('category')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>

												</div>
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Date of Birth</label>
													<input type="date" class="form-control" id="exampleFormControlInput1" name="dob" placeholder="Date of Birth">
                                                    @error('dob')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
											</div>
												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">PAN</label>
													<input type="text" class="form-control" id="datepicker" name="pan" placeholder="PAN">
                                                    @error('pan')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div></div>

												<div class="row">
											    <div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Department</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="department" placeholder="Department">
                                                    @error('department')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">E-MAIL</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="email" placeholder="E-MAIL">
                                                    @error('email')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">


												<div class="form-group">
													<label for="exampleFormControlInput1">Mobile</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="mobile" placeholder="Mobile">
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>


												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                               

								
                                    @endsection
