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
											<h4>Tally Head Insert</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('costcentre.store')}}" method="POST">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Tally Head Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Tally Head Name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
												<div class="form-group">
													<label for="exampleFormControlPassword">Group</label>
                                                    <select name="group" class="form-control" id="">
                                                @foreach($payorders as $payorder)
                                                <option value="{{$payorder->id}}">{{$payorder->groupname}}</option>       
                                                    @endforeach</select>                                                   
                                                     @error('group')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>

												<div class="form-group">
													<label for="exampleFormControlPassword">Opening Balance</label>
													<input type="text" class="form-control" id="exampleFormControlPassword" name="balance" placeholder="Opening Balance">
                                                    @error('balance')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
                                                </div>
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{route('costcentre.index')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
