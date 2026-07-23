<html>
<head>
<title>Telephone Reimbursement</title>
<style>
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

<style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background-color: #ffffff;
}

.signature-box {
    position: relative;
    width: 220px;
    padding: 2px;
    border: 1px solid #000;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    line-height: 1;
    font-size: 10px;
}

.signature-box::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('{{ asset("vector.jpeg") }}');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 150px;
    opacity: 0.1;
    pointer-events: none;
    z-index: 0;
}

.signature-box p {
    margin: 1px 0;
    position: relative;
    z-index: 1;
}

.valid-text {
    font-size: 14px;
    font-weight: bold;
    color: #000;
    margin-bottom: 6px;
}

.signer-info, .date-info {
    color: #000;
    margin: 0;
    padding: 0;
}
</style>


<body>
<?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number  = $bud->amount;
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
<table class="exclude-css">
        <tr>
          <td style="text-align: left;"><img src="logo.png" alt="IITH"  width="330" height="85"> </td>
          <td style="text-align: right;"><br>Finance & Accounts <br>Room 217, Acadamic Block A, IIT Hyderabad <br>Phone : 23017060 <br> Mail:office.accounts@iith.ac.in</td>
        </tr>
      </table>  
      <div style="height:3px;font-size:5px;">&nbsp;</div>

<table>
  <tr><th style="font-size:16px">Telephone Reimbursement</th>
<th>S.No.: <span style="color: maroon;">{{$bud->id}}</span>
</th>
</tr>
</table>

<div style="height:3px;font-size:5px;">&nbsp;</div>

<table class="exclude-css">
<tr>
  <td style="Text-align:right; font-size: 15px;"> <b>
  Date:{{ \Carbon\Carbon::parse($bud->created_at)->format('d/m/Y')}}
  </b>
  </td>
</tr>
<tr>
<td style="Text-align:left; font-size: 15px;"> <b>
  <br><br>
  To <br>
The Joint Registrar (F&A)<br>
IIT Hyderabad <br><br>
&nbsp;&nbsp;&nbsp;Sub: Reimbursement of Telephone bills
<br><br><br>
Sir, <br>
 </b>
</td>
</tr>
<tr>
  <td style="text-align: justify; font-size: 15px;">
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kindly arrange to reimburse the telephone bills. 
The  amount  may  please  be  credited to my salary account . Cash memos for the same attached with this letter. <br>
 @if ($bud->amount == '') @else <b> Amount : {{$bud->amount}} Months From : {{$bud->from}} To : {{$bud->to}}</b>  @endif
  </td>
</tr>
</table>
 @if (count($subs) == 0)
  @else
<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Type</th>
            <th>Number</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        
@php
    $users = DB::table('users')
    ->where('id', $bud->submittedby)
                ->first();
$stamp = DB::table('employees')
    ->where('id', $users->name)
                ->first();
                  $grandTotal = 0;
@endphp
        
        @foreach($subs as $index => $sub)
          @php
        $grandTotal += $sub->Amount;
    @endphp
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $sub->type }}</td>
                <td>{{ $sub->number }}</td>
                <td>{{ \Carbon\Carbon::parse($sub->from_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($sub->to_date)->format('d-m-Y') }}</td>
               <td>{{ number_format($sub->Amount, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: right;"><b>Total</b></td>
 <td style="text-align: center;"><b>{{ number_format($grandTotal, 2) }}</b></td>        </tr>
    </tbody>
</table>
 @endif

<br>

     <div>
    <label>
    <span style="font-size:18px;">&#x2611;</span>

        Certified that the above telephones are in my name.
    </label>
</div>

<div>
    <label>
    <span style="font-size:18px;">&#x2611;</span>

        Certified that I have incurred the above expenditure towards telephone charges during the period mentioned above.
    </label>
</div> 
 <br><br>
           
    
<table class="exclude-css">
  <tr> <td style="width: 50%;"></td> <td style="width: 15%; Text-align:left; font-size: 15px;"> Name </td> <td style="width: 5%;">:</td><td style="width: 30%; Text-align:left; font-size: 15px;"><b>{{$bud->name}} </b></td></tr>
  <tr> <td style="width: 50%;"></td><td style="width: 15%; Text-align:left; font-size: 15px;"> Designation  </td> <td style="width: 5%;">:</td><td style="width: 30%; Text-align:left; font-size: 15px;"> <b>{{$bud->designation}}</b></td></tr>
  <tr><td style="width: 50%;"></td> <td style="width: 15%; Text-align:left; font-size: 15px;"> Department</td> <td style="width: 5%;">:</td><td style="width: 30%; Text-align:left; font-size: 15px;"><b>{{$bud->department}}</b></td></tr>
  <tr><td style="width: 50%;"></td>  <td style="width: 15%; Text-align:left; font-size: 15px;"> Employee ID </td> <td style="width: 5%;">:</td><td style="width: 30%; Text-align:left; font-size: 15px;"><b>{{$bud->eid}}</b></td></tr>
  <tr><td style="width: 50%;"></td>  <td style="width: 15%; Text-align:left; font-size: 15px;"> Pay Level</td> <td style="width: 5%;">:</td><td style="width: 30%; Text-align:left; font-size: 15px;"><b>{{$bud->from}}</b></td></tr>
</table>
<br><br><br>
<table class="exclude-css">
<tr>
  <td style="Text-align:left;">
  @if ($bud->remarks == '') @else  Remarks : {{$bud->remarks}} @endif
  </td>
</tr>
<br><br><br><br>
<tr>
</tr>
</table>

<div class="signature-box" 
     style="text-align: left; float: right; 
            position: relative; 
            width: 220px; 
            padding: 10px; 
            background-image: url('vector.png'); 
            background-repeat: no-repeat; 
            background-position: left; 
            background-size: 100px 100px; 
            opacity: 100;">

    <!-- Signature text -->
    <p class="valid-text" style="position: relative; z-index: 1;">Signature valid</p>
    <p class="signer-info" style="position: relative; z-index: 1;">
    Digitally signed by {{ $stamp->name ?? 'N/A' }}
</p>
    <p class="date-info" style="position: relative; z-index: 1;">Date: {{$bud->created_at}}</p>
</div>


</body>
</html>