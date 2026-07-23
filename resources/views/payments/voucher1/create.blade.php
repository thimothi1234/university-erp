@extends('project.admin_master')

@section('project')

<style>

#change::-webkit-input-placeholder {
    /* WebKit, Blink, Edge */
    color: #FF0000;
}
#change:-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    color: #FF0000;
    opacity: 1;
}
#change::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    color: #FF0000;
    opacity: 1;
}
#change:-ms-input-placeholder {
    /* Internet Explorer 10-11 */
    color: #FF0000;
}

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
											<h4>Payment Voucher</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('voucher.store')}}" method="POST" enctype="multipart/form-data">
            @csrf



                            <div class="container">
                            <div class="row">
                                <div class="col-sm">

                                <div>
                    <label for="name">Type of voucher </label><br>
                    <select  name="debit_credit" class="form-control js" required="required">
                    <option value="">--Select--</option>
                    <option value="Payment">Payment</option>
                    <option value="Advance">Advance</option>
                    <option value="Advance Settlement">Advance Settlement</option>
                    <option value="commitment">Commitment</option>
                    <option value="Receipt">Receipt</option>
                    <option value="Contra">Contra</option>
                    <option value="Journal">Journal</option>
                    
                    </select>
                </div> 
                        <div>
                    <label for="name">Name of the Firm / Person : on whom Cash/DD/Cheque/RTGS/NEFT to be drawn </label><br>
                    <select  name="vendor" class="form-control js" required="required">
                    <option value="">--Select--</option>
                        @foreach($bank_accounts as $bank_accounts)
                        <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}---{{$bank_accounts->Account_Number}}---{{$bank_accounts->Bank_Name}}</option>
                        @endforeach
                    </select>
                </div>         
              
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


                    <label for="Description">Narration of Services Rendered :</label>
                    <br>
                    <input type="text"  name="narration" class="form-control" placeholder="Narration for Tally" pattern=".{100,}"   required title="Narrration should be breif atleast 100 characters minimum"/>
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
                <input type="hidden" value='Payment' name='debit_credit' >
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
                    <th scope="col" width="250">Budget-head</th>
                    <th scope="col" width="250">Sub-head</th>
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
                <td>  <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Budget-head --</option>
                   @foreach ($countries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                 </select>
                 </td>
                  <td> 
                  <select name="addmore[0][sub]" class="sub form-control js" id="city0">
                  <option value="">-- Select Sub-head --</option>
				    </select>
                  </td>
                    <td><select name="addmore[0][cr_dr]" id="" class="cr_dr form-control" required="required">
                    <option value="">----</option>
                    <option value="Dr">Dr</option>
                    <option value="Cr">Cr</option>
                    </select></td>  
                 
                    <td><input type="number" name="addmore[0][amount]" placeholder="Taxable Value" class="txt form-control" required="required" id="change"/></td>  
                    <input type="hidden" name="addmore[0][banks]" value="0.5"/>
                    <td><button type="button" name="add" id="add12" class="btn btn-success">+</button></td>  </tr>
                </div>

                <div>
                <table class="table-striped" id="dynamicTable">
                <tr>
                
                <th scope="col"width="850" >Bank</th>
                   
                    <th scope="col" width="90">Cr</th>
                    <th scope="col" width="200">Amount</th>
                    <th scope="col" width="10"></th>    
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
                
                </td> 
                <td><input type="hidden" value='NULL' name='addmoreee[0][costcentre]' >
                <input type="hidden" value='1' name='addmoreee[0][banks]' >
                    <input class="sum form-control" type="text" id="sum" name="addmoreee[0][amount]" value="0" readonly /></td>  
                <input type="hidden" value='Cr' name='amount' class="sum form-control">
                <td ></td></td>
                </table>
                <table class="table-striped">
                <tr>
                <td colspan="2" width="70%"></td>
                <td width="15%">Credit<input class="sum form-control" type="text" id="sum" name="sum" value="0" readonly /></td>
                <td width="20%">Debit
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
                        }
                        </script>
                    <script>


                    let initializeSelect2 =  function() {
                    $('.js').select2();
                    }

                    var i = 0;
                    $("#add12").click(function(){
                        ++i;
                        $("#dynamicTable12").append('<tr><td><select  name="addmore['+i+'][ledger]" id="" class="form-control js" required="required"><option value="">--Please select one--</option>@foreach($bud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select id="state" class="costcentre form-control js" name="addmore['+i+'][costcentre]" required="required"><option value="">--select Budget-head--</option>@foreach ($countrie as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select></td> <td> <select name="addmore['+i+'][sub]" class="sub form-control js" id="city'+i+'"><option value="0">-- Select Sub-head--</option></select></td><td><select name="addmore['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">x</button></td></tr>');
                        initializeSelect2()
                    });
                    $(document).on('click', '.remove-tr', function(){  
                        $(this).parents('tr').remove();
                    }); 
                    $(document).ready(function() {
                        initializeSelect2()
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
