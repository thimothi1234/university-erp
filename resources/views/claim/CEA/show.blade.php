

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<title>CEA print</title>


<style>




p {
  text-align: justify;
  font-size: 1em;
  margin: 0.5em;
  padding: 10px;
}

table, td, th {
  
  border: 1px solid black;


      }

table {
border-collapse: collapse;

  width: 100%;
  
}

      th, td {
          height: 0px;
padding: 0px;
word-wrap: break-word;
    word-break: break-all;
    white-space: normal;
}
      
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}     
td {
  text-align: center;
}

        table.exclude-css, table.exclude-css tr, table.exclude-css td, table.exclude-css th {
  border: none;
}

</style>

<body>
<table class="exclude-css">
        <tr>
          <td style="text-align: left;"><img src="logo.png" alt="IITH"  width="330" height="85"> </td>
          <td style="text-align: right;"><br>Finance & Accounts <br>Room 217, Acadamic Block A, IIT Hyderabad <br>Phone : 23017060 <br> Mail:office.accounts@iith.ac.in</td>
        </tr>
      </table>  
      <div style="height:3px;font-size:3px;">&nbsp;</div>

<table>
  <tr><th style="font-size:16px">Children Education Allowance / Hostel Subsidy </th>
<th>S.No.: <span style="color: maroon;">{{$bud->id}}</span>
</th>
</tr>
</table>

<div style="height:3px;font-size:3px;">&nbsp;</div>

<span style="font-size:10px">(In accordance with Order no (1). A-27012/02/2017-Estt. (AL), 16th July 2018, (2). No.15-4/2017-TC, 31st January 2019 (MHRD), and (3).

F.No.15-4/2017-TC, 1st February 2019 (MHRD-Corrigendum))</span>
<br>
<span>I hereby apply for the reimbursement of Children Education Allowance 
@if($bud->cea == 'Yes')
&#x2611;
@else 
<input type="checkbox">
@endif

[and/or] Hostel
Subsidy @if($bud->hostel == 'Yes')
&#x2611;
@else
<input type="checkbox">
@endif  for my child/children. Relevant particulars are furnished
below:</span>
<table  class="table">

<tr>
    <td style="width: 10%;">&nbsp;01</td>
    <td style="width: 40%;">&nbsp;Name</td>
    <td style="width: 50%;">&nbsp;{{$bud->name}}</td>
</tr>
<tr>
    <td>&nbsp;02</td>
    <td>&nbsp;Designation </td>
    <td>&nbsp;{{$bud->designation}}</td>
</tr>
<tr>
    <td>&nbsp;03</td>
    <td>&nbsp;Date of Joining</td>
    <td>&nbsp;{{$bud->doj}}</td>

<tr>
    <td>&nbsp;04</td>
    <td>&nbsp;Employee ID No.</td>
    <td>&nbsp;{{$bud->eid}}</td>
</tr>




</table>
<span>Details of child/children for whom CEA/Hostel Subsidy claimed:</span>

<br>


<table  class="table">
<tr>
   
    <th style="width: 20%;">Name</th>
    <th style="width: 10%;">Age</th>
    <th style="width: 20%;">Acadamic year</th>
    <th style="width: 10%;">Class</th>
    <th style="width: 20%;">School</th>
    <th style="width: 10%;">Distance</th>
    <th style="width: 10%;">Board</th>
   
    
</tr>
<tbody>
@foreach($budy as $buddy)
<tr>
 
<td style="width: 20%;">&nbsp;{{$buddy->name}}</td>
<td style="width: 10%;">&nbsp;
{{\Carbon\Carbon::parse($buddy->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days'); }}


</td>  
<td style="width: 20%;">&nbsp;{{$buddy->ayfrom }}</td>
<td style="width: 10%;">&nbsp;{{$buddy->class}}</td>
<td style="width: 20%;">&nbsp;{{$buddy->school}}</td>
<td style="width: 10%;">&nbsp;{{$buddy->distance}}</td>
<td style="width: 10%;">&nbsp;{{$buddy->board}}</td>



</tr>


  
  @if($buddy->flexRadioDefault == 'No')
  
   @else
   <tr>
   <td colspan="2"> <b>&nbsp;Same class two times </b>  </td>
  <td >&nbsp;{{$buddy->flexRadioDefault}}</td>
  <td ><b>&nbsp;School</b></td>
  <td >&nbsp;{{$buddy->nameschool}}</td>
  <td ><b>&nbsp;Attemt No.</b></td>
  <td >&nbsp;{{$buddy->attemtno}}</td>
  </tr>
  @endif
  





  @if($buddy->flexRadioDefault1 == 'No')
 
   @else
   <tr>
   <td> <b>&nbsp;is Disabled Child </b>  </td>
  <td >&nbsp;{{$buddy->flexRadioDefault1}}</td>
  <td ><b>&nbsp;Nature of Disability</b></td>
  <td >&nbsp;{{$buddy->disability}}</td>
  <td ><b>&nbsp;Certificate date</b></td>
  <td >&nbsp;{{$buddy->dateofdis}}</td>
  <td >percentage&nbsp;{{$buddy->disaper}}</td>
  </tr>
  @endif

@endforeach


</tbody>
</table>
<span>
<br>
For Hostel Subsidy, the Bonafide certificate (or) Fee receipt is mentioning the amount from the 
concerned Institution is attached: {{$bud->hostelsubsidy}}     <br>
@if($bud->ifhostelyesamount == '')

@else
Amount claimed for Hostel Subsidy: Rs. {{$buddy->ifhostelyesamount}}<br>
@endif


&#x2611;
(i) I Certified that the fee/amount had actually been paid by me.<br>
&#x2611;
(ii) I Certified that I have attached {{$bud->attach}}<br>
@if($bud->notgovtservent == 'Yes')
&#x2611;
(iii) I Certified that my wife/husband is not a Government Servant.<br>
@else
&#x2611;
(iv) I Certified that my husband/wife Sri/Smt. {{$bud->nameofemloyee}} is presently
working as {{$bud->workingas}} in {{$bud->organis}} and that he/she shall not
apply/ has not applied for the Children Education Allowance/hostel subsidy for the child
mentioned above.<br>
&#x2611;
(v) I Certified that I or my wife/husband has not claimed this re-imbursement from any other
source and will not claim the same in future.<br>
@endif

@if($bud->distance == 'Yes')
&#x2611;
(vi) I Certified that my child is studying in educational institution which is more than 50 kms<br>
from my declared residential address (applicable in case of claiming Hostel subsidy).
@endif
*(Society Registration of a school or college is Not Valid for reimbursement).<br>
&#x2611;
(vii).The information furnished above is complete and correct and I have not suppressed any relevant
information. In the event of any change in the particulars given above which affect my   eligibility for
reimbursement of Children Education Allowance, I undertake to intimate the same promptly  and also
to refund excess payments if any made. Further, 
<br>
I am aware that if at any stage the
information/documents furnished above is found to be false, I am liable for disciplinary action.
<br>
</span>
<?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number  = $budy->sum('amount');
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

<br>


<span style=" font-family:Verdana; font-size:14px;">

<b>

<span>Date: </span> <br>
  <table class="exclude-css"><tr>
  <th style="font-family: mukta; font-size: 15px; text-align:left;">Name :</th>
  <th style="font-family: mukta; font-size: 15px; text-align:right;">Signature</th>
</tr></table>
    <hr>


<b>
   HR Section: <br> <br></b>
  <span style="font-size:13px">The family composition and previous service (if any, please provide the details) of the claimant has been 
verified from the official records and found correct.</span> 
 <br><br>
 <br>
 <table class="exclude-css"><tr>
  <th style="font-family: mukta; font-size: 15px; text-align:left;">Date :</th>
  <th style="font-family: mukta; font-size: 15px; text-align:right;">(Dy./Asst. Registrar)</th>
</tr></table>

 

    <hr> <b>Finance & Accounts Section :</b>
  

    <br><br>
    <span style="font-size:13px">Payment Passed for Rs.______________________________. TDS (If Any) ______________________. <br>
Net Payable Amount__________________________.</span>

<br><br>

</div>
<table class="exclude-css"><tr>
  
  <th style="font-family: mukta; font-size: 15px; text-align:right;">Signature of Drawing & Disbursing Officer</th>
</tr></table>
<hr>


<span >
A/c N.o : Salary account</span>




</body>
</html>
