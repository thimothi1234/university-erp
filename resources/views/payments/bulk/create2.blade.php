@extends('project.admin_master')

@section('project')




<body>
        <div class="col-md-12">
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="row">
            <table class="table table-bordered" id="orders">
              <tr>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Cost</th>
                <th>
                </th>
              </tr>
              <tr>
              <td> <select name="addmore[0][bank]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach($bank_accounts as $bank_accounts)
                    
                    <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}</option>
                    @endforeach
                </select></td>  
              <td><input class="form-control product_price" type="number" id='product_price_1' name="gross[]" placeholder="Gross"  for="1" required="required"/></td>  
                <td><input class="form-control quantity" type="number" id='quantity_1' name="tds[]" placeholder="Income Tax"  for="1" required="required"/></td>  
                <td><input type="number" name="ptax[]" placeholder="Professional Tax" class="form-control"  required="required"/></td>  
<td>
<input class="form-control total_cost" type="text" id="total_cost_1" name="net[]" for="1" readonly/></td>
</td>  
                <td><button type="button" name="add" id="add" class="btn btn-success circle">+</button></td>
              </tr>
            </table>
            <input class="form-control" type='hidden' data-type="product_id_1" id='product_id_1' name='product_id[]'/>            
          </div>
        </div>

        <div class="line line-dashed line-lg pull-in" style="clear: both;"></div>
        
        <div class="col-md-12 nopadding">
          <div class="col-md-4 col-md-offset-4 pull-right nopadding">
            <div class="col-md-8 pull-right nopadding">
              <div class="form-group">
                <td><input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly/></td>
              </div>
            </div>
            <div class="col-md-3 pull-right">
              <div class="form-group">
                <label>Subtotal</label>
              </div>
            </div>
          </div>
        </div>
</body>
</html>

<script>

let initializeSelect2 =  function() {
  $('.js').select2();
}
var rowCount = 1;
  
  $('#add').click(function() {
    rowCount++;
    $('#orders').append('<tr id="row'+rowCount+'"><td><input class="form-control product_price" type="number" data-type="product_price" id="product_price_'+rowCount+'" name="product_price[]" for="'+rowCount+'"/></td><input class="form-control" type="hidden" data-type="product_id" id="product_id_'+rowCount+'" name="product_id[]" for="'+rowCount+'"/><td><input class="form-control quantity" type="number" class="quantity" id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'"/> </td><td><input class="form-control total_cost" type="text" id="total_cost_'+rowCount+'" name="total_cost[]"  for="'+rowCount+'" readonly/> </td><td><button type="button" name="remove" id="'+rowCount+'" class="btn btn-danger btn_remove cicle">-</button></td></tr>');
    initializeSelect2()

});

// Add a generic event listener for any change on quantity or price classed inputs
$("#orders").on('input', 'input.quantity,input.product_price', function() {
  getTotalCost($(this).attr("for"));
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
});

$(document).ready(function() {
    initializeSelect2()
});



// Using a new index rather than your global variable i
function getTotalCost(ind) {
  var qty = $('#quantity_'+ind).val();
  var price = $('#product_price_'+ind).val();
  var totNumber = (qty * price);
  var tot = totNumber.toFixed(2);
  $('#total_cost_'+ind).val(tot);
  calculateSubTotal();
}


</script>
   @endsection
