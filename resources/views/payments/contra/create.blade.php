@extends('project.admin_master')

@section('project')




<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('contra.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('contra.index')}}">Contra</a>
        <span class="breadcrumb-item active">Create</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Contra Voucher</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('contra.store')}}" method="POST" enctype="multipart/form-data">
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
                              
                <div>

                    <label for="name">Name of the Firm / Person : on whom Cash/DD/Cheque/RTGS/NEFT to be drawn </label><br>
                    <select  name="vendor" class="form-control js" required="required">
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
                <br>

                <div>
                <table class="table" id="dynamicTable12">
                <tr>
                    <th scope="col"width="700" >Ledger</th>
                  
                    <th scope="col" width="100">Dr/Cr</th>
                    <th scope="col" width="200">Amount</th>
                </tr>




                <tr>
                <td> <select name="addmore[0][ledger]" id="" class="form-control js" required="required">
                <option value="">--Please select one--</option>
                @foreach ($bud as $buds)
                <option value="{{$buds->id}}">{{$buds->name}}</option>
                @endforeach
                </select></td>  
                <input type ="hidden" id="bank" class="form-control js" name="addmore[0][costcentre]" value="NULL" />

<td><select name="addmore[0][cr_dr]" id="" class="cr_dr form-control" required="required">
<option value="">----</option>
<option value="Dr">Dr</option>
<option value="Cr">Cr</option>
</select></td>  
<input type="hidden" value='0' name='addmore[0][banks]' >
<td><input type="number" name="addmore[0][amount]" placeholder="Amount" class="txt form-control" required="required"/></td>  

<td><button type="button" name="add" id="add12" class="btn btn-success">Add More</button></td>  </tr>





                </div>

             
                
                <div>
                <table class="table" id="dynamicTable">
                <tr>
                <th scope="col"width="700" >Ledger</th>
         
                    <th scope="col" width="100">Dr/Cr</th>
                    <th scope="col" width="200">Amount</th>
                </tr>




                <tr>
                <td> <select name="addmoreee[0][ledger]" id="" class="form-control js" required="required">
                <option value="">--Please select Bank--</option>
                @foreach ($budss as $budss)
                <option value="{{$budss->id}}">{{$budss->name}}</option>
                @endforeach
                </select></td>  
                


<input type ="hidden" id="bank" class="form-control js" name="addmoreee[0][costcentre]" value="NULL" />
                        
<td><select name="addmoreee[0][cr_dr]" id="" class="cr_dr form-control">
<option value="Cr">Cr</option>
</select>
<input type="hidden" value='Contra' name='debit_credit' >
</td>  <td>
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
  <a href="{{route('contra.index')}}" class="btn btn-danger">Cancel X</a>
</form>
</div></div></div>
    

           
     
    </div></div>
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

<script>


let initializeSelect2 =  function() {
  $('.js').select2();
}

var i = 0;
$("#add12").click(function(){
    ++i;
    $("#dynamicTable12").append('<tr><td><select name="addmore['+i+'][ledger]" id="" class="form-control js" required="required"><option value="">--Please select--</option>@foreach($bud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td> <td> <select id="bank" class="form-control js" name="addmore['+i+'][costcentre]" required="required"><option value="">--select--</option>@foreach($buud as $iit_bank)<option value="{{$iit_bank->id}}">{{$iit_bank->name}}</option>@endforeach</select></td><td><select name="addmore['+i+'][cr_dr]" id="" class="cr_dr form-control" required="required"><option value="">--select--</option><option value="Dr">Dr</option><option value="Cr">Cr</option></select></td><td><input type="number" name="addmore['+i+'][amount]" placeholder="Amount" class="txt form-control" required="required"/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    
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


<script>
        $(document).ready(function(){

            // Initialize select2
            initailizeSelect2();

            // Add <select > element
            $('.add').click(function(){
                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {request: 2},
                    success: function(response){

                        // Append element
                        $('#elements').append(response);

                        // Initialize select2
                        initailizeSelect2();
                    }
                });
            });
            
        });

        // Initialize select2
        function initailizeSelect2(){

            $(".select2_el").select2({
                ajax: {
                    url: "ajaxfile.php",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        </script>
    

   @endsection
