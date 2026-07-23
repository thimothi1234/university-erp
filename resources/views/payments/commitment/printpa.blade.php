
    <title>Pay Slip {{$ledge->Employee_Id}} {{$ledge->month}}</title>

    <link rel = "icon" href = 
"logo.jpg" 
        type = "image/x-icon">
        <style>
          
* {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 48.5%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

.tb table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  
  padding: 16px;
  
}


.tbg th,.tbg td {
  border-bottom: 0px solid #F5F5F5;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}


</style>
    <style>


   
    



  


table {
  border-collapse: collapse;
  
    width: 100%;
    
}

        th, td {
            height: 0px;
  padding: 0px;
}
        


        

 h1 {display: inline; float: left; padding-right: 2rem;
                text-align: left;
                line-height: 30px;
                width: 25%;
                height: 30px;
                margin: 8px 1;
                box-sizing: border-box;
                font-size: 12px;
                border: 1px solid #000000;
                -webkit-transition: 0.5s;
                transition: 0.5s;
                outline: none;
            }

            h2 {
                text-align: center;
                width: 100%;
                margin: 1px 0;
                box-sizing: border-box;
                font-size: 16px;
                border: 1px solid #000000;
                -webkit-transition: 0.5s;
                transition: 0.5s;
                outline: none;
                font-weight:normal;
                
            }

            h3 {
                 
                  float: right;
                text-align: left;
                line-height: 30px;
                width: 25%;
                height: 30px;
                margin: 8px 1;
                box-sizing: border-box;
                font-size: 12px;
                border: 1px solid #000000;
               
            }
        
        h4 {
                text-align: center;
                width: 20%;
                
                margin: 1px 0;
                box-sizing: border-box;
                font-size: 16px;
                border: 1px solid #000000;
                -webkit-transition: 0.5s;
                transition: 0.5s;
                outline: none;
            }
         h5 {
                text-align: center;
                width: 100%;
                height: 30px;
                margin: 1px 0;
                font-size: 25px;
                outline: none;
            }

            h6 {page-break-after: always;
                width: 100%;
                height: 0px;
              
            }
   
        
        
           p {
  width: 800px; 
  ;
}
strong {
  text-align: center;
}
p.a {
  
  display:block;
    width:100%;
    word-wrap:break-word;
}

.p3 {
  font-family: "Lucida Console", "Courier New", monospace;
  letter-spacing: -1px;

}

.p4 {
  font-family: "Lucida Console", "Courier New", monospace;
  letter-spacing: -1px;
  font-size: 10px;
}
#img {
  opacity: 0.2;
}




    </style>
</head>
<body>
  
<div id="background">
  <p id="bg-text"></p>
	</div>
<table>
        <tr>
          <td style="align:center"><img src="logo.png" alt="IITH"  width="330" height="85"> </td>
          <td style="text-align: right;"><br>Finance & Accounts <br>Room 201, Admin Block, IIT Hyderabad <br>Phone : 23017060 <br> Mail:office.accounts@iith.ac.in</td>
        </tr>
      </table>   

              
      <div style="height:3px;font-size:8px;">&nbsp;</div>
        
   

 <?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?>
 <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number  = abs($ledge->Net_Amount);

   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  
 ?>
 
   
 
 <hr style="height:0.1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
<table> <tr>

<td width="54%" style="text-align: right;"><strong style="text-align: right; font-size: 18px; ">Pay Slip </strong></td>
<td width="46%" style="text-align: right; font-size: 16px;">{{$ledge->month}}</td>
</tr></table>
 
    
    
    
  

<hr style="height:0.1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">

<div style="height:3px;font-size:5px;">&nbsp;</div>
     <table >
     <tr> 
                   <td  style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 16px;" >        
                   <span > <b>{{$ledge->Particulars}}</b></span>     
                

                  </td>
                 
                
                   
              </tr>
     </table>
    
     <div style="height:3px;font-size:8px;">&nbsp;</div>
        <table> 
              
              <tr>
              <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Employee ID</td>
              <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->EID}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;PRAN</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->PRAN}}&nbsp;</td>
              </tr>
              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Function</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->Function}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Location</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">IIT Hyderabad&nbsp;</td>
              </tr>
              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Designation</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->designation}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Bank Details</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->Account_Number}}&nbsp;</td>
              </tr>
             
                          
             

              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Date of joining</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->DOJ}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;PAN </td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledge->PAN}}&nbsp;</td>
              </tr>
              </table>
  

 
    <br>
   
              
                                
<div class="row">
  <div class="column">
    <table class="tbg">
    <tr>
    <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Earnings</th>
    <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">Amount</th>
    <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">
  </tr>

  @if($ledge->Basic_Pay > 0){
    <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px; ">&nbsp;Basic Pay</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Basic_Pay) }}</td>

  </tr>
  }@else { }@endif
  @if($ledge->Dearness_Allowance > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Dearness Allowance </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Dearness_Allowance)  }}</td>
  
  </tr>
}@else { }@endif
@if($ledge->DA_Arrears > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;DA Arrears </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->DA_Arrears)  }}</td>
  
  </tr>
}@else { }@endif
@if($ledge->Honorarium_Academic >0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Honorarium (Academic)	 </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Honorarium_Academic)  }}</td>
  
  </tr>
}@else { }@endif

@if($ledge->Honorarium_Deans> 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Honorarium (Deans) </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Honorarium_Deans)  }}</td>
  
  </tr>
}@else { }@endif

@if($ledge->Honorarium_Warden> 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Honorarium (Warden)</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Honorarium_Warden) }}</td>
  
  </tr>
}@else { }@endif

  @if($ledge->Arrears > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Arrears </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Arrears)  }}</td>
  
  </tr>
}@else { }@endif

@if($ledge->Arrears_HRA > 0){
<tr>
  <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Arrears (HRA) </td>
  <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Arrears_HRA)  }}</td>

</tr>
}@else { }@endif
  @if($ledge->Deputation_Allowance > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Deputation Allowance </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Deputation_Allowance)  }}</td>

  </tr>
}@else { }@endif
  @if($ledge->HRA > 0){

  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;HRA </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->HRA)  }}</td>
  
  </tr>
}@else { }@endif
  @if($ledge->HRAFixed > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;HRA Fixed</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->HRAFixed) }}</td>
   
  </tr>
}@else { }@endif
  @if($ledge->NonPractising_Allowance > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Non-Practising Allowance</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->NonPractising_Allowance) }}</td>
   
  </tr>
}@else { }@endif
  @if($ledge->Personal_Pay > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Personal Pay</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Personal_Pay) }}</td>

  </tr>
}@else { }@endif
  @if($ledge->Transport_Allowance > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Transport Allowance </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Transport_Allowance)  }}</td>

  </tr>
}@else { }@endif

@if($ledge->TA_Arrears > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;TA Arrears </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->TA_Arrears)  }}</td>

  </tr>
}@else { }@endif
@if($ledge->cyient_prof_honorarium > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Cyient Chair Professor &nbsp;Honorarium</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->cyient_prof_honorarium)  }}</td>

  </tr>
}@else { }@endif

@if($ledge->Honorarium_JCBose > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Honorarium (JC Bose &nbsp;Fellowship)</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Honorarium_JCBose)  }}</td>

  </tr>
}@else { }@endif

@if($ledge->Arrears_FPA > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Arrears FPA</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Arrears_FPA)  }}</td>

  </tr>
}@else { }@endif
@if($ledge->Special_Allowance > 0){
  <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Special Allowance</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Special_Allowance)  }}</td>

  </tr>
}@else { }@endif
 
     
    </table>
  </div>
  <div class="column">
    <table class="tbg">
    <tr>

    <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Deductions</th>
   <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">Amount</th>
   <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">
  </tr>
  @if($ledge->Canara_BankPersonal_Loan > 0){  
  <tr>

  
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Canara Bank Personal Loan</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Canara_BankPersonal_Loan) }}</td>
  </tr>
}@else { }@endif
@if($ledge->Income_Tax > 0){
  <tr>
  
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Income Tax </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Income_Tax)  }}</td>
  </tr>
}@else { }@endif
@if($ledge->National_Pension_System > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;National Pension Scheme </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->National_Pension_System)  }}</td>
  </tr>
}@else { }@endif
  @if($ledge->CGHS > 0){
  <tr>
 
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Medical Subscription </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->CGHS) }}</td>
  </tr>
}@else { }@endif
  @if($ledge->Electricity_Charges > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Electricity Charges </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Electricity_Charges)  }}</td>
  </tr>
}@else { }@endif
  @if($ledge->GPF > 0){
  <tr>

    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;GPF </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->GPF)  }}</td>
  </tr>
}@else { }@endif
 
  @if($ledge->License_Fee > 0){
  <tr>

    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;License Fee </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->License_Fee)  }}</td>
  </tr>
}@else { }@endif
  @if($ledge->Misc_Recoveries_2 > 0){
  <tr>
  
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Misc Recoveries</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Misc_Recoveries_2)  }}</td>
  </tr>
}@else { }@endif
 
  @if($ledge->NPS80CCD1B > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;NPS 80CCD1B</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->NPS80CCD1B) }}</td>
  </tr>
}@else { }@endif
@if($ledge->PF_Advance_Recovery > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;PF Advance Recovery </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->PF_Advance_Recovery)  }}</td>
  </tr>

}@else { }@endif
@if($ledge->Employee_Welfare_Fund > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Employee Welfare Fund </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Employee_Welfare_Fund)  }}</td>
  </tr>
}@else { }@endif


  @if($ledge->Pension_Adjustment > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Pension Adjustment </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Pension_Adjustment)  }}</td>
  </tr>
}@else { }@endif
  @if($ledge->Professional_Tax  > 0){

    <tr>
   
   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Professional Tax </td>
   <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Professional_Tax)   }}</td>
 </tr>
}@else { }@endif

@if($ledge->Recoveries_HRA > 0){

<tr>

<td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Recoveries(HRA) </td>
<td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Recoveries_HRA)   }}</td>
</tr>
}@else { }@endif

  @if($ledge->Recoveries_NPS > 0){

  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Recoveries NPS  </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Recoveries_NPS)   }}</td>
  </tr>
}@else { }@endif
  @if($ledge->Rent_on_Furniture > 0){
  <tr>
   
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Rent on Furniture </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Rent_on_Furniture)  }}</td>
  </tr>
}@else { }@endif
  @if($ledge->WATER_Charges > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;WATER Charges </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->WATER_Charges)  }}</td>
  </tr>

}@else { }@endif

@if($ledge->CGEGIS > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;CGEGIS </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->CGEGIS)  }}</td>
  </tr>

}@else { }@endif

@if($ledge->GPF_Advance_Repayment > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;GPF Advance Repayment </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->GPF_Advance_Repayment)  }}</td>
  </tr>

}@else { }@endif

@if($ledge->Recoveries_Telephone_Chgs > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Recoveries Telephone Chgs </td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Recoveries_Telephone_Chgs)  }}</td>
  </tr>

}@else { }@endif

@if($ledge->Recoveries_Refixation_Salary > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Recoveries Refixation Salary</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->Recoveries_Refixation_Salary)  }}</td>
  </tr>

}@else { }@endif

@if($ledge->cyient_incometax > 0){
  <tr>
    
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Income tax on Cyient &nbsp;Honararium </td>
    
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{number_format($ledge->cyient_incometax)  }}</td>
  </tr>

}@else { }@endif

</table>

                   
 


              
   

  
     
    
</div>

<div class="row">
  <div class="column">
  <table class="tbg">
  <tr>
   
   <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;"> &nbsp;Total Earnings</th>
   <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">{{number_format($ledge->Total_Earnings)   }}</th>
 
  </tr>
  <tr>
   
   <th width="30%"></th>
   <th width="20%"></th>
 </tr>
  </table>
  </div>
  <div class="column">
  <table class="tbg">
  <tr>
    <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">&nbsp;Total Deductions <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;"></th>
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">{{number_format($ledge->Total_Deductions)  }}<hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;"></th>
  </tr>
  <tr>
    <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Net Payable </th>
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">₹ {{number_format($ledge->Net_Amount)  }} </th>
  </tr>
    </table>
 
            </div></div> 
          <br>
             
 

              <b style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"> Net Amount in words : {{ucfirst($result)}} rupees Only</b>   <br><br><br>
              <p style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">***This is a Computer Generated Pay Slip</p> 
</div>
   
              

    

                        
                                                 
                                     