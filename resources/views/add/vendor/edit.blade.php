@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Vendor</a>
        <span class="breadcrumb-item active">Edit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Vendor Edit</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('beneficiary.update',$bud->id)}}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
        {{ method_field('PATCH') }} 
												<div class="form-group">
													<label for="exampleFormControlInput1">Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$bud->name}}" placeholder="Name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												<div class="form-group">
													<label for="exampleFormControlPassword">Account Number</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Account_Number}}" name="Account_Number" placeholder="Account Number">
                                                    @error('Account_Number')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

												<div class="form-group">
													<label for="exampleFormControlPassword">IFSC</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->IFS_Code}}" name="IFS_Code" placeholder="IFSC">
                                                    @error('IFS_Code')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">Branch</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Branch}}" name="Branch" placeholder="Branch">
                                                    @error('Branch')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">Bank Name</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Bank_Name}}" name="Bank_Name" placeholder="Bank Name">
                                                    @error('Bank_Name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">GST No</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->gst}}" name="gst" placeholder="GST No">
                                                    @error('gst')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>


                                                <div class="form-group">
													<label for="exampleFormControlPassword">PAN</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Income_Tax}}" name="Income_Tax" placeholder="PAN">
                                                    @error('Income_Tax')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">E Mail</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Mail_ID}}" name="Mail_ID" placeholder="E MAIL">
                                                    @error('Mail_ID')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>


                                                <div class="form-group">
													<label for="exampleFormControlPassword">Contact Number</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Contact_Number}}" name="Contact_Number" placeholder="Contact Number">
                                                    @error('Contact_Number')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>


                                                <div class="form-group">
													<label for="exampleFormControlPassword">Adress</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Address}}" name="Address" placeholder="Adress">
                                                    @error('Address')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

                                                <div class="form-group">
													<label for="exampleFormControlPassword">PFMS Code</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$bud->Contract1}}" name="Contract1" placeholder="PFMS Code">
                                                    @error('Contract1')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
                                                <input type="hidden" value="{{ auth()->user()->id }}" name="updated" readonly>
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{url('/add/beneficiary')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>
</div>
                                    @endsection
