

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
table.exclude-css, table.exclude-css tr, table.exclude-css td, table.exclude-css th {
  border: none;
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

<table class="exclude-css">
        <tr>
          <td style="text-align: left;"><img src="logo.png" alt="IITH"  width="330" height="85"> </td>
          <td style="text-align: right;"><br>Finance & Accounts <br>Room 217, Acadamic Block A, IIT Hyderabad <br>Phone : 23017060 <br> Mail:office.accounts@iith.ac.in</td>
        </tr>
      </table>  
      <div style="height:3px;font-size:3px;">&nbsp;</div>

<table>
  <tr><th style="font-size:16px">Medical Claim form A (OPT) </th>
<th>S.No.: <span style="color: maroon;">{{$bud->id}}</span>
</th>
</tr>
</table>




<div >
<br>
<table class="table" >
    <tr>
        <td >&nbsp; Name of the employee</td>
        <td >&nbsp; Designation</td>
        <td>&nbsp; Emp. ID </td>
   
    </tr>
    <tr>
        <td >&nbsp; {{$bud->name}}</td>
        <td >&nbsp; {{$bud->designation}}</td>
        <td >&nbsp; {{$bud->eid}}</td>
        
    </tr>
    <tr>
      
      <td  style="text-align:left">&nbsp;Remarks</td>
      <td colspan="2" style="text-align:left">&nbsp;{{$bud->remarks}}</td>
      
  </tr>
  
   
  
</table>
<b>
<span>Certified that I have taken treatment for the following:</span></b>

<table class="table">

<tr>
    <td >&nbsp;01</td>
    <td >&nbsp;Name of the patient</td>
    <td >&nbsp;{{$bud->patientname}}</td>
</tr>
<tr>
    <td>&nbsp;02</td>
    <td>&nbsp;Age </td>
    <td>&nbsp;{{$bud->patientage}}</td>
</tr>
<tr>
    <td>&nbsp;03</td>
    <td>&nbsp;Relationship with the employee</td>
    <td>&nbsp;{{$bud->relation}}</td>
</tr>
<tr>
    <td>&nbsp;04</td>
    <td>&nbsp;Name of the Doctor</td>
    <td>&nbsp;{{$bud->doctor}}</td>
</tr>
<tr>
    <td>&nbsp;05</td>
    <td>&nbsp;Doctor address</td>
    <td>&nbsp;{{$bud->address}}</td>
</tr>
<tr>
    <td>&nbsp;06</td>
    <td>&nbsp;Name of the disease</td>
    <td>&nbsp;{{$bud->disease}}</td>
</tr>
<tr>
    <td>&nbsp;07</td>
    <td>&nbsp;Duration of treatment</td>
    <td>&nbsp;From : {{$bud->from}}   To {{$bud->to}}  </td>
</tr>



</table>
<b>
<span style="align:center;">Details of treatment and claim of reimbursement</span> </b>
<br>
<span>Consultation fee and fee for injection(s)/medicines/Details investigations</span>

<br>


<table  class="table">
<tr>
    <th >Type of procedure</th>
    <th>Name of the doctor/ <br> medicine/ <br>procedure/tests</th>
    <th >Cash Memo no</th>
    <th >Date</th>
    <th >Qty.</th>
    <th >Amount</th>
</tr>
<tbody>
@foreach($budy as $buddy)
<tr>
<td  >&nbsp;{{$buddy->type}}</td>
<td>&nbsp;{{$buddy->name}}</td>
<td >&nbsp;{{$buddy->invoice}}</td>
<td >&nbsp;{{$buddy->date}}</td>
<td >&nbsp;{{$buddy->quantity}}</td>
<td >&nbsp;{{$buddy->amount}}</td>


</tr>
@endforeach

<tr>
    <td colspan="5" align="right">Total Claim Amount &nbsp;&nbsp;</td>
    <td>&nbsp;{{$budy->sum('amount')}}</td>
    </tr>
</tbody>
</table>


<br>
<span style=" font-family:Verdana; font-size:12px;">
Photocopy of the prescriptions and Original cash memos/receipts should
be enclosed. <br> 
I Certified that: <br>
1. The above named patient is / was under Doctor's treatment and was not given
pre-natal or post-natal treatment. <br>
2. The consultation was done at the consulting room of the AMA/residence of the
patient. <br>
3. Injection(s) was administered at the consulting room of the AMA/residence of
the patient. <br>
4. The injections administered were not / were for immunizing of prophylactic
purposes. <br>
5. The medicines prescribed by Doctor in this connection were essential for the
recovery / prevention of serious deterioration of the condition of the patient. <br>
6. The medicines are neither stocked with the AMA for supply to private patients
and do not include proprietary preparations for which cheaper substances of
equal therapeutic value  are available nor are preparations which are primarily
foods, toilets or disinfectants. <br>
7. The X-Ray, Laboratory tests, investigations, etc., were necessary and were
undertaken on Doctor's advice. <br>
8. The doctor referred the patient to Dr. {{$bud->reffered}}  for
specialist consultation and that the necessary approval as required under the
rules was obtained. </span> <br><br><br>
<b>

<span>Place:</span>  <br><br>
<span>Date:</span> <br>
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
    <div style="text-align: right;">
<span > <b>Signature of Employee</span> </b> </div>






</nowrap></nobr>
</body>
</html>
