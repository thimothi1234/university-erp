@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">pfmshead</a>
        <span class="breadcrumb-item active">Edit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>PFMS Head Edit</h4>
										</div>
										<div class="card-body">
                                        <form action="{{url('/add/pfmshead/update/'.$payorders->id)}}" method="POST">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">PFMS Head Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$payorders->name}}" placeholder="PFMS Head Name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												<div class="form-group">
													<label for="exampleFormControlPassword">Group</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$payorders->group}}" name="group" placeholder="Group">
                                                    @error('group')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{url('/add/pfmshead')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
