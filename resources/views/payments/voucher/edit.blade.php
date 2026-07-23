@extends('project.admin_master')

@section('project')


<style>
  /* Ensure consistent column widths */
  .fixed-width-ledger { width: 350px; }
  .fixed-width-project { width: 270px; }
  .fixed-width-head { width: 250px; }
  .fixed-width-dr-cr { width: 90px; }
  .fixed-width-amount { width: 150px; }
</style>

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
											<h4>Payment Voucher Edit</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('voucher.update',$user->id)}}" method="POST" enctype="multipart/form-data">
         
            {{ csrf_field() }}
        {{ method_field('PATCH') }} 


  <div class="container">
 
  
           


  

  <div class="row">
    <div class="col-sm">
    

              
    

        </div> 
        </div>



    <div>
  

                            
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
                              
                <div>

                    <label for="name">Name of the Firm / Person : on whom Cash/DD/Cheque/RTGS/NEFT to be drawn. </label><br>
                    <select  name="vendor" class="form-control js" required="required">
                    <option value="{{$user->vendor}}">{{$user->vendors->name}}</option>
                        @foreach($bank_accounts as $bank_accounts)
                    
                        <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}</option>
                        @endforeach

                    </select>

                </div>
                <div>
                    <label for="namee">Name of the Vendor / supplier</label><br>
                    <select  name="namee" class="form-control js">
                    <option value="{{$user->namee}}">{{$user->vendorss->name}}</option>
                        @foreach($bank_accountss as $bank_accounts)
                        <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}---{{$bank_accounts->Income_Tax}}</option>
                        @endforeach
                    </select>
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


                    <label for="Description">Narrration of Services Rendered :</label>
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
                <input type="text"  name="invdate" class="form-control" value="{{$user->invdate}}" placeholder="Invoice Date (DD/MM/YYYY)"  />
                </div>
                </div>





                <br>
                <span id="mail_info">
                <input type="hidden" name="bank" class="form-control" value="{{$user->bank}}" readonly>
                </span>
                <div>

                <table class="table-striped" id="dynamicTable12" style="table-layout: fixed; width: 100%;">
                <tr>
                    <th scope="col" class="fixed-width-ledger">Ledger</th>
                    <th scope="col" class="fixed-width-project">Project</th>
                    <th scope="col" class="fixed-width-head">Head</th>
                    <th scope="col" class="fixed-width-dr-cr">Dr/Cr</th>
                    <th scope="col" class="fixed-width-amount">Amount</th>
                </tr>

                @foreach ($ledger as $ledger)
                <tr><td style="display:none;"><input type="text" name="addmore[{{$ledger->id}}][id]" value="{{$ledger->id}}" class="form-control"/></td>  
                <td> <select name="addmore[{{$ledger->id}}][ledger]" id="" class="form-control js" required="required">
                <option value="{{$ledger->ledger}}">{{$ledger->ledgers->name}}</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td>  <select name="addmore[{{$ledger->id}}][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="{{$ledger->costcentre}}">{{$ledger->costcentres->name}}</option>
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
                 
                    <td><input type="number" name="addmore[{{$ledger->id}}][amount]" value="{{$ledger->amount}}" class="txt form-control" required="required"/></td>  </tr>

                    @endforeach   <tr>    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td> 

</table>
<table class="table">
<tr>

<td colspan="3"></td>
<td width="25%"></td>

</tr>
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
                <a href="{{route('voucher.index')}}" class="btn btn-danger">Cancel X</a>
</form>
</div></div></div>
    

           
     
    </div></div>
    <script>function getMailtype(value) {
  document.querySelector("#mail_info input").value = value;
}</script> 

<script>
    // Function to initialize Select2 for all `.js` elements
    let initializeSelect2 = function() {
        $('.js').select2({
            width: '100%' // Ensure the select2 dropdown spans the entire width of the container
        });
    };

    // Counter for dynamic rows
    var i = 0;

    // Add new row on button click
    $("#add12").click(function() {
        ++i; // Increment counter
        // Append new row to the table
        $("#dynamicTable12").append(`
            <tr>
                <td>
                    <select name="addmor[${i}][ledger]" class="form-control js" required>
                        <option value="">--Please select one--</option>
                        @foreach($bud as $iit_bank)
                            <option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="addmor[${i}][costcentre]" class="costcentre form-control js" required>
                        <option value="">--select Budget-head--</option>
                        @foreach ($countrie as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="addmor[${i}][sub]" class="sub form-control js" id="city${i}">
                        <option value="0">-- Select Sub-head--</option>
                    </select>
                </td>
                <td>
                    <select name="addmor[${i}][cr_dr]" class="cr_dr form-control" required>
                        <option value="">--select--</option>
                        <option value="Dr">Dr</option>
                        <option value="Cr">Cr</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="addmor[${i}][amount]" placeholder="Amount" class="txt form-control" required />
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-tr">x</button>
                </td>
            </tr>
        `);

        // Re-initialize select2 for new elements
        initializeSelect2();
    });

    // Remove row on button click
    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });

    // Initialize Select2 on page load
    $(document).ready(function() {
        initializeSelect2();
    });
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
