@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyhead</a>
        <span class="breadcrumb-item active">Edit</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Tally Head Edit</h4>
										</div>
										<div class="card-body">
                                        <form action="" method="POST">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Tally Head</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$payorders->name}}" placeholder="Tally Head">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												<div class="form-group">
													<label for="exampleFormControlPassword">Group</label>
                                                    <select name="groupunder" class="form-control" id="">
                                                    <option value=""></option>
                                           
                                        <option value=""></option>       
                                       </select>

                                                    @error('group')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

												<div class="form-group">
													<label for="exampleFormControlPassword">Opening Balance</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" value="{{$payorders->balance}}" name="balance" placeholder="Opening Balance">
                                                    @error('balance')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
