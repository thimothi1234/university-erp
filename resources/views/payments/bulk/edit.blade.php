@extends('project.admin_master')

@section('project')




<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Payments</a>
        <span class="breadcrumb-item active">Create</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Payment Bulk Voucher Edit</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('bulk.update',$user->id)}}" method="POST" enctype="multipart/form-data">
         
            {{ csrf_field() }}
        {{ method_field('PATCH') }} 


  <div class="container">

  <div class="row">
    <div class="col-sm">
    

              
     

        </div> 
        </div>
    <div class="col-sm">

        <!-- <div class="frmDronpDown" id="ghgh">
            <label>Sub Head:</label><br />
             <select name="city" class="form-control" id="city">
				    </select>
        
    </div> -->
<!-- 
    </div> -->
  </div>
                              
             



                <div class="row">
    <div class="col-sm">
    

                <div>
                <label for="PFMS_SCHEME">PFMS scheme </label><br>
                    <select id="myselection" class="form-control js" name="pfms" required="required">
                    <option value="{{$user->pfms}}">{{$user->pffms->name}}</option>
                        @foreach($pfms_schemes as $pfms_scheme)
                    
                        <option value="{{$pfms_scheme->id}}">{{$pfms_scheme->name}}</option>
                        @endforeach

                    </select>


                </div>

                </div>
    <div class="col-sm">

                <label for="po">PO/Contract / Agmt Number : </label><br>
                <input type="text"  name="po" size="103" class="form-control" value="{{$user->po}}"/>
                </div>
  </div>

                <div>


                    <label for="Description">Description of Services Rendered :</label>
                    <br>
                    <input type="text"  name="narration" class="form-control" value="{{$user->narration}}" pattern=".{100,}"   required title="Narrration should be breif atleast 100 characters minimum"/>
                   
                   
                   
                  

                </div>
                

                <div class="row">
                <div class="col-sm">
                <div>
                <label for="Description">Description for Mail about this Transaction in brief:</label>
                    <br>
                    <input type="text"  name="mailmsg" class="form-control" value="{{$user->mailmsg}}" pattern=".{50,}"   required title="Description should be breif atleast 50 characters minimum"/>
                </div>
                </div>
                <input type="hidden" value='Payment' name='debit_credit' >
                <div class="col-sm">
                <label for="Description">Gross Value</label>
                <br>
                <input type="text"  name="gross" class="form-control" value="{{$user->gross}}" id="change" required/>
                </div>
                </div>

  <div class="row">
                <div class="col-sm">
                <div>
                <label for="Description">Invoice Numbers (If multiple, separate them with commas.) </label>
                    <br>
                    <input type="text"  name="invno" class="form-control" value="{{$user->invno}}" placeholder="Invoice Numbers"    />
                </div>
                </div>
               
                <div class="col-sm">
                <label for="Description">Invoice Date (DD/MM/YYYY)</label>
                <br>
                <input type="text"  name="invdate" class="form-control" value="{{$user->invdate}}" placeholder="Invoice Date (DD/MM/YYYY)" />
                </div>
                </div>








                <br>
                <span id="mail_info">
 <input type="hidden" name="bank" class="form-control" value="{{$user->bank}}" readonly>
  </span>

                
                <table class="table" id="orders">
                <tr>
                    <th scope="col"width="500" >Vendor</th>
                    <th scope="col" width="125">Gross</th>
                    <th scope="col" width="125">Income Tax</th>
                    <th scope="col" width="125">Professional Tax</th>
                    <th scope="col" width="125">Net</th>
                </tr>


@foreach($bulk as $bullk)

                <tr>
                <td style="display:none;"><input type="text" name="addmore11[{{$bullk->id}}][id]" value="{{$bullk->id}}" class="form-control"/></td> 
                <td> <select name="addmore11[{{$bullk->id}}][name]" id="" class="form-control js" required="required">
                <option value="{{$bullk->name}}">{{$bullk->vendors->name}}</option>
              @foreach($bank_accounts as $bbkk )
              <option value="{{$bbkk->id}}">{{$bbkk->name}}</option>
              @endforeach
                </select></td>  
                <td><input class="form-control product_price" type="number" id='product_price_{{ $loop->iteration }}' name="addmore11[{{$bullk->id}}][gross]" value="{{$bullk->gross}}"  for="{{ $loop->iteration }}" required="required"/></td>  
                <td><input class="form-control quantity" type="number" id='quantity_{{ $loop->iteration }}' name="addmore11[{{$bullk->id}}][tds]" value="{{$bullk->tds}}"  for="{{ $loop->iteration }}" required="required"/></td>  
                <td><input class="form-control product_pricce" type="number" id='product_pricce_{{ $loop->iteration }}' name="addmore11[{{$bullk->id}}][ptax]" value="{{$bullk->ptax}}" for="{{ $loop->iteration }}" required="required"/></td>  
<td>
<input class="form-control total_cost" type="text" id="total_cost_{{ $loop->iteration }}" name="addmore11[{{$bullk->id}}][net]" for="{{ $loop->iteration }}" value="{{$bullk->gross-$bullk->tds-$bullk->ptax}}" readonly/></td>
</td>  




 </tr>


@endforeach
<tr>
<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td> </tr>
</table>
<table>

<tr>

                
              <td scope="col"width="630" style="text-align: right"><b>Totals</b></td>
              <td scope="col"width="130"><input class="form-control nett1" type='text' id='nett1' name='subtotal' readonly/></td>
              <td scope="col"width="130"><input class="form-control nett2" type='text' id='nett2' name='subtotal' readonly/></td>
              <td scope="col"width="120"><input class="form-control nett3" type='text' id='nett3' name='subtotal' readonly/></td>
                <td scope="col"width="120"> <input class="form-control subtotal" type='text' id='subtotal' name='subtotal' value="{{$bulk->sum('net')}}" readonly/></td></tr></table>

                <div>
              <table class="table-striped" id="dynamicTable12">
                <tr>
                    <th scope="col"width="350" >Ledger</th>
                    <th scope="col" width="270">Project</th>
                    <th scope="col" width="250">Head</th>
                    <th scope="col" width="90">Dr/Cr</th>
                    <th scope="col" width="150">Amount</th>
               
                </tr>

                <?php 
                $i = 1;
                ?>
                @foreach ($ledger as $ledger)



                <tr><td style="display:none;"><input type="text" name="addmore[{{$ledger->id}}][id]" value="{{$ledger->id}}" class="form-control"/></td>  
                <td> <select name="addmore[{{$ledger->id}}][ledger]" id="" class="form-control js" required="required">
                  @if($ledger->ledger== '')
                  @else
                <option value="{{$ledger->ledger}}">{{$ledger->ledgers->name}}</option>
                @endif
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td>  <select name="addmore[{{$ledger->id}}][costcentre]" class="costcentre form-control js" id="state" required="required">
                @if($ledger->ledger== '')
                  @else
                <option value="{{$ledger->costcentre}}">{{$ledger->costcentres->name}}</option>
                @endif
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                 </td>
                  <td>  <select name="addmore[{{$ledger->id}}][sub]" class="sub form-control js" id="city0">
                  @if($ledger->sub == 0)
                        <option value="0">Does Not Exists</option>  
                        @else
                    <option value="{{$ledger->sub}}">{{$ledger->subs->head}}</option>
                    @endif
                    <?php $raj = \App\Models\project_head::all()->where('project_id',$ledger->costcentre)->whereNotIn('id',$ledger->sub)->all()  ?>
                    @foreach ($raj as $raa)
                    <option value="{{$raa->id}}">{{ $raa->head }}</option>

                    @endforeach
                    
                    
				    </select>
                  </td>
                    <td>
                    <select name="addmore[{{$ledger->id}}][cr_dr]" id="cr_dr" class="cr_dr form-control">
                    <option value="{{$ledger->cr_dr}}">{{$ledger->cr_dr}}</option>
                        @if($ledger->cr_dr == 'Cr')
                        <option value="Dr">Dr</option>
                        @else
                        <option value="Cr">Cr</option>
                        @endif
                    </select></td>  <input type="hidden" value='0' name='addmore[{{$ledger->id}}][banks]' >
                 
                    <td><input type="number" name="addmore[{{$ledger->id}}][amount]" value="{{$ledger->amount}}" class="txt form-control nett{{ $i++ }}" /></td>  </tr>

                    @endforeach   <tr>    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td> 

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
                <td style="display:none;"><input type="HIDDEN" name="addmoreee[0][id]" value="{{$ledgerr->id}}" class="form-control" required="required"/></td>  
                <td> <select name="addmoreee[0][ledger]" id="" class="form-control js" onChange="getMailtype(this.value)"  required="required">
                <option value="{{$ledgerr->ledger}}">{{$ledgerr->ledgers->name}}</option>
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


</tr>
</table>

                </div>

   <br>
  <button type="submit" class="btn btn-primary">Save Voucher ✓</button>
  <a href="{{route('bulk.index')}}" class="btn btn-danger">Cancel X</a>
</form>
</div></div></div>
    

           
     
    </div></div>
   
    <script>function getMailtype(value) {
  document.querySelector("#mail_info input").value = value;
}</script>

    <script>


let initializeSelect23 =  function() {
  $('.js').select2();
}
var i = 3;
$("#add12").click(function(){
    ++i;
    $("#dynamicTable12").append('<tr><td><select  name="addmoreo['+i+'][ledger]" id="" class="form-control js" required="required"><option value="">--Please select one--</option>@foreach($bud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select id="state" class="costcentre form-control js" name="addmoreo['+i+'][costcentre]" required="required"><option value="">--select Project--</option>@foreach ($countrie as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td> <td> <select name="addmoreo['+i+'][sub]" class="sub form-control js" id="city'+i+'"><option>-- Select Head--</option></select></td><td><select name="addmoreo['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmoreo['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
   
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
var i = {{$bullk->count()}};
  
  $('#add').click(function() {
    i++;
    $('#orders').append('<tr id="row'+i+'"><td><select name="addmore1['+i+'][name]" id="" class="form-control js" required="required"><option value="">--Please select--</option>@foreach($bank_accountss as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach<</select></td><td><input type="number" name="addmore1['+i+'][gross]" placeholder="Gross" class="form-control product_price" id="product_price_'+i+'" for="'+i+'" required="required"/></td> <td><input type="number" name="addmore1['+i+'][tds]" placeholder="Income Tax" id="quantity_'+i+'" class="form-control quantity" for="'+i+'" required="required"/></td><td><input type="number" name="addmore1['+i+'][ptax]" placeholder="Professional Tax" class="form-control product_pricce" id="product_pricce_'+i+'" for="'+i+'" required="required"/></td><td><input type="text" name="addmore1['+i+'][net]"  id="total_cost_'+i+'" class="form-control total_cost" for="'+i+'" readonly/></td><td><button type="button" class="btn btn-danger remove1-tr">X</button></td></tr>');
    initializeSelect2()
    
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
  
  $('.nett1').val(Math.round(total));
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
  
  $('.nett3').val(Math.round(total));
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
        $(".total_cost").on("input",  this, calculateSum);
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
$(document).on('input', '.total_cost', calculateSum);
$(document).on('change', '.cr_dr', calculateSum);
calculateSum() // run when loading
})


$('body').on('DOMNodeInserted', 'select', function () {
    $(this).select2();
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
