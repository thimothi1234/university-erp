
<div class="col-md-8 col-md-offset-2">
	 <div class="panel panel-success">
      <div class="panel-heading">
      	Dynamic Deop down in Laravel City in State
      </div>
      <div class="panel-body">
	 	 <form action="" method="post">
	 	 	{{ csrf_field() }}
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group {{ ($errors->has('roll'))?'has-error':'' }}">
				    <label for="roll">State <span class="required">*</span></label>
				    <select name="state" class="form-control" id="state">
				    	<option value="">-- Select State --</option>
				    	@foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
				    </select>
				 </div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
				    <label for="roll">City </label>
				    <select name="city" class="form-control" id="city">
				    </select>
				 </div>
			  	</div>
			  </div>
			</form> 
   	  </div>
    </div>
</div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
         $(document).ready(function() {
        $('#state').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/findCityWithStateID/'+stateID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        //console.log(data);
                      if(data){
                        $('#city').empty();
                        $('#city').focus;
                        $('#city').append('<option value="">-- Select City --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="city"]').append('<option value="'+ key +'">' + value.head+ '</option>');
                    });
                  }else{
                    $('#city').empty();
                  }
                  }
                });
            }else{
              $('#city').empty();
            }
        });
    });
    </script>