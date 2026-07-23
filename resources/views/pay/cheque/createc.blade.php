@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Pay</a>
        <a class="breadcrumb-item" href="index.html">Bank</a>
        <span class="breadcrumb-item active">Select</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Cheque No.</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ url('chequeview') }}" target="_blank" method="GET">
                                            @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Cheque No.</label>
                                                    <select name="cheque" id="" class="form-control myselection" required="required">
                                                    <option value="">--Please select Cheque--</option>
                                                    @foreach ($inputs as $budss)
                                                    <option value="{{$budss->chequeno}}">{{$budss->chequeno}}</option>
                                                    @endforeach
                                                    </select>

                                                    @error('name')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>
											

												
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default">Submit</button>
                                                    <a href="{{route('cheque.create')}}" class="btn btn-secondary btn-default">Cancel</a>
													
												</div>
											</form>
										</div>
									</div>
                                    </div>
                                    </div>
                                    <script type="text/javascript">
	$(document).ready(function(){
        

		$('.myselection').select2(
            {theme: "classic"
            }
        );
        
   });


</script>
                                    @endsection
