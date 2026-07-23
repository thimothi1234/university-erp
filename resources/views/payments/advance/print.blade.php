
    <title>Print Voucher</title>
    <link rel = "icon" href = 
"logo.jpg" 
        type = "image/x-icon">
    <style>

    
   
    

@page {
    size: A4;   
} 

@media print {
  html, body {
    width: 216mm;
    height: 297mm;
    
  } 
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
        span {
                
    
                font-size: 15px;
            }
        
        
           p {
  width: 800px; 
  ;
}

p.a {
  
  display:block;
    width:100%;
    word-wrap:break-word;
}
}

    </style>
</head>
<body>
    
<div class="container">
            <div class="col-md-10">
            <div class="card">
    <div class="invoice-box">
    <div align="left">  <h1  >&nbsp; Forwarding Section:<span style="color: red;">{{$entries->id}}</span> </h1> </div>
       <h3>&nbsp;
           
      
       @if ($entries->debit_credit == 'Receipt' ) Bvr No : 
        @else
       Voucher No : @endif<span style="color: red;">
       @if($entries->voucherno_bvrno == 0)
       &nbsp;</span>
       @else
       {{$entries->voucherno_bvrno}} </span>
      @endif
      </h3>
       
       <h5> <img src="logo.jpg" alt="Trulli" align="center" width="40" height="40">IIT HYDERABAD</h5>



       

 <p align ="center">
<B>Finance & Accounts<br> <?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?></B>
 
   NH-9, Kandi- 502284</p>
                <h2><strong>{{$entries->debit_credit}}  Voucher </strong></h2>
        
       
                            <h2>   <b> PFMS Scheme:</b> {{$entries->pfms}}  </h2>
                          
                             <table style="width:100.4%">  <tr>
    
                         <td width="20%" ><b> 
                            Name of the Firm
                            
                               
                              </b></td>
                
                     <td width="80%" style="text-align:left;" >   <b> &nbsp;{{$entries->vendors->name}}</b></td></tr></table>
                          
                     <h2>         Benificiary Account No. {{$entries->vendors->Account_Number}}&nbsp;&nbsp;&nbsp;IFSC :{{$entries->vendors->IFS_Code}}&nbsp;&nbsp;&nbsp;
                        Bank :{{$entries->vendors->Bank_Name}}&nbsp;&nbsp;&nbsp;<br>Branch :{{$entries->vendors->Branch}}<br>
                        GST No:{{$entries->vendors->gst}}&nbsp;&nbsp;&nbsp;PAN:{{$entries->vendors->Income_Tax}}&nbsp;&nbsp;&nbsp;Mail:{{$entries->vendors->Mail_ID}}</h2>
                                
                                <b> PO/Contract / Agmt Number :</b> {{$entries->po}}
                 
          <div height="870" style="border:solid 1px #ccc">
           <table> <tr>
                   <th width="25%" align= "center">Budget Head</th>
                   <th width="25%" align= "center">Sub Head</th>

    <th width="35%" align="center" >Ledger</th>

    <th width="15%" align= "center">Amount</th>
  </tr>

  
  @foreach($ledger as $ledger)
       
        <tr>
        @if( $ledger->costcentre == 'NULL' or $ledger->costcentre == '')
        <td width="25%">&nbsp;</td>
        @else
        <td width="25%">{{$ledger->costcentres->name}}</td>
        @endif
      
        @if( $ledger->sub == 0)
        <td width="25%">&nbsp;</td>
        @else
        <td width="25%">{{$ledger->subs->head}}</td>
        @endif
             
        @if( $ledger->ledger == 'NULL' or $ledger->ledger == '')
        <td width="25%">&nbsp;</td>
        @else
        <td width="35%">{{$ledger->ledgers->name}}</td>
        @endif
          
          <td width="15%" align="right">{{$ledger->amount }}<b> {{ $ledger->cr_dr}} </b></td>
          
      
        </tr>
        
      @endforeach  
    
     
        
  
  

               
        
                 <tr>
    
  <td width="75%" align="right" colspan="3"><b> Net :</b></td>
  
             <td width="25%" align="right" >  <b> {{$ledge->sum('amount')}} </b></td></tr>
               
         
                    </table>
                              </div>
            <p class="a">
                   <b>Narration :{{$entries->narration}}</p>
               
                   <b>This is to certify that the purchases/services have been made to meet the needs of IIT Hyderabad.</b>
               <br>     
               <br><br>
                    <p dir="ltr"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$entries->entereds->names->name}}   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br>
                       <b> Dealing Assistant of Forwarding Section</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> Section/Deparment Incharge/Officer</b>
                    </p>
         <hr>
        
         <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number  = $ledge->sum('amount');
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

               <b> Approved payment of Rs:</b>  {{$ledge->sum('amount')}}<br><br>
               <b> Net Amount in words :</b>Rupees {{$result}}<br>
               <p dir="ltr">
                       <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> Drawing and Disbursing Officer</b>
                    </p><hr>
               <b>F&A SECTION</b><br>
               <br>
               <b> Paid a sum of Rs :</b>  {{$ledge->sum('amount')}}<br>
               <b> Net Amount in words :</b> Rupees {{$result}}<br>
               <p dir="ltr">
                     <b>  by Cash/Cheque No: <span style="color: red;"></span></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> Dated: <span style="color: red;">
                       
                    </span></b>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> UTR NO: <span style="color: red;"></span></b>
                       </p>
                       <br>
               <p dir="ltr">
                    <b>   Cashier </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>  Deputy  Registrar (F&A)</b></p>
                    @if($entries->vendor == 518 )

                    <h6></h6>
                    <table><tr>
                            <th colspan="7"><span style="margin:auto; display:table; font-size:120%;"> Bulk Payment Breakup</span></th>
                        </tr> <tr>
                            <th width="10%" align="center" >S No</th>

    <th width="30%" align="center" >Firm Name</th>
    <th width="20%" align= "center">Bank Account</th>
    <th width="10%" align="center" >Gross</th>
    <th width="10%" align= "center">Income Tax</th>
        <th width="10%" align= "center">Profssional Tax</th>

     <th width="10%" align="center" >Net</th>
     

  </tr>

  @php($count=0)
 
 @foreach($bulk as $entries)
        
        
  <tr>
   <td width="5%">{{++$count}}</td>
    <td width="30%">{{$entries->vendors->name}}</td>
    <td width="30%">{{$entries->vendors->Account_Number}}</td>
    <td width="20%">{{$entries->gross}}</td>
    <td width="10%">{{$entries->tds}}</td>
    <td width="10%">{{$entries->ptax}}</td>
    <td width="25%">{{$entries->net}}</td>

    
  @endforeach
  <tr>
<td colspan="3" align="right"><b>Total </b> <br></td>
<td align="left">{{$bulk->sum('gross')}}<br></td>
<td align="left">{{$bulk->sum('tds')}}<br></td>
<td align="left">{{$bulk->sum('ptax')}}<br></td>
<td align="left">{{$bulk->sum('net')}}<br></td>

  </tr>
                             </table>



                    @endif
                    
                    


    

                                   </div></div></div></div>                               
                                     