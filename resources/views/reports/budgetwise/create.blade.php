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
											<h4>Select Project</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('reports.index') }}" method="GET">
                                           <tr></tr> 
										<td>  <select name="project" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Budget-head --</option>
                   @foreach ($bud as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                 </td>
                 
				  </tr> 



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

<script type="text/javascript">
        $(document).ready(function () {

            $(document.body).on("change.select2", ".costcentre", function () {
                var id_country = $(this).val();
                var token = $("input[name='_token']").val();
                var el = $(this)
                $.ajax({
                    url: "<?php echo route('select-ajax') ?>",
                    method: 'GET',
                    dataType: 'json',
                    data: { id_country: id_country, _token: token },
                    success: function (data) {
                        el.closest("tr").find(".sub").html('');
                        el.closest("tr").find(".sub").html(data.options);
                    }
                });
            });
        });
    </script>

                                    @endsection
