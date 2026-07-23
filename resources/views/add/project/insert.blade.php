@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Project</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>New Project</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('add.vouchertype')}}" method="POST">
                                            @csrf

											<div class="row">
											    <div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Category</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Category" placeholder="Category">
                                                    @error('Category')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												<div class="col-sm"><div class="form-group">
													<label for="exampleFormControlInput1">Under</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Under" placeholder="Under">
                                                    @error('Under')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div></div>
												<div class="col-sm">

												<div class="form-group">
													<label for="exampleFormControlInput1">Project code</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Projectcode" placeholder="Project code">
                                                    @error('Projectcode')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div></div>
												<div class="form-group">
													<label for="exampleFormControlInput1">Project title</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Projecttitle" placeholder="Projecttitle">
                                                    @error('Projecttitle')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>

												

												<div class="form-group">
													<label for="exampleFormControlInput1">Project Type</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Projectype" placeholder="Projec Type">
                                                    @error('Projectype')
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
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Sanctiondate" placeholder="Sanction date">
                                                    @error('Sanctiondate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">


												<div class="form-group">
													<label for="exampleFormControlInput1">Sanctioned Amount</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Sanctionedamount" placeholder="Sanctioned Amount">
                                                    @error('Sanctionedamount')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>


												<div class="row">

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Start date</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Startdate" placeholder="Start date">
                                                    @error('Startdate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>


												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">End date</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Enddate" placeholder="End date">
                                                    @error('Enddate')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlInput1">Sponcering agency</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="Sponceringagency" placeholder="Sponcering agency">
                                                    @error('Sponceringagency')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												</div>
												</div>
												
												<div class="row">
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlPassword">PFMS scheme code</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="PFMSschemecode" placeholder="PFMS scheme code">
                                                    @error('PFMSschemecode')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												</div>
												
												
												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlPassword">PI</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="PI" placeholder="PI">
                                                    @error('PI')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												</div>

												<div class="col-sm">
												<div class="form-group">
													<label for="exampleFormControlPassword">CO-PI</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="CO-PI" placeholder="CO-PI">
                                                    @error('CO-PI')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												</div>
												</div>
												
												<div class="form-group">
													<label for="exampleFormControlPassword">status</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="status" placeholder="status">
                                                    @error('status')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												
												<input type="hidden" value="{{ auth()->user()->id }}" name="entered" readonly>
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{url('/add/vouchertype')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
