@extends('project.admin_master')

@section('project')
<style>
    input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 10px;
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
											<h4>Payroll Voucher</h4>
										</div>
										<div class="card-body">
                                        <form action="{{route('voucher.store')}}" method="POST" enctype="multipart/form-data">
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
                              
                
<table>
    <tr>
        <td width="500px"><div class="col-sm">

<label for="po">HRA %: </label><br>
<input type="text"  name="hra" id="hra" class="form-control" value="{{$b->HRA}}" readonly/>
</div></td>
        <td width="500px"><div class="col-sm">

<label for="po">DA %: </label><br>
<input type="text"  name="da" id="da"  class="form-control" value="{{$b->DA}}" readonly/>
</div></td>
    </tr>
<tr>
     <td>

                
    <div class="col-sm">
    

                <div>
                <label for="PFMS_SCHEME">Pay level </label><br>
                <select name="addmore[0][costcentre]" class="costcentre form-control js" id="state" required="required">
                <option value="">-- Select Pay Level --</option>
                @foreach ($payorders as $key)
                    <option value="{{ $key }}">{{ $key }}</option>
                    @endforeach
                 </select>


             

                </div>
                </td> <td>
                
    <div class="col-sm">
    

                <div>
                <label for="PFMS_SCHEME">Basic </label><br>
                <select name="addmore[0][sub]" class="sub form-control js" id="basic">
                  <option value="">-- Select basic --</option>
				    </select>


              

                </div>
                </td>
           
            </tr>
                <tr>

<td colspan="2" width="1000px"><div>

<label for="name">Name of the Employee </label><br>
<select  name="vendor" class="form-control js" required="required">
<option value="">--Select--</option>
    @foreach($bank_accounts as $bank_accounts)

    <option value="{{$bank_accounts->id}}">{{$bank_accounts->name}}---{{$bank_accounts->Account_Number}}---{{$bank_accounts->Bank_Name}}</option>
    @endforeach

</select>

</div></td></tr>
<tr>
<td>
<label for="quarter"> Quarter</label>
<input type="checkbox" id="quarter" class="form-control txt" name="quarter" value="hhh">
</td>
<td>  

<label for="po">HRA : </label><br>
<input type="text"  name="hraa" id="hraa"  class="form-control" />


<div></td>


                </tr>
                <tr>
                <td>  

<label for="po">DA : </label><br>
<input type="text"  name="daa" id="daa"  class="form-control" />


</td>
<td>  

<label for="po">TA : </label><br>
<input type="text"  name="daa" id="daa"  class="form-control" />


</td>
                </tr>
                </table>
   

                                                    


                                  
               
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save Voucher ✓</button>
                <a href="{{route('voucher.index')}}" class="btn btn-danger">Cancel X</a>
                </form>
                </div></div></div>
                    

                        
                    
                    </div></div>
  
<script>

$(function() {
        $(".txt").on("input",  this, calc);
        $("select").on("change",  this, calc);
        
        
        
    });

function calc() {
  var amount = document.getElementById("hra").value;
  var amount = parseInt(amount, 10);
  var quantity = document.getElementById("basic").value;
  var quantity = parseInt(quantity, 10);
  var total = (amount * quantity)/100;
  var ba = Math.round(total);
  var quartera = document.getElementById("quarter").value;
  
  if (document.getElementById('quarter').checked) {
        b=0;
    }
    else  {
        if (ba < 5400) {
  b = 5400;
}
else{
b= ba
}
    }
  document.getElementById("hraa").value = b;
}
</script>
<script>

$(function() {
        $(".txt").on("input",  this, calci);
        $("select").on("change",  this, calci);
        
        
        
    });

function calci() {
  var amount = document.getElementById("da").value;
  var amount = parseInt(amount, 10);
  var quantity = document.getElementById("basic").value;
  var quantity = parseInt(quantity, 10);
  var total = (amount * quantity)/100;
  var ba = Math.round(total);
    document.getElementById("daa").value = ba;
}


</script>

<script>

$(function() {
        $(".txt").on("input",  this, calci);
        $("select").on("change",  this, calci);
        
        
        
    });

function calci() {
  var amount = document.getElementById("da").value;
  var amount = parseInt(amount, 10);
  var quantity = document.getElementById("basic").value;
  var level = document.getElementById("level").value;
  var quantity = parseInt(quantity, 10);
  var total = (amount * quantity)/100;
  var ba = Math.round(total);
    document.getElementById("daa").value = ba;
}

if(level <= 2) 
{ ta=1350;
 }

ifelse (level> =3 and B3<=8)
{
    ta=3600;
}

,),"3600",IF(B3>=9,"7200","")))


</script>



                    <script>


let initializeSelect2 =  function() {
$('.js').select2();
}

var i = 0;
$("#add12").click(function(){
    ++i;
    $("#dynamicTable12").append('');
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
                    url: "<?php echo route('select-ajax1') ?>",
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
