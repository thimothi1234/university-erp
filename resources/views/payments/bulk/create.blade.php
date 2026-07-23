@extends('project.admin_master')

@section('project')



<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('bulk.index')}}">Bulk Payments</a>
        <span class="breadcrumb-item active">Create</span>
      </nav>

                                <div class="row">
								<div class="col-lg-20">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Payment Bulk Voucher</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('bulk.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf

                    <div class="container">

                    <div class="row">
                      <div class="col-sm">
                      

                                
               

        </div> 
        </div>

    <div>
  

                                </div> 
                            
                            <div class="col-sm">
                          </div>
                    <input type="hidden"  name="vendor"  class="form-control" value="518"/>

                <div class="row">
                <div class="col-sm">
               

                <div>
          
                <label for="PFMS_SCHEME">PFMS scheme </label><br>
                    <select id="myselection" class="form-control js" name="pfms" required="required">
                        <option value="">--Select--</option>
                        @foreach($pfms_schemes as $pfms_scheme)
                    
                        <option value="{{$pfms_scheme->id}}">{{$pfms_scheme->name}}</option>
                        @endforeach

                    </select>


                </div>

                </div>
                 <div class="col-sm">

                <label for="po">PO/Contract / Agmt Number : </label><br>
                <input type="text"  name="po" size="103" class="form-control" placeholder="PO/Contract / Agmt Number"/>
                </div>
                   </div>

                <div>


                    <label for="Description">Description of Services Rendered :</label>
                    <br>
                    <input type="text"  name="narration" class="form-control" placeholder="Narration" pattern=".{100,}"   required title="Narrration should be breif atleast 100 characters minimum"/>
                    <input type="hidden" name="voucherno_bvrno" value="0">
                    <input type="hidden" name="chequeno" value="0">
                    <input type="hidden" name="status" value="1">

                </div>

                <div class="row">
                <div class="col-sm">
                <div>
                    <label for="Description">Description for Mail about this Transaction in brief:</label>
                    <br>
                    <input type="text"  name="mailmsg" class="form-control" placeholder="Description for Mail" pattern=".{50,}"   required title="Description should be breif atleast 50 characters minimum"/>
                </div>
                </div>

                
                <div class="col-sm">
              

<label for="Description">Gross Value</label>
<br>
<input type="text"  name="gross" class="form-control" placeholder="Voucher Gross Value" id="change" required="required"/>
</div>
</div>

  <div class="row">
                <div class="col-sm">
                <div>
                <label for="Description">Invoice Numbers (If multiple, separate them with commas.) </label>
                    <br>
                    <input type="text"  name="invno" class="form-control" placeholder="Invoice Numbers"    />
                </div>
                </div>
               
                <div class="col-sm">
                <label for="Description">Invoice Date (DD/MM/YYYY)</label>
                <br>
                <input type="text"  name="invdate" class="form-control" placeholder="Invoice Date (DD/MM/YYYY)"  />
                </div>
                </div>






                <br>
                <span id="mail_info">
 <input type="hidden" name="bank" class="form-control" value="" readonly>
  </span>
                <div>
                <table class="table-striped" id="orders">
                <tr>
                    <th scope="col"width="550" >Name of the Firm</th>
                    <!-- <th scope="col"width="250" >Name of the Vendor / supplier</th> -->
                    <th scope="col" width="100">Gross</th>
                    <th scope="col" width="100">Income Tax</th>
                    <th scope="col" width="100">Professional Tax</th>
                    <th scope="col" width="100">Net</th>
                    <th scope="col" width="150">Action</th>
                </tr>
                <tr>
                <td> <select name="addmore1[0][name]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach($bank_accounts as $bank_accounts) 
                    <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}---{{$bank_accounts->Account_Number}}---{{$bank_accounts->Bank_Name}}</option>
                    @endforeach
                </select></td>  

                <!-- <td> <select name="addmore1[0][vendor]" id="" class="form-control js">
                <option value="">--Please select one--</option>
                @foreach($bank_vends as $bank_accounts) 
                    <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}---{{$bank_accounts->Income_Tax}}</option>
                    @endforeach
                </select></td> -->


                <td><input class="form-control product_price" type="number" id='product_price_1' name="addmore1[0][gross]" placeholder="Gross"  for="1" required="required"/></td>  
                <td><input class="form-control quantity" type="number" id='quantity_1' name="addmore1[0][tds]" placeholder="Income Tax"  for="1" value="0" required="required"/></td>  
                <td><input class="form-control product_pricce" type="number" id='product_pricce_1' name="addmore1[0][ptax]" placeholder="Professional Tax" for="1" value="0" required="required"/></td>  
                <td>
                <input class="form-control total_cost" type="text" id="total_cost_1" name="addmore1[0][net]" for="1" readonly/></td>
                </td>  
                <td>
                <input type="number" style="width: 60px; display: inline-block;" min="1" max="100" class="form-control" id="jampa"/>
                <button type="button" name="add" id="add" class="btn btn-success" style="width: 10px; display: inline-block;">+</button>
                </td> </tr>
                </table>
                <table>
                <tr>
              <td scope="col"width="610" style="align:right">Totals</td>
              <td scope="col"width="120"><input class="form-control nett" type='text' id='nett' name='subtotal' readonly/></td>
              <td scope="col"width="120"><input class="form-control nett2" type='text' id='nett2' name='subtotal' readonly/></td>
              <td scope="col"width="120"><input class="form-control nett23" type='text' id='nett23' name='subtotal' readonly/></td>
                <td scope="col"width="120"> <input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly/></td></tr></table>



                <div>
                <table class="table-striped" id="dynamicTable12">
                <tr>
                <th scope="col"width="350" >Ledger</th>
                    <th scope="col" width="250">Budget Head</th>
                    <th scope="col" width="250">Sub-Head</th>
                    <th scope="col" width="90">Dr/Cr</th>
                    <th scope="col" width="150">Amount</th>
                    <th scope="col" width="10">Action</th>
                </tr>
                <tr>
                <td> <select name="addmore[0][ledger]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td> <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Project --</option>
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                </td>
                <td>  <select name="addmore[0][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Head --</option>
				    </select>
                  </td>
                        <td><select name="addmore[0][cr_dr]" id="" class="cr_dr form-control" required="required">
                        <option value="Dr">Dr</option>
                        <option value="Cr">Cr</option>
                        </select></td>  
                        <input type="hidden" value='0.5' name='addmore[0][banks]' >
                        <td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control nett" required="required"/></td>  

                        <td></td>  </tr>

                        <tr>
                <td> <select name="addmore[1][ledger]" id="" class="form-control js" required="required">
                <option value="">-- Select Ledger --</option>
                @foreach ($buas as $buas)
                    <option value="{{ $buas->id }}">{{ $buas->name }}</option>
                    @endforeach
                </select></td>  
                <td> <select name="addmore[1][costcentre]" class="costcentre form-control js" id="state" >
                <option value="224"></option>
                 
                 </select></td>
                 <td>  <select name="addmore[1][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Head --</option>
				    </select>
                  </td>
                          <td><select name="addmore[1][cr_dr]" id="" class="cr_dr form-control" >
                          <option value="Cr">Cr</option>
                          <option value="Dr">Dr</option>

                          </select></td>  
                          <input type="hidden" value='0' name='addmore[1][banks]' >
                          <td><input type="number" name="addmore[1][amount]" placeholder="Amount" class="txt form-control  nett2" readonly/></td>  

                          <td></td>  </tr>

                          <tr>
                <td> <select name="addmore[2][ledger]" id="" class="form-control js" >
                <option value="22">Professional Tax</option>
           
                </select></td>  
                <td> <select name="addmore[2][costcentre]" class="costcentre form-control js" id="state" >
                <option value="224"></option>
                  
                 </select></td>
                 <td>  <select name="addmore[2][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Head --</option>
				    </select>
                  </td>
                  <td><select name="addmore[2][cr_dr]" id="" class="cr_dr form-control" >
                  <option value="Cr">Cr</option>
                  <option value="Dr">Dr</option>

                  </select></td>  
                  <input type="hidden" value='0' name='addmore[2][banks]' >
                  <td><input type="number" name="addmore[2][amount]" placeholder="Amount" class="txt form-control nett23" readonly></td>  

                  <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>  </tr>
                  </div>
                  </table>
                </div>
                <div>
                <table class="table" id="dynamicTable">
                <tr>
                    <th scope="col" >Bank</th>
                    <th scope="col">Cr</th>
                    <th scope="col">Amount</th>
                </tr>




                <tr>
                <td> <select name="addmoreee[0][ledger]" id="" class="form-control js" onChange="getMailtype(this.value)" required="required">
                <option value="">--Please select Bank--</option>
                @foreach ($budss as $budss)
                <option value="{{$budss->id}}">{{$budss->name}}</option>
                @endforeach
                </select></td>  
                
                <td><select name="addmoreee[0][cr_dr]" id="" class="cr_dr form-control">

                <option value="Cr">Cr</option>

                </select>
                <input type="hidden" value='Payment' name='debit_credit' >
                </td>  

                <td><input type="hidden" value='NULL' name='addmoreee[0][costcentre]' >
                <input type="hidden" value='1' name='addmoreee[0][banks]' >
                    <input class="sum form-control" type="text" id="sum" name="addmoreee[0][amount]" value="0" readonly /></td>  
                <input type="hidden" value='Cr' name='amount' class="sum form-control">
                <td ></td></td>




                  </table>
                  <table class="table">
                  <tr>

                  <td colspan="2"></td>
                  <td width="25%">Credit<input class="sum form-control" type="text" id="sum" name="sum" value="0" readonly /></td>
                  <td width="25%">Debit
                      



                  <input class="sum form-control" type="text" id="sum" name="sum" value="0" readonly /></td>
                  <input type="hidden" value="{{ auth()->user()->id }}" name="entered" readonly>

                  </tr>
                  </table>

                </div>


                    <br>
                    <button type="submit" class="btn btn-primary">Save Voucher ✓</button>
  <a href="{{route('bulk.index')}}" class="btn btn-danger">Cancel X</a>
                  </form>
                  </div></div></div>
                      

                            
                      
                      </div>

                      <script>function getMailtype(value) {
  document.querySelector("#mail_info input").value = value;
}</script>
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

                  <script>


let initializeSelect23 =  function() {
  $('.js').select2();
}
var i = 4;
$("#add12").click(function(){
    ++i;
    $("#dynamicTable12").append('<tr><td><select  name="addmore['+i+'][ledger]" id="" class="form-control js" required="required"><option value="">--Please select one--</option>@foreach($bud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select id="state" class="costcentre form-control js" name="addmore['+i+'][costcentre]" required="required"><option value="">--select Project--</option>@foreach ($countrie as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td> <td> <select name="addmore['+i+'][sub]" class="sub form-control js" id="city'+i+'"><option>-- Select Head--</option></select></td><td><select name="addmore['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
   
    initializeSelect23()
});
$(document).on('click', '.remove-tr', function(){  
     $(this).parents('tr').remove();
}); 
$(document).ready(function() {
    initializeSelect23()
});




</script>





<script>

let initializeSelect2 =  function() {
  $('.js').select2();
}
var i = 1;


$('#add').click(function() {
  var numa = document.getElementById("jampa").value;
    for (var j = 0; j < numa; j++) {
        i++;
        $('#orders').append('<tr id="row'+i+'"><td><select name="addmore1['+
        i+'][name]" id="" class="form-control js" required="required"><option value="">--Please select--</option>@foreach($bank_accountss as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}---{{$iit_bank->Account_Number}}---{{$iit_bank->Bank_Name}}</option>@endforeach</select></td><td><input type="number" name="addmore1['+
        i+'][gross]" placeholder="Gross" class="form-control product_price" id="product_price_'+
        i+'" for="'+
        i+'" required="required"/></td> <td><input type="number" name="addmore1['+
        i+'][tds]" placeholder="Income Tax" id="quantity_'+
        i+'" class="form-control quantity" for="'+
        i+'" required="required" value="0"/></td><td><input type="number" name="addmore1['+
        i+'][ptax]" placeholder="Professional Tax" class="form-control product_pricce" id="product_pricce_'+
        i+'" for="'+
        i+'" required="required" value="0"/></td><td><input type="text" name="addmore1['+
        i+'][net]"  id="total_cost_'+
        i+'" class="form-control total_cost" for="'+
        i+'" readonly/></td><td><button type="button" class="btn btn-danger remove1-tr">x</button></td></tr>');
    }
    initializeSelect2();
});


// Add a generic event listener for any change on quantity or price classed inputs
$("#orders").on('input', 'input.quantity,input.product_price,input.product_pricce', function() {
  getTotalCost($(this).attr("for"));
});

$(document).on('click', '.remove1-tr', function(){  
     $(this).parents('tr').remove();
}); 

$(document).ready(function() {
    initializeSelect2()
});



// Using a new index rather than your global variable i
function getTotalCost(ind) {
  var qty = $('#quantity_'+ind).val();
  var price = $('#product_price_'+ind).val();
  var pricce = $('#product_pricce_'+ind).val();
  var totNumber = (price)-(qty)-(pricce);
  var tot = totNumber.toFixed(2);
  $('#total_cost_'+ind).val(tot);
  calculateSubTotal();
}

function calculateSubTotal() {
  var subtotal = 0;
  $('.total_cost').each(function() {
     subtotal += parseFloat($(this).val());
  });
  $('#subtotal').val(subtotal);
}

</script>
<script>

function sumIt1() {
  var total = 0, val;
  $('.product_price').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('.nett').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","product_price").val(0))
      .before("<br/>");
    sumIt1();  
  });


  $(document).on('input', '.product_price', sumIt1);
  sumIt1() // run when loading
})

</script>

<script>

function sumIt12() {
  var total = 0, val;
  $('.quantity').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('.nett2').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","quantity").val(0))
      .before("<br/>");
    sumIt12();  
  });


  $(document).on('input', '.quantity', sumIt12);
  sumIt12() // run when loading
})

</script>
<script>

function sumIt123() {
  var total = 0, val;
  $('.product_pricce').each(function() {
    val = $(this).val();
    val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
    total += val;
  });
  
  $('.nett23').val(Math.round(total));
}

$(function() {

  // $('.datepicker').datepicker(); // not needed for this test


  $("#add").on("click", function() {
    $("#container input").last()
      .before($("<input />").prop("class","product_pricce").val(0))
      .before("<br/>");
    sumIt123();  
  });


  $(document).on('input', '.product_pricce', sumIt123);
  sumIt123() // run when loading
})

</script>





    <script>
      const calculateSum = function() {
        var sum1 = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
            let val = isNaN(this.value) || this.value.trim().length === 0 ? 0 : +this.value; // cast to number
            const drcr = $(this).closest("tr").find("[class^=cr_dr]").val(); // name begins with cr_dr
            sum1 += val * (drcr === "Dr" ? 1 : -1); // ternary based on the value
            $(this).toggleClass("neg", drcr === "Dr"); // remove if you do not want this
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $(".sum")
            .val(sum1)
            .toggleClass("neg", sum1 < 0); // remove if you do not want this

    }

    $(function() {
        $(".txt").on("input",  this, calculateSum);
        $(".quantity").on("input",  this, calculateSum);
        $(".product_price_").on("input",  this, calculateSum);
        $(".product_pricce_").on("input",  this, calculateSum);
        
        $("select").on("change",  this, calculateSum);
        
        
        
    });
    $(function() {

// $('.datepicker').datepicker(); // not needed for this test


$("#add").on("click", function() {
  $("#container input").last()
    .before($("<input />").prop("class","txt").val(0))
    .before("<br/>");
    $("#container select").last()
    .before($("<select />").prop("class","cr_dr").val(0))
    .before("<br/>");
    calculateSum();  
});


$(document).on('input', '.txt', calculateSum);
$(document).on('input', '.quantity', calculateSum);
$(document).on('input', '.product_price', calculateSum);
$(document).on('input', '.product_pricce', calculateSum);
$(document).on('change', '.cr_dr', calculateSum);
calculateSum() // run when loading
})


$('body').on('DOMNodeInserted', 'select', function () {
    $(this).select2();
});

  
    </script>
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



   @endsection
