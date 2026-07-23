```

<!DOCTYPE html>
<html>
<head>
	<title>Laravel 5 - onChange event using ajax dropdown list</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
                    <table class="table" id="dynamicTable12">
                <tr>
                    <th scope="col"width="250" >Ledger</th>
                    <th scope="col" width="250">Costcentre</th>
                    <th scope="col" width="250">Sub Head</th>
                    <th scope="col" width="75">Dr/Cr</th>
                    <th scope="col" width="175">Amount</th>
                </tr>
                <tr>
                <td> <select name="addmore[0][ledger]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td>  <select name="addmore[0][project]" class="form-control js" id="state" required="required">
                 <option value="">-- Select Project --</option>
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
    
                   </td>

                  <td>  <select name="sub" class="form-control">
                    <option>-- Sub Head--</option>
                    </select>
                    </td>
                    <td><select name="addmore[0][cr_dr]" id="" class="cr_dr form-control" required="required">
                    <option value="">----</option>
                    <option value="Dr">Dr</option>
                    <option value="Cr">Cr</option>
                    </select></td>  
                    <input type="hidden" value='0' name='addmore[0][banks]' >
                    <td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control" required="required"/></td>  

                    <td><button type="button" name="add" id="add12" class="btn btn-success">Add More</button></td> 
             </tr>
            </table>
```


```
 <script type="text/javascript">
                        $(document).ready(function() {
                        
  $(document.body).on("change.select2", "#state",function () {
      var id_country = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
          url: "<?php echo route('select-ajax') ?>",
          method: 'GET',
          dataType: 'json',
          data: {id_country:id_country, _token:token},
          success: function(data) {
            $("select[name='sub'").html('');
            $("select[name='sub'").html(data.options);
          }
      });
  });
                        });
</script>
```
```
<script>


let initializeSelect2 =  function() {
  $('.js').select2();
}

var i = 0;
$("#add12").click(function(){
    ++i;
    $("#dynamicTable12").append('<tr><td><select name="addmore['+i+'][ledger]" id="" class="form-control js" required="required"><option value="">--Please select--</option>@foreach($bud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select id="state" class="form-control js" name="addmore['+i+'][project]" required="required"><option value="">--select--</option>@foreach($buud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select name="sub" class="form-control"><option>-- Sub Head--</option></select></td><td><select name="addmore['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    
    initializeSelect2()
});
$(document).on('click', '.remove-tr', function(){  
     $(this).parents('tr').remove();
}); 



$(document).ready(function() {
    initializeSelect2()
});


</script>

```