@extends('project.admin_master')

@section('project')

<!DOCTYPE html>
<html>
<head>
	<title>Laravel 5 - onChange event using ajax dropdown list</title>

</head>
<body>


<div class="container">
  <h1>Laravel 5 - Dynamic Dependant Select Box using JQuery Ajax Example</h1>


  <div>
                      

                                
                              <label>Project:</label><br /> 
                              <select name="id_country" class="form-control js" id="state" required="required">
                                <option value="">-- Select Project --</option>
                                @foreach ($countries as $key => $value)
                                      <option value="{{ $key }}">{{ $value }}</option>
                                      @endforeach
                              </select>

                          </div> 
                    

                      <div>
                        <label for="state">Select State:</label> <br>
                                        <select name="id_state" class="form-control">
                                        <option>--State--</option>
                                        </select>

                                </div> 


</div>


<script type="text/javascript">
  $("select[name='id_country']").change(function(){
      var id_country = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
          url: "<?php echo route('select-ajax') ?>",
          method: 'POST',
          data: {id_country:id_country, _token:token},
          success: function(data) {
            $("select[name='id_state'").html('');
            $("select[name='id_state'").html(data.options);
          }
      });
  });
</script>


</body>
</html>

@endsection