

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<title>Voucher Print</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<style>
body {
  margin: -20pt 18pt 24pt 18pt;
}

* {
  font-family: helvetica,georgia,serif;
  
}

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


</style>
</head>
<body>

<script type="text/php">

if ( isset($pdf) ) {

  $size = 6;
  $color = array(0,0,0);
  if (class_exists('Font_Metrics')) {
    $font = Font_Metrics::get_font("helvetica");
    $text_height = Font_Metrics::get_font_height($font, $size);
    $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  } elseif (class_exists('Dompdf\\FontMetrics')) {
    $font = $fontMetrics->getFont("helvetica");
    $text_height = $fontMetrics->getFontHeight($font, $size);
    $width = $fontMetrics->getTextWidth("Page 1 of 2", $font, $size);
  }

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>
  




</head>
<body>
    


<nobr><nowrap>
<div class="container">




<div id="header">
    <div class="row">
<img src="ghghg.jpg" alt="IITH" width="703" height="111">
</div>

</div>

<hr style="width: 700px">

<div style="text-align: center;">

<span id="_16.1" style="font-weight:bold; font-family:Verdana; font-size:20.1px; color:#000000">
Temporary Advance/Pay Order (Purchases/ Services)</span>

</div>
<hr style="width: 700px">


<div >




<table style="width: 700px" class="table">

<tr>
    <td style="width: 10%;">&nbsp;01</td>
    <td style="width: 40%;">&nbsp;Name of person requesting Temporary Advance</td>
    <td style="width: 50%;">&nbsp;{{$bud->name}}</td>
</tr>
<tr>
    <td>&nbsp;02</td>
    <td>&nbsp;Designation </td>
    <td>&nbsp;{{$bud->designation}}</td>
</tr>
<tr>
    <td>&nbsp;03</td>
    <td>&nbsp;Department/Section</td>
    <td>&nbsp;{{$bud->department}}</td>
</tr>
<tr>
    <td>&nbsp;04</td>
    <td>&nbsp;The following items are required for</td>
    <td>&nbsp;{{$bud->description}}</td>
</tr>
<tr>
    <td>&nbsp;05</td>
    <td>&nbsp;Emploee Id</td>
    <td>&nbsp;{{$bud->eid}}</td>
</tr>




</table>


<br>


<table style="table-layout: fixed; width: 700px;" class="table">
<tr>
    <th style="width: 15%;">S.No.</th>
    <th style="width: 65%;">Details of items</th>
    <th style="width: 40%;">Quantity</th>
    <th style="width: 35%;">Rate(Rs)</th>
    <th style="width: 35%;">Estimated Cost (Rs.)</th>
    
</tr>
<tbody>
@foreach($budy as $buddy)
<tr>
<td  style="width: 15%;">&nbsp;{{$loop->iteration}}</td>
<td style="width: 65%;">&nbsp;{{$buddy->details}}</td>
<td style="width: 40%;">&nbsp;{{$buddy->quantity}}</td>
<td style="width: 35%;">&nbsp;{{$buddy->rate}}</td>
<td style="width: 35%;">&nbsp;{{$buddy->amount}}</td>


</tr>
@endforeach

<tr>
    <td colspan="4" align="right">Total Claim Amount &nbsp;&nbsp;</td>
    <td>&nbsp;{{$budy->sum('amount')}}</td>
    </tr>
</tbody>
</table>
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
<span style=" font-family:Verdana; font-size:16.4px;">
Amount of advance requested Rs.{{$budy->sum('amount')}}  <br>
(Rupees.{{$result}}only) <br> 
6. I certify that:<br>
(a) The Advance drawn shall be submitted for adjustment within 15 days of Advance drawal failure to<br>
do so, may entail recovery of the advance drawn, in a single installment through the next Salary<br>
Bill/Scholarship of Employee/Student. Items mentioned above are not available in the Central<br>
Stores of IIT Hyderabad.<br>
(b) The materials requested are required for the said purpose.<br>
(c) Purchase will be made after ascertaining lowest rates of products of similar quality from at least 3<br>
dealers.<br>
(d) No advance is pending with me.<br>
<b>
<br><br>
<span>Employee: &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp; Head of the Dept.</span> 
    <hr>

    <p style="padding: 10px; border: 2px solid black;">Temp. Adv. No. : ______________ Date : ___________ </p> <br>
  

   <span style=" font-family:Verdana; font-size:16.4px;">
   Approved payment of Temporary Advance of Rs.{{$budy->sum('amount')}}  <br>
(Rupees.{{$result}}only)</span>

<b>
    <br><br><br>
<span>Deputy. Registrar (F&amp;A)
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
	
 DDO</span> </b> </div>

<hr>


<span >
Bank Name & Branch</span>


<span >
: {{$bud->nmmms->Bank_Name}} & {{$bud->nmmms->Branch}}</span>
<br>

<span >
Bank Account Number</span>


<span >
: {{$bud->nmmms->Account_Number}} </span>

<br>
<span >
IFSC Code</span>


<span >
:    {{$bud->nmmms->IFS_Code}}   </span>



</nowrap></nobr>
</body>
</html>
