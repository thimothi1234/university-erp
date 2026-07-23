
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
}

    </style>
</head>
<body>
    
<div class="container">
            <div class="col-md-10">
            <div class="card">
    <div class="invoice-box">

    <h2>Voucher Breakup</h2>
   <table>
   <tr>
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
                   <b>
    
        
         <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
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



    

                                   </div></div></div></div>                               
                                     