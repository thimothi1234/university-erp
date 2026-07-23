<!DOCTYPE html>
<html lang="hi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Voucher</title>
    <link rel = "icon" href = "logo.jpg" 
        type = "image/x-icon">

        </head>

        
    <style>
      

@media print {
  html, body {
    width: 216mm;
    height: 297mm;
  }  
}
    #printPageButton {
    display: none;
  }
table, td, th {
  
    border: 1px solid black;
  


        }
        table.exclude-css, table.exclude-css tr, table.exclude-css td, table.exclude-css th {
  border: none;
}
        

table {
  border-collapse: collapse;
  
    width: 100%; 
}
        th, td {
            height: 0px;
  padding: 0px;
   }



            #jin {page-break-before: always;
                
              
            }
        .tiny {
                
    
                font-size: 10px;
                font-family: "Lucida Console", "Courier New", monospace;
                letter-spacing: -1px;
            }
        
        
           p {
  width: 800px; 
  ;
}
strong {
  text-align: center;
}
p {
  
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

#timo {
  text-align: center;
}

.hind {
font-family: 'poppins', sans-serif;
}
th, td {
  padding: 2px;
}
    </style>


<body>
   
<table style="width:100%">
  <tr>
    <th style="font-family: mukta; font-size: 16px; width:25% ;" > अगर्षण अन े भाग /<br> Forwarding Section: </th>
    <th rowspan="2" style="width:50%"> 
       <img src="logo.PNG" alt="IITH" align="center" width="310" height="80">
     
         <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
        Finance & Accounts
        </th> 
    <th style="font-family: mukta; font-size: 16px; width:25% ;">  प्रतिबद्धता सं. / <br>Commitment No :  </th>
  </tr>
  <tr>
    <th><span style="color: maroon; font-size: 16px;">{{$entries->id}}</span></th>
    
    <th><span style="color: maroon; font-size: 16px;">

       COM-{{$entries->sub}} </span>
     </th>
  </tr>
  <tr>
    <th colspan="3" style="font-family: mukta; font-size: 16px;"><strong>
    प्रतिबद्धता वाउचर / {{$entries->debit_credit}}  Voucher
    
 
     </strong></th>
  </tr>
  
  </table>
  <div style="height:3px;font-size:3px;">&nbsp;</div>

  <div style="height:3px;font-size:3px;">&nbsp;</div>

<div style="height:3px;font-size:3px;">&nbsp;</div>

<div style="height:3px;font-size:3px;">&nbsp;</div>

 <?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?>
           <table id="timothy"> <tr>
                   <th width="30%" style="font-family: mukta; font-size: 18px;">बजट शीर्ष / Budget Head</th>
                   <th width="25%" style="font-family: mukta; font-size: 18px;"> उप शीर्ष / Sub Head</th>
           
                     <th width="10%" style="font-family: mukta; font-size: 18px;"> राशि / Amount</th>
  </tr>

  
  @foreach($ledger as $ledger)
       
        <tr>
        @if( $ledger->costcentre == 'NULL' or $ledger->costcentre == '')
        <td width="30%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">&nbsp;</td>
        @else
        <td width="25%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">{{$ledger->costcentres->name}}</td>
        @endif
      
        @if( $ledger->sub == 0)
        <td width="25%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">&nbsp;</td>
        @else
        <td width="25%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">{{$ledger->subs->head}}</td>
        @endif
             
   
          
          <td width="10%" align="right" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">{{$ledger->amount }} {{ $ledger->cr_dr}} </td>
          
      
        </tr>
        
      @endforeach  
                 <tr>
    
  <td width="75%" align="right" colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px;"><b> Net :</b></td>
  
             <td width="25%" align="right" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px;" >  <b> {{$ledge->sum('amount') }}&nbsp;&nbsp; </b></td></tr>
               
         
                    </table>
                              </div>

<table class="exclude-css">
  <tr>
    <th style="font-family: mukta; font-size: 15px; text-align: justify; text-justify: inter-word;" > वर्णन /  Narration :{{$entries->narration}}  @if($entries->voucherno_bvrno == 0)
       
       @else Pvr No : 
       {{$entries->voucherno_bvrno}}/{{ date('m', strtotime($entries->transactiondate)) }}/{{$entries->fy}} Cheque No : {{$entries->chequeno}}
      @endif</th>
  </tr>
</table>

      <table class="exclude-css">
<tr>
  <th style="font-family: mukta; font-size: 15px; text-align:left;">
  यह प्रमाणित किया जाता है कि क्रय/सेवाएँ आईआईटी हैदराबाद की जरूरतों को पूरा करने के लिए की गई हैं
  </th>
</tr>

<tr>
  <th style="font-family: mukta; font-size: 15px; text-align:left;">
  This is to certify that the purchases/services have been made to meet the needs of IIT Hyderabad.
  </th>
</tr>
</table>
                   <b></b>
                   
              
               <br><br><br>
              
               <table class="exclude-css">
    <tr>
        <td class="tiny" style="text-align:left;">
            <p>Submitted by {{$entries->entereds->names->name}}</p>
            <p>Date: {{$entries->created_at}}</p>
        </td>

        <td class="tiny" style="text-align:right;">
            @if (is_null($ar))
                <p></p>
            @else
                <p>Approved By {{$ar->ars->names->name}}</p>
                <p>{{$ar->created_at}}</p>
            @endif
        </td>
    </tr>
   
    <tr>
        <td style="text-align:left;font-family: sans-serif; font-size: 14px;"> <p style="font-family: mukta; font-size: 16px;"><b> डीलिंग सहायक, अग्रेषण अनुभाग </b></p> <b> Dealing Assistant of Forwarding Section</b></td>
        <td style="text-align:right;font-family: sans-serif; font-size: 14px;"> <p style="font-family: mukta; font-size: 16px;"><b> अनुभाग/विभाग प्रभारी/अधिकारी </b></p> <b> Section/Department Incharge/Officer</b></td>
    </tr>
</table>
                  
<hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
        
         <?php
  
$number  = abs($ledge->sum('amount'));
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
    <th style="font-family: mukta; font-size: 15px; text-align:left;"><b> अनुमोदित भुगतान रु./</b><b> Approved payment of Rs:</b> <b style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; text-align:left;"> {{$ledge->sum('amount')}}</b></th>
    </tr><tr>
    <th style="font-family: mukta; font-size: 15px; text-align:left;"><b> कुल राशि शब्दों में/</b><b> Net Amount in words :</b> Rupees {{$result}}</th>
  </tr>
  <tr><th><br></th></tr>
  <tr><th><br></th></tr>

  <tr>
    <td style="text-align:right;" class="tiny">
     @if (is_null($dr))
                <p></p>
            @else
                <p>Approved By {{$dr->ars->names->name}}</p>
                <p>{{$dr->created_at}}</p>
            @endif</td>
  </tr>
  <tr>
    <th style="font-family: mukta; font-size: 15px; text-align:right;" > 
</th>
  </tr>


        </table>

                  <p style="text-align: left; width:49%; display: inline-block;"><b>  </b></p>
                  <p style="text-align: right; width:50%;  display: inline-block;">
                  </p>
                  </b></p>
                   

                                   </div></div></div></div>           
                                   
                                   

                                                       