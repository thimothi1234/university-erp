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
    <th rowspan="2" style="width:50%">  @if ($rai->ledgers->name == 'SBI IIIT Raichur A/c No. 38458293914') 
        <img src="iitra.jpg" alt="IIITR" align="center" width="310" height="78">  
       @else
       <img src="logo.PNG" alt="IITH" align="center" width="310" height="80">
         @endif 
         <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
        Finance & Accounts
        </th> 
    <th style="font-family: mukta; font-size: 16px; width:25% ;">  वाउचर सं. / <br>Voucher No :  </th>
  </tr>
  <tr>
    <th><span style="color: maroon; font-size: 16px;">{{$entries->id}}</span></th>
    
    <th><span style="color: maroon; font-size: 16px;">
       @if($entries->voucherno_bvrno == 0)
       &nbsp;</span>
       @else
       {{$entries->voucherno_bvrno}}/{{ date('m', strtotime($entries->transactiondate)) }}/{{$entries->fy}} </span>
      @endif</th>
  </tr>
  <tr>
    <th colspan="3" style="font-family: mukta; font-size: 16px;"><strong>
    @if($entries->debit_credit == 'Advance')
    अग्रिम वाउचर / {{$entries->debit_credit}}  Voucher
 
    @elseif($entries->debit_credit == 'Advance Settlement')
    अग्रिम निपटान वाउचर / {{$entries->debit_credit}}  Voucher

    @else
    भुगतान वाउचर / {{$entries->debit_credit}}  Voucher
    @endif  
     </strong></th>
  </tr>
  
  </table>
  <div style="height:3px;font-size:3px;">&nbsp;</div>
  <table class="exclude-css">
  <tr>
    <td colspan="3" style="text-align:left;"><p style="font-family: mukta; font-size: 14px;">&nbsp;पीएफएमएस स्कीम / PFMS Scheme: {{$entries->pfmss->name}} </p>  </td>
  </tr></table>
  <div style="height:3px;font-size:3px;">&nbsp;</div>
  <table>
  <tr>  
                         <th style="width:30% ; font-family: mukta; font-size: 15px;" >उद्यम का नाम / Name of the Firm</th>
                     <th  style="text-align:left; width:70% ; font-family: Arial, Helvetica, sans-serif;" colspan="2">{{$entries->vendors->name}}</th></tr>
                      <tr>
                        <td colspan="3" style="font-family: mukta; font-size: 14px; text-align: justify; text-justify: inter-word;"  >
                        लाभार्थी खाता सं./Benificiary Account No : {{$entries->vendors->Account_Number}}, 
                        बैंक/Bank : {{$entries->vendors->Bank_Name}}, 
                        IFSC : {{$entries->vendors->IFS_Code}}, 
                        PFMS Code : {{$entries->vendors->Contract1}},
                        जीएसटी सं./GST No : {{$entries->vendors->gst}}, 
                        पैन/PAN : {{$entries->vendors->Income_Tax}}, 
                        मेल/Mail : {{$entries->vendors->Mail_ID}}
                        
                          </td>
</tr>
</table>
<div style="height:3px;font-size:3px;">&nbsp;</div>
<table class="exclude-css">
<tr><td  style="text-align:left;"> <p style="font-family: mukta; font-size: 14px;">&nbsp;क्र.आ./ठेका/अनुबंध संख्या | PO/Contract / Agmt Number : {{$entries->po}}</p></td></tr>
</table>
<div style="height:3px;font-size:3px;">&nbsp;</div>

 <?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?>
           <table id="timothy"> <tr>
                   <th width="30%" style="font-family: mukta; font-size: 18px;">बजट शीर्ष / Budget Head</th>
                   <th width="25%" style="font-family: mukta; font-size: 18px;"> उप शीर्ष / Sub Head</th>
                    <th width="35%"  style="font-family: mukta; font-size: 18px;"> लेडजर / Ledger</th>
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
             
        @if( $ledger->ledger == 'NULL' or $ledger->ledger == '')
        <td width="25%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">&nbsp;</td>
        @else
        <td width="35%" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">{{$ledger->ledgers->name}}</td>
        @endif
          
          <td width="10%" align="right" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">{{$ledger->amount }} {{ $ledger->cr_dr}} </td>
          
      
        </tr>
        
      @endforeach  
                 <tr>
    
  <td width="75%" align="right" colspan="3" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px;"><b> Net :</b></td>
  
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
            <p>Submitted by {{$raj = $entries->entereds->names->name}}</p>
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
        @if($entries->pfms == 940 )

        <td style="text-align:right;font-family: sans-serif; font-size: 14px;"> <p style="font-family: mukta; font-size: 16px;"><b> राष्ट्रीय संयोजक</b></p> <b> National Coordinator</b></td>

        @else
        <td style="text-align:right;font-family: sans-serif; font-size: 14px;"> <p style="font-family: mukta; font-size: 16px;"><b> अनुभाग/विभाग प्रभारी/अधिकारी </b></p> <b> Section/Department Incharge/Officer</b></td>

        @endif
      
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
    @if($entries->pfms == 940 )
    <b> आहरण एवं वितरण अधिकारी /</b><b> Drawing and Disbursing Officer</b>  
    @elseif($entries->bank == 6338 )
    <b> वरिष्ठ संयुक्त कुलसचिव (छात्र कार्यालय)/</b><b> Sr. Joint Registrar (Students office)</b>  
    
    @else
    @if ($leg >= 50001) 
    <b> आहरण एवं वितरण अधिकारी /</b><b> Drawing and Disbursing Officer</b>  
    @else
    @if ($entries->id  < 58261 )
    <b> उप कुलसचिव (वि. एवं ले.)/</b><b> Deputy Registrar (F&A)</b>
    @else <b> संयुक्त कुलसचिव (वि. एवं ले.)/</b><b> Joint Registrar (F&A)</b> @endif
    @endif @endif</th>
  </tr>


        </table>
               
                    
        <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">

                <table class="exclude-css">
  <tr>
    <th style="font-family: mukta; font-size: 16px; text-align:center;"><b> वित्त एवं लेखा अनुभाग/ </b><b> F&A Section</b>  </th>
    </tr>
    <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 0px; margin-bottom: 0x;">
    <tr>
      
    <th style="font-family: mukta; font-size: 15px; text-align:left;"><b> भुगतान किये गए रु./</b><b> Paid a sum of Rs :</b> <b style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; text-align:left;"> {{$ledge->sum('amount')}}</b></th>
  </tr>
  <tr>
    <th style="font-family: mukta; font-size: 15px; text-align:left;"><b> कुल राशि शब्दों में/</b><b> Net Amount in words :</b> Rupees {{$result}}</th>
  </tr>


        </table>

        <table class="exclude-css">
<tr> 
  <th width="70%" style="font-family: mukta; font-size: 15px; text-align:left;">द्वारा नकद/चेक सं. / by Cash/Cheque No:<span style="color: red;"> @if($entries->chequeno == 0)&nbsp;</span>@else {{$entries->chequeno}} </span>@endif</span></th>
  <th width="30%" style="font-family: mukta; font-size: 15px; text-align:left;"> दिनांक / Dated: <span style="color: red;">{{$entries->transactiondate}}</span></th></tr>
        </table>

<br><br><br><br>
        <table class="exclude-css">
<tr> 
  <th style="font-family: mukta; font-size: 15px; text-align:left;"> रोकडिया / Cashier </th>
  <th style="font-family: mukta; font-size: 15px; text-align:right;"> @if ($leg >= 50001)<b>उप कुलसचिव (वि. एवं ले.)/ Deputy / Joint  Registrar (F&A)</b>@else<b>उप कुलसचिव (वि. एवं ले.)/Assistant Registrar (F&A)</b>@endif</th></tr>
        </table>
                 <b></b><br>
               <br>
              
                       <br>
                  



                   
                      

                  <p style="text-align: left; width:49%; display: inline-block;"><b>  </b></p>
                  <p style="text-align: right; width:50%;  display: inline-block;">
                  </p>
                  </b></p>
                    @if($entries->vendor == 518 )

                    <p id="jin" style="color:blue;font-size:0px;"></p>
                    <table id="timo"><tr>
                            <th colspan="7"><span style="margin:auto; display:table; font-size:120%;"> Bulk Payment Breakup for S.No. {{$entries->id}}  </span></th>
                        </tr> <tr>
                            <th style ="width:10%;" align="center" >S No</th>
                            <th style ="width:30%;" align="center" >Firm Name</th>
                            <th style ="width:20%;" align= "center">Bank Account</th>
                            <th style ="width:10%;" align="center" >Gross</th>
                            <th style ="width:10%;"align= "center">Income Tax</th>
                            <th style ="width:10%;"align= "center">Profssional Tax</th>
                            <th style ="width:10%;"align="center" >Net</th>
                                </tr>

                                @php($count=0)
                              
                              @foreach($bulk as $entries)
     
                                <tr>
                                  <td style ="width:5%; font-size: 15px;">{{++$count}}</td>
                                  <td style ="width:30%; font-size: 15px;">{{$entries->vendors->name}}</td>
                                  <td style ="width:30%; font-size: 15px;">{{$entries->vendors->Account_Number}}</td>
                                  <td style ="width:10%; font-size: 15px;">{{$entries->gross}}</td>
                                  <td style ="width:10%; font-size: 15px;">{{$entries->tds}}</td>
                                  <td style ="width:5%; font-size: 15px;">{{$entries->ptax}}</td>
                                  <td style ="width:10%; font-size: 15px;">{{$entries->net}}</td>

    
                                    @endforeach
                                    <tr>
                                  <td colspan="3" align="right" ><b>Total&nbsp;</b> <br></td>
                                  <td align="center"><b>{{$bulk->sum('gross')}} </b> <br></td>
                                  <td align="center"><b>{{$bulk->sum('tds')}}</b><br></td>
                                  <td align="center"><b>{{$bulk->sum('ptax')}}</b><br></td>
                                  <td align="center"><b>{{$bulk->sum('net')}}</b><br></td>

                                    </tr>
                                                              </table>


                                                              <br><br><br><br>
                                                              <table class="exclude-css">
    <tr>
        <td class="tiny" style="text-align:left;">
            <p>Submitted by {{$raj }}</p>
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
                                                      @endif
                                                      <ul>
                                                     






</ul>

                                   </div></div></div></div>           
                                   
                                   

                                                       