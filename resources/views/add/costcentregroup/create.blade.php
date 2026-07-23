@extends('project.admin_master')

@section('project')
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
											<h4>Cost Centre Group Insert</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('costcentregroup.store')}}" method="POST">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Group Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="groupname" placeholder="Tally Group Name">
                                                    @error('groupname')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
										
                                                    <div class="form-group">
													<label for="exampleFormControlPassword">Group Under</label>
                                                <select name="groupunder" class="form-control" id="">
                                                <option value="p">Primary</option>
                                                @foreach($payorders as $payorder)
                                                
<option value="{{$payorder->id}}">{{$payorder->groupname}}</option>       
                                        @endforeach</select>
                                        @error('group')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                    </div>
                                                <div class="form-group">
													<label for="exampleFormControlPassword">Group Acts as</label>
                                                    <select name="actsas" class="form-control" id="">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>


                                                    </select>
                                                    @error('group')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

												
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{url('/add/tallyhead')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
