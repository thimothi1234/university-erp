
    <title>Print Voucher</title>
    <style>
       @page {
    size: letter;   
}

@media print {
  html, body {
    width: 216mm;
    height: 297mm;
  }  
    
    #printPageButton {
    display: none;
  }
    
}
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        font-size:17px;
        line-height:16px;
        font-family: "Times New Roman", Times, serif;
        color:#000;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:10px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:30px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:20px;
    }
    
 
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
   
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
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
                font-size: 30px;
                outline: none;
            }
        span {
                
    
                font-size: 15px;
            }
        
        
           p {
  width: 800px; 
  ;
}

p.a {
  word-break: break-all;;
}
    </style>
</head>
<body>
    
<div class="container">
            <div class="col-md-10">
            <div class="card">
    <div class="invoice-box">
    <div align="left">  <h1  >&nbsp; Forwarding Section:<span style="color: red;">{{$entries->id}} </span> </h1> </div>
       <h3>&nbsp;
           
       @if ($entries->debit_credit == 'Receipt' ) Bvr No : 
        @else
       Voucher No : @endif<span style="color: red;">{{$entries->voucherno_bvrno}} </span></h3>
       
 <h5> <img src="{{asset('logo.jpg')}}" alt="Trulli" align="center" width="50" height="50"> IIT HYDERABAD </h5>

 <p align ="center">
<B>
R&D<?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?></B></p>
  <p align ="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   NH-9, Kandi- 502285, Phone : 2301 7060</p>
                <h2><strong>{{$entries->debit_credit}} Voucher </strong></h2>
        
        
        
        
        
        
       
                            <h2>   <b> PFMS Scheme:</b> {{$entries->pfms}} </h2><br>
                          
                             <table style="width:100%">  <tr>
    
                         <td width="30%" ><b> 
                            Name of the Firm/Person On
                            whom Cash/DD/Cheque to be
                               :
                              </b></td>
                
                     <td width="50%" style="text-align:left;" >   <b>{{$entries->vendors->name}}</b></td></tr></table>
                          
                        <h2>         Benificiary Account N.o {{$entries->vendors->acno}}&nbsp;&nbsp;&nbsp;IFSC :{{$entries->vendors->ifsc}}&nbsp;&nbsp;&nbsp;
                        Bank :{{$entries->vendors->bankname}}&nbsp;&nbsp;&nbsp;<br>Branch :{{$entries->vendors->branch}}<br>
                        GST No:{{$entries->vendors->gst}}&nbsp;&nbsp;&nbsp;PAN:{{$entries->vendors->pan}}&nbsp;&nbsp;&nbsp;Mail:{{$entries->vendors->mail}}</h2>
                                
                                <b> PO/Contract / Agmt Number :</b> {{$entries->po}}
                 
          <div height="870" style="border:solid 1px #ccc">
           <table> <tr>
                   <th width="25%" align= "center">Project</th>
                   <th width="25%" align= "center">Head</th>

    <th width="35%" align="center" >Ledger</th>

    <th width="15%" align= "center">Amount</th>
  </tr>

  
        
    
        @foreach($ledger as $ledger)
        
  <tr>
  @if( $ledger->costcentre == 'NULL')
  <td width="25%">&nbsp;</td>
  @else
  <td width="25%">{{$ledger->costcentres->name}}</td>
  @endif

  @if( $ledger->sub == 0)
  <td width="25%">&nbsp;</td>
  @else
  <td width="25%">{{$ledger->subs->head}}</td>
  @endif
       


    <td width="35%">{{$ledger->ledgers->name}}</td>
    <td width="15%" align="right">{{$ledger->amount }}<b> {{ $ledger->cr_dr}} </b></td>
    

  </tr>
  
@endforeach
               
        
                 <tr>
    
  <td width="75%" align="right" colspan="3"><b> Net :</b></td>
  
             <td width="25%">  <b>  {{$ledge->sum('amount')}}</b></td></tr>
                    <br>
         
                    </table>
                              </div>
            <p class="a">
                   <b>Description of Services Rendered :{{$entries->narration}}</p>
               
                   <b>This is to certify that the purchases have been made to meet the needs of IIT Hyderabad.</b>
               <br>     
               <br><br>
                    <p dir="ltr"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{$entries->entered}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br>
                       <b> Dealing Assistant of Forwarding Section</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       
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
               <b> Net Amount in words :</b> {{$result}}<br>
               <p dir="ltr">
                       <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> Drawing and Disbursing Officer</b>
                    </p><hr>
               <b>R&D SECTION</b><br>
               <br>
               <b> Paid a sum of Rs :</b>  {{$ledge->sum('amount')}}<br>
               <b> Net Amount in words :</b> {{$result}}<br>
               <p dir="ltr">
                     <b>  by Cash/Cheque No: <span style="color: red;">{{$entries->chequeno}}</span></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <b> Dated: <span style="color: red;">
                       {{ \Carbon\Carbon::parse($entries->transactiondate)->format('d/M/Y')}}
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                      <b>  Deputy  Registrar (R&D)</b></p>
                    @if($entries->vendor == 518 )

                    
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
  @php($count++) 
 @foreach($bulk as $entries)
        
        
  <tr>
   <td>{{$count}}</td>
    <td width="30%">{{$entries->vendors->name}}</td>
    <td width="30%">{{$entries->vendors->Account_Number}}</td>
    <td width="20%">{{$entries->gross}}</td>
    <td width="10%">{{$entries->tds}}</td>
    <td width="10%">{{$entries->ptax}}</td>
    <td width="10%">{{$entries->net}}</td>

    
  @endforeach
  <tr>
<td colspan="3" align="right"><b>Total</b> <br></td>
<td align="left">{{$bulk->sum('gross')}}<br></td>
<td align="left">{{$bulk->sum('tds')}}<br></td>
<td align="left">{{$bulk->sum('ptax')}}<br></td>
<td align="left">{{$bulk->sum('net')}}<br></td>

  </tr>
                             </table>



                    @endif
                    
                    


    
<button id="printPageButton" class="btn btn-primary btn-sm" onClick="window.print();">Print</button>
                                   </div></div></div></div>                             
                                     