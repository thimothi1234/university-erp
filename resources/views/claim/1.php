
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<table class="table" id="dynamicTable12" style="width: 50%">
                        <tr>
                        <th scope="col" span="1" style="width: 25%;" >projects</th>
                        </tr>
                        <tr>
                        <td> <select name="addmore1[0][project]" class="form-control" id="state" required="required">
                                    <option value="">-- Select Project --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                        </select></td>  
                        <td><button type="button" name="add" id="add12" class="btn btn-success">Add More</button></td>  </tr>
                            </table>




<script type="text/javascript">
var i = 0;
$("#add12").click(function(){
	++i;
	$("#dynamicTable12").append('<tr><td><select name="addmore1['+i+'][project]" id="" class="form-control" required="required"><option value="">-- Select Project --</option> <option value="A">A</option><option value="B">B</option></select></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
	 $(this).parents('tr').remove();
}); 
</script>	