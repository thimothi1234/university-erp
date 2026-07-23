@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">New beneficiary</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-sm-6">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Add New beneficiary/Employee</h4>
										</div>
                                        @error('class')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
										<div class="card-body">
                                        <form action="{{route('beneficiary.store')}}" method="POST">
                                            @csrf
                                            <div class="container">
                                                <div class="form-group">
                                                    <h2 style="color:red;">Don't Create Permanent Faculty and staff Details</h2>
													<label for="exampleFormControlInput1">Type</label>
                                                    <SELECT class="form-control" id="exampleFormControlInput1" name="Under" required="required">
                                                    <OPTION value="">Please select</OPTION>
                                                    <OPTION value="Vendor">Vendor</OPTION>
                                                    <OPTION value="Student">Student</OPTION>
                                                        <OPTION value="Visiting Faculty">Visiting Faculty</OPTION>
                                                      
                                                        <OPTION value="Project staff">Project staff</OPTION>
                                                        
                                                    </SELECT>
                                                    @error('type')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
                                                <div class="form-group">
													<label for="exampleFormControlInput1">Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name" required="required">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
                                                <div class="form-group">
													<label for="exampleFormControlInput1">Bank Account No</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Account_Number" placeholder="Bank Account No" required="required">
                                                    @error('Account_Number')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
                                                <div class="form-group">
													<label for="exampleFormControlInput1">IFSC</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="IFS_Code" placeholder="IFSC" required="required">
                                                    @error('IFS_Code')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
                                                
												<div class="form-group">
													<label for="exampleFormControlInput1">Branch</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Branch" placeholder="Branch" required="required">
                                                    @error('Branch')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												<div class="form-group">
													<label for="exampleFormControlPassword">Bank Name</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="Bank_Name" placeholder="Bank Name" required="required">
                                                    @error('Bank_Name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

												<div class="form-group">
													<label for="exampleFormControlPassword">GST No</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="gst" placeholder="GST No" required="required">
                                                    @error('gst')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">PAN No</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="Income_Tax" placeholder="PAN No" required="required">
                                                    @error('Income_Tax')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">E-Mail</label>
													<input type="email" class="form-control" id="exampleFormControlPassword" name="Mail_ID" placeholder="E-Mail" required="required">
                                                    @error('Mail_ID')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>


                                                <div class="form-group">
													<label for="exampleFormControlPassword">Mobile No</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="Contact_Number" placeholder="Mobile No" required="required">
                                                    @error('Contact_Number')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>


                                                <div class="form-group">
													<label for="exampleFormControlPassword">Adress</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="Address" placeholder="Adress" required="required">
                                                    @error('Address')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">PFMS Code</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="Contract1" placeholder="PFMS Code" required="required">
                                                    @error('Address')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                
												 <input type="hidden" value="{{ auth()->user()->id }}" name="entered" readonly>
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{route('beneficiary.index')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>
                                    </div>
                                    </div>
                                    @endsection
