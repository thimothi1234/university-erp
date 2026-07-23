
    <title>Pay Slip {{$details->eid}} {{$details->month}}</title>

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
          <td style="text-align: right;"><br>Finance & Accounts <br>201 & 202, Admin Block, IIT Hyderabad <br>Phone : 23017060 <br> Mail: payroll@iith.ac.in</td>
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
$number  = $Drsum->eartot-$Crsum->dedtot;

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
<td width="46%" style="text-align: right; font-size: 16px;">{{$details->month}}</td>
</tr></table>
 
    
    
    
  

<hr style="height:0.1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">

<div style="height:3px;font-size:5px;">&nbsp;</div>
     <table >
     <tr> 
                   <td  style="text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 16px;" >        
                   <span > <b>{{$details->name}}</b></span>     
                

                  </td>
                 
                
                   
              </tr>
     </table>
    
     <div style="height:3px;font-size:8px;">&nbsp;</div>
        <table> 
              
              <tr>
              <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Employee ID</td>
              <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->eid}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;PRAN</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->PRAN}}&nbsp;</td>
              </tr>
              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Function</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->department}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Location</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">IIT Hyderabad&nbsp;</td>
              </tr>
              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Designation</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->designation}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Bank Details</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->Account_Number}}&nbsp;</td>
              </tr>
             
                          
             

              <tr>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Date of joining</td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->DOJ}}&nbsp;</td>
                   <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;PAN </td>
                   <td width="1%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;" >:</td>
                   <td width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$details->PAN}}&nbsp;</td>
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
@foreach($Dr as $ledger)

    <tr>
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px; ">&nbsp;{{$ledger->payhead}}</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledger->amount}}</td>

  </tr>

@endforeach
 
     
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
  @foreach($Cr as $ledger)
  <tr>

  
    <td width="20%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;{{$ledger->payhead}}</td>
    <td width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$ledger->amount}}</td>
  </tr>
  @endforeach

</table>   
</div>
<div class="row">
  <div class="column">
  <table class="tbg">
  <tr>
   <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;"> &nbsp;Total Earnings</th>
   <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">{{$Drsum->eartot}}</th>
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
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"><hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;">{{$Crsum->dedtot}}<hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 5x;"></th>
  </tr>
  <tr>
    <th width="30%" style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">&nbsp;Net Payable </th>
    <th width="20%" style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">{{$Drsum->eartot-$Crsum->dedtot}}₹ </th>
  </tr>
    </table>
 
            </div></div> 
          <br>
             
 

              <b style="text-align: right; font-family: Arial, Helvetica, sans-serif; font-size: 15px;"> Net Amount in words : {{ucfirst($result)}}  rupees Only</b>   <br><br><br>
              <p style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">***This is a Computer Generated Pay Slip</p> 
</div>