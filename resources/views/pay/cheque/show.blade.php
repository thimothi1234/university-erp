

<html>
<head>
   
   
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="src/jquery.table2excel.js"></script>
    <meta charset="utf-8">
    <title>Voucher Print</title>
    
    <style>
       @page {
    size: A4;   
}

@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }  
}
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:20px;
        font-size:16px;
        line-height:18px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
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

th {
  height: 25px;
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
                margin: 2px 0;
                box-sizing: border-box;
                font-size: 16px;
                border: 1px solid #000000;
                -webkit-transition: 0.5s;
                transition: 0.5s;
                outline: none;
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
           p {
  width: 800px; 
  ;
}

p.a {
  word-break: break-all;;
}
        
    @media print {
  html, body {
    width: 216mm;
    height: 297mm;
  }  
    
        #btn-export {
    display: none;
  }
        }

        table.exclude-css, table.exclude-css tr, table.exclude-css td, table.exclude-css th {
  border: none;
}
    </style>
</head>


<body>
   <div id="source-html">


<?php $today = date("m");
         $today1 = date("Y");
        $today2 = date("Y+1");
    $today3 = date(" F j, Y",strtotime($ledger->transactiondate));
    $today9 = date("F j, Y",strtotime($ledger->transactiondate));
    $counter = 0;
    
   if (date('m') <= 3) {//Upto June 2014-2015
    $financial_year = (date('y')-1) . '-' . date('y');
} else {//After June 2015-2016
    $financial_year = date('y') . '-' . (date('y') + 1);
}
   
        
        ?>
		<?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number  = $post->sum('sum');
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
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
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


   

    <div class="container">
            <div class="col-md-10">
            <div class="card">
    <div class="invoice-box">

      
    <table class="exclude-css">
        <tr>
          <td style="text-align: left;"><img src="logo.png" alt="IITH"  width="330" height="85"> </td>
          <td style="text-align: right;"><br>Finance & Accounts <br>Room 201, Admin Block, IIT Hyderabad <br>Phone : 23017060 <br> Mail:office.accounts@iith.ac.in</td>
        </tr>
      </table>  
        
 <hr>
 <?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?>
 
   
               <strong style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp; Bank Advice </strong>
        <hr>
    <p style="text-align:left">
    Date :<?php echo $today3?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 Lt No: IITH/F&A/<?php echo $today?>/<?php echo $financial_year?>/{{$ledger->chequeno}}</p>
               <br>
                  
    <p dir="ltr">
                  To<br>The Manager<br>{{$tallu->Bank_Name}} Bank<br>IIT Hyderabad<br>Kandi -502285.<br><br>Dear Sir,<br></p>
                 
				  <p style="text-align:justify">This is to request you to transfer a sum of Rs.<b>{{$post->sum('sum')}}/- <?php echo "(Rupees " .$result .  " Only)"  ?></b> from Account No :<b>{{$tallu->tally}}</b> to the following Account No’s through Cheque No.:<b>{{$ledger->chequeno}}</b> dated : <b> {{$today9}}.</b></p>

<div >







<br>


<table style="table-layout: fixed; width: 800px; border:1;" class="table">
<tr>
    <th style="width: 5%;text-align:center" >S.No.</th>
    <th style="width: 15%;text-align:center" >Amount</th>
    <th style="width: 25%;text-align:center">REMITTER A/C NO</th>
    <th style="width: 20%;text-align:center">BEN A/C NO</th>
    <th style="width: 20%;text-align:center">	BEN NAME</th>
	<th style="width: 15%;text-align:center">		IFSC CODE</th>
    
</tr>
<tbody>
@foreach($post as $buddy)
<tr>
<td  style="width: 5%; text-align:center">{{$loop->iteration}}</td>
<td style="width: 15%; text-align:center">{{$buddy->sum}}</td>
<td style="width: 25%;text-align:center">{{$buddy->tally}}</td>
<td style="width: 20%;text-align:center">{{$buddy->Account_Number}}</td>
<td style="width: 15%;text-align:center">{{$buddy->ven}}</td>
<td style="width: 15%;text-align:center">{{$buddy->IFS_Code}}</td>


</tr>
@endforeach

<tr>
	<td><B>Tot:</B></td>
    <td ><b>₹{{$post->sum('sum')}}</b> </td>
	<td colspan = "4"><b><?php echo "Rupees " .$result .  " Only"  ?></b></td>
   
    </tr>
</tbody>
</table>
<br>


                   
                   <br>
                   <br>
                   <br> <br> <br> <br> <br> <br>
				   
                   <span style="float:left;">Thanking you with regards</span>

<span style="float:right;">Authorized Signatory</span>

<br> <br> <br> <br> <br> 


<div class="content-footer"><BR>
              <button id="btn-export" onclick="exportHTML();">Export to
        word doc</button>
                 <button id="btn-export" onClick="window.print();">Print</button>   
</div></div></div></body></html>


<button onclick="exportHTML()">Export to Word</button>

    <script>
        function exportHTML(){
            var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
                         "xmlns:w='urn:schemas-microsoft-com:office:word' "+
                         "xmlns='http://www.w3.org/TR/REC-html40'>"+
                         "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
            var footer = "</body></html>";
            var sourceHTML = header + document.getElementById("source-html").innerHTML + footer;
            
            var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
            var fileDownload = document.createElement("a");
            document.body.appendChild(fileDownload);
            fileDownload.href = source;
            fileDownload.download = 'document.doc';
            fileDownload.click();
            document.body.removeChild(fileDownload);
        }
    </script>

</nowrap></nobr>
</body>
</html>
