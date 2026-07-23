@extends('project.admin_master')

@section('project')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyhead</a>
        <span class="breadcrumb-item active">Insert</span>
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
    

              
            <label>Project:</label><br /> 
             <select name="project" class="form-control" id="state" required="required">
				    	<option value="">-- Select Project --</option>
				    	@foreach ($states as $state)
				    		<option value="{{ $state->id }}">{{ ucfirst($state->name) }}</option>
				    	@endforeach
				    </select>

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
                              
                <div>

                    <label for="name">Name of the Firm / Person : on whom Cash/DD/Cheque/RTGS/NEFT to be drawn. </label><br>
                    <select  name="vendor" class="form-control" required="required">
                    <option value="">--Select--</option>
                        @foreach($bank_accounts as $bank_accounts)
                    
                        <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}</option>
                        @endforeach

                    </select>

                </div>



                <div class="row">
    <div class="col-sm">
    

                <div>
                <label for="PFMS_SCHEME">PFMS scheme </label><br>
                    <select id="myselection" class="form-control" name="pfms" required="required">
                        <option value="">--Select--</option>
                        @foreach($pfms_schemes as $pfms_scheme)
                    
                        <option value="{{$pfms_scheme->id}}">{{$pfms_scheme->name}}</option>
                        @endforeach

                    </select>


                </div>

                </div>
    <div class="col-sm">

                <label for="po">PO/Contract / Agmt Number : </label><br>
                <input type="text"  name="pod" size="103" class="form-control" placeholder="PO/Contract / Agmt Number"/>
                </div>
  </div>

                <div>


                    <label for="Description">Description of Services Rendered :</label>
                    <br>
                    <input type="text"  name="narration" class="form-control" placeholder="Narration" pattern=".{100,}"   required title="Narrration should be breif atleast 100 characters minimum"/>
                    <input type="hidden" name="voucherno_bvrno" value="0">
                    <input type="hidden" name="chequeno" value="0">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="transactiondate" value="0">

                </div>
                <br>

                <div>
                <table class="table" id="dynamicTable">
                <tr>
                    <th scope="col"width="350" >Ledger</th>
                    <th scope="col" width="350">Costcentre</th>
                    <th scope="col" width="100">Dr/Cr</th>
                    <th scope="col" width="200">Amount</th>
                </tr>




                <tr>
                <td> <select name="addmore[0][ledger]" id="" class="form-control" required="required">
                <option value="">--Please select--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <td> <select id="bank" class="form-control" name="addmore[0][costcentre]" required="required">
                        <option value="">--select--</option>
                        @foreach($buud as $iit_bank)
                        <option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>
                        @endforeach
                    </select></td>
<td><select name="addmore[0][cr_dr]" id="" class="cr_dr form-control" required="required">
<option value="">----</option>
<option value="Dr">Dr</option>
<option value="Cr">Cr</option>
</select></td>  
<input type="hidden" value='0' name='addmore[0][banks]' >
<td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control" required="required"/></td>  

<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  </tr>




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
                <td> <select name="addmoreee[0][ledger]" id="" class="form-control" required="required">
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
  <button type="submit" class="btn btn-primary">Save Voucher</button>
</form>
</div></div></div>
    

           
     
    </div></div>
    <script type="text/javascript">

   

    var i = 0;

       

    $("#add").click(function(){

   

        ++i;

   

        $("#dynamicTable").append('<tr><td><select name="addmore['+i+'][ledger]" id="" class="form-control" required="required"><option value="">--Please select--</option>@foreach ($bud as $buds)<option value="{{$buds->id}}">{{$buds->name}}</option>@endforeach</select></td> <td> <select id="bank" class="form-control" name="addmore['+i+'][costcentre]" required="required"><option value="">--select--</option>@foreach($buud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td><td><select name="addmore['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');});

   

    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  

   

</script>






<!-- <script>
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
                        $('select[name="city"]').append('<option value="'+ key +'">' + value.name+ '</option>');
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
    </script> -->

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




  
    </script>
    

   @endsection
