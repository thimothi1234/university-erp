@extends('project.admin_master')

@section('project')





<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">GSTTDS</a>
        <a class="breadcrumb-item" href="index.html">Report</a>
        <span class="breadcrumb-item active">Period</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
								
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Select Period for GST TDS Report</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ url('gst') }}" method="GET">
                                            
										

<div class="row">
											    <div class="col-sm">
<div class="form-group">
											<label>From:</label><br /> <input type="date" class="form-control" required="required" name="from"> </div></div>
											<div class="col-sm">
											<div class="form-group">
											<label>To:</label><br /> <input type="date" class="form-control" required="required" name="to"> </div></div></div>
											
<div class="form-group">
				<button type="submit" class="btn btn-primary">Get Report</button>
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
