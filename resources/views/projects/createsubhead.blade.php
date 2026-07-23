@extends('project.admin_master')

@section('project')





<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyhead</a>
        <span class="breadcrumb-item active">Insert</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
								
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Select Budget Head to create subhead</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ url('createsub1') }}" method="GET">
                                            
											<div class="form-group">
											<label>Budget Head:</label><br /> 
											<select name="budget" id="" class="form-control myselection" required="required">
											<option value="">--Please select--</option>
											@foreach ($payorders as $buds)
											<option value="{{$buds->id}}">{{$buds->name}}</option>
											@endforeach
											</select>
											</div>										
											<div class="form-group">
											<button type="submit" class="btn btn-primary">Create sub Head</button>
											</div>
										
											</form>
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
