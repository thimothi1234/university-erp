@extends('project.admin_master')

@section('project')




<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Advance</a>
        <span class="breadcrumb-item active">Settle</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Advance Voucher Settle</h4>
										</div>
										<div class="card-body">
                                        <form action="{{url('settlepost')}}" method="POST" enctype="multipart/form-data">
         
            {{ csrf_field() }}
        {{ method_field('POST') }} 


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
                    <input type="text"  name="narration" class="form-control" placeholder="Narration"  pattern=".{100,}"   required title="Narrration should be breif atleast 100 characters minimum"/>
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
<input type="text"  name="gross" class="form-control" placeholder="Voucher Gross Value" id="change" required/>
</div>
</div>
                <br>
                <span id="mail_info">
 <input type="hidden" name="bank" class="form-control" value="" readonly>
  </span>
                <div>






                <table class="table-striped" id="dynamicTable12">
                <tr>
                    <th scope="col"width="350" >Ledger</th>
                    <th scope="col" width="270">Project</th>
                    <th scope="col" width="250">Head</th>
                    <th scope="col" width="90">Dr/Cr</th>
                    <th scope="col" width="150">Amount</th>
               
                </tr>

      



                <tr>
                <td> <select name="addmore[0][ledger]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td>  <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
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
                    <option value="">----</option>
                    <option value="Dr">Dr</option>
                    <option value="Cr">Cr</option>
                    </select></td>  
                 
                    <td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control" required="required"/></td>  
                    <input type="hidden" name="addmore[0][banks]" value="0.5"/>

                    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>  </tr>

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
                <td> <select name="addmoreee[0][ledger]" id="" class="form-control js" onChange="getMailtype(this.value)" required="required">
                <option value="">---Please Select---</option>
                @foreach ($budss as $budss)
                <option value="{{$budss->id}}">{{$budss->name}}</option>
                @endforeach
                </select></td>  
                
<td><select name="addmoreee[0][cr_dr]" id="" class="cr_dr form-control">

<option value="Cr">Cr</option>

</select>
<input type="hidden" value='Advance Settlement' name='debit_credit' >
<input type="hidden" value='{{$id}}' name='project' >
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
                    <select name="addmore[${i}][ledger]" class="form-control js" required>
                        <option value="">--Please select one--</option>
                        @foreach($bud as $iit_bank)
                            <option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="addmore[${i}][costcentre]" class="costcentre form-control js" required>
                        <option value="">--select Budget-head--</option>
                        @foreach ($countrie as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="addmore[${i}][sub]" class="sub form-control js" id="city${i}">
                        <option value="0">-- Select Sub-head--</option>
                    </select>
                </td>
                <td>
                    <select name="addmore[${i}][cr_dr]" class="cr_dr form-control" required>
                        <option value="">--select--</option>
                        <option value="Dr">Dr</option>
                        <option value="Cr">Cr</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="addmore[${i}][amount]" placeholder="Amount" class="txt form-control" required />
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
