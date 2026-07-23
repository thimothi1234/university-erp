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
											<h4>Select po</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ url('indexpo') }}" method="GET">
                                            
											<div class="form-group">
											<label>PO:</label><br /> 
											<select name="bank" id="" class="form-control myselection" required="required">
                <option value="">--Please select--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->po}}">{{$buds->po}}</option>
                @endforeach
                </select>
</div>




				<button type="submit" class="btn btn-primary">Get Report</button>
				</div>
										
											</form>
										</div>
									</div>
									</DIV>
                               
								


    <script type="text/javascript">
	$(document).ready(function(){
        

		$('.myselection').select2(
            {theme: "classic"
            }
        );
        
   });


</script>

                                    @endsection
