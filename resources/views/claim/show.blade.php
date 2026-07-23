<html>
<head>
<title>Print</title>
<style type="text/css">

body { font-family: Arial; font-size: 18.5px }
.pos { position: absolute; z-index: 0; left: 0px; top: 0px }

table, th, td {
  border:1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<nobr><nowrap>
<div class="container">
<div class="pos" id="_362:105" style="top:-20;left:0">
<img src="ghghg.jpg" align="center" alt="IITH" width="703" height="111">
</div>
<div class="pos" id="_362:105" style="top:10;left:150">

<span id="_16.3" style="font-weight:bold; font-family:Verdana; font-size:20.3px; color:#000000">
</span>
</div>

<div class="pos" id="_521:125" style="top:50;left:-35">
<span id="_15.8" style=" font-family:Arial; font-size:15.8px; color:#000000">
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
	&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;			&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;		&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;		&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;	

    &nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
</span>
<hr>
</div>
<div class="pos" id="_643:94" style="top:94;left:643">
<span id="_15.1" style="font-style:italic; font-family:Arial; font-size:15.1px; color:#000000">
            </span>
</div>
<div class="pos" id="_100:189" style="top:189;left:100">
<span id="_6.5" style="font-weight:bold; font-family:Verdana; font-size:6.5px; color:#000000">
      </span>
</div>
<div class="pos" id="_304:217" style="top:80;left:170">
<span id="_16.1" style="font-weight:bold; font-family:Verdana; font-size:20.1px; color:#000000">
Approval for Tour & TA Advance</span>
</div>

<div class="pos" id="_521:125" style="top:80;left:-35">
<span id="_15.8" style=" font-family:Arial; font-size:15.8px; color:#000000">
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
	&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;			&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;		&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;		&nbsp;	&nbsp;		&nbsp;	&nbsp;	&nbsp;	&nbsp;	

    &nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;	&nbsp;	&nbsp;	&nbsp;
&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
</span>
<hr>
</div>

<div class="pos" id="_66:215" style="top:120;left:0">

<table class="table"  style="width: 700px">
    <tr>
        <td style="width: 10%;">&nbsp; Name</td>
        <td style="width: 40%;">&nbsp; {{$bud->name}}</td>
        <td style="width: 20%;">&nbsp; Id No </td>
        <td style="width: 30%;">&nbsp; {{$bud->idno}} </td>
    </tr>
    <tr>
        <td >&nbsp; Designation</td>
        <td colspan="3">&nbsp; {{$bud->designation}}</td>
        
    </tr>
    <tr>
        <td >&nbsp; Department</td>
        <td colspan="3">&nbsp; {{$bud->department}}</td>
        
    </tr>
    <tr>
        <td >&nbsp; Pay level</td>
        <td colspan="3">&nbsp; {{$bud->paylevel}}</td>
        
    </tr>
    <tr>
        <td >&nbsp; Proposed Dates of Journey</td>
        <td colspan="3">&nbsp; 
        {{ \Carbon\Carbon::parse($bud->proposeddate)->format('d-M-Y')}} to
        {{ \Carbon\Carbon::parse($bud->todate)->format('d-M-Y')}}

        </td>
        
    </tr>
    <tr>
        <td >&nbsp; Purpose of Journey</td>
        <td colspan="3">&nbsp; {{$bud->purpose}}</td>
        
    </tr>

    <tr>
        <td >&nbsp; Class of Journey </td>
        <td colspan="3">&nbsp; {{$bud->class}} </td>
        
    </tr>
</table>

<table style="width: 700px" class="table">
<tr>
<th align="left">Type of expenditure</th><th align="left">Onward</th>
<th align="left">Return</th></tr>
@foreach($budy as $budyy)


<tr>
    <td style="position: relative; ">
 <span class="cls_0021">{{$budyy->type}}</span></td>
    <td style="position: relative;">
    
<span class="cls_0021">&nbsp;{{$budyy->onward}}</span>
    </td>
    <td style="position: relative;"><span class="cls_0021">&nbsp;{{$budyy->return}}</span></td>
</tr>
@endforeach
<tr>

<td colspan="2" align="right"><b>Total Advance Requested&nbsp;</b></td>
<td>&nbsp;{{$bud->total}}</td>
</tr>
</table>

<span style=" font-family:Verdana; font-size:16.4px;">
I hereby certify that there is no unsettled travel advance amount against my name. <br>
I hereby certify that I will submit TA Bill within 15 days of completion of journey. Failure to do so, may <br>
entail recovery of the advance drawn, if any in a single installment through the next Salary <br>
Bill/Scholarship of Employee/Student. <br>
<b>
I hereby certifiy that I have taken tour approval from the Head of Department. <br>
I have enclosed the original approval letter given by the Director for all international travels. </b>
</span>
<br>
<br><br>
<span style="float:right; "><b>Employee/Student </b> </span>
<br>

<hr>

<span style="float:left; "> <b> Head of the Department/ Director </b> </span> <br><br>
<span>Chargeable Head:  TA and DA &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp; Seminar &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp; Training &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp; Others</span>
<br><br><br>
<Span style="border: 1px solid black"> &nbsp;&nbsp; TA No._______________ </Span>
<span style="float:right; "><b>Joint Registrar (F&amp;A)</b> </span>
<hr>
<span>Approved TA Advance of Rs. __________ <br>
(Rupees ______________________________________________________________________).</span>
<br><br><br>
<span style="float:right; "><b>DDO</b> </span>
<br>
<hr>

<span>Name of the Beneficiary: {{$bud->nmmms->name}}</span> <br>
<span>Bank Account Number :{{$bud->nmmms->Account_Number}}</span>  <br>

 <span> IFSC Code : {{$bud->nmmms->IFS_Code}}, Bank Name:{{$bud->nmmms->Bank_Name}}</span> <span style="float:right; "><b>Employee/ Student</b> </span>



</nowrap></nobr>
</body>
</html>
