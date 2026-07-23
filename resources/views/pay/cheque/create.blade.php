@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Pay</a>
        <a class="breadcrumb-item" href="index.html">Bank</a>
        <span class="breadcrumb-item active">Select</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Bank wise payment</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('cheque.index') }}" method="GET">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Bank Name</label>
                                                    <select name="bank" id="" class="form-control" required="required">
                                                    <option value="">--Please select Bank--</option>
                                                    @if(auth()->check())
        
                                                                @if(auth()->user()->id == 419)
                                                                    <option value="6338">IITH Gymkhana A/c 110182493624</option>
                                                                
                                                                @elseif(auth()->user()->id == 825)
                                                                    <option value="6369">GIAN_3356_Canara_110162324361</option>
                                                                
                                                                @endif

                                                            @endif
                                               
                                                    </select>

                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
											

												
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{route('Tally.store')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>

                                    @endsection
