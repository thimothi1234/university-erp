@extends('project.admin_master')

@section('project')
    
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
    <br>
    <br>
    <br>
    <br>
<div class="container">
            
           
            <div class="col-md-10">
            <div class="card">
    <div class="invoice-box">
        
        
        

        
  
        

       
        <div align="left">  <h1  >&nbsp; Forwarding Section:<span style="color: red;">{{$entries->id}} </span> </h1> </div>
       <h3>&nbsp; Voucher No :<span style="color: red;">{{$entries->voucherno_bvrno}} </span></h3>
       
 <h5> <img src="{{asset('logo.jpg')}}" alt="Trulli" align="center" width="50" height="50"> IIT HYDERABAD </h5>
 <BR>
 <p align ="center">
<B>
R&D<?php $year = ( date('m') > 6) ? date('Y') + 1 : date('Y');?></B></p>
  <p align ="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   NH-9, Kandi- 502285, Phone : 2301 7060</p>
                <h2> CASH / BANK PAYMENT </h2>
        
        
        
        
        
        
       
                             <b> Bank Acount :</b> {{$ledgerr->ledgers->name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <h2>   <b> PFMS Scheme:</b> {{$entries->pfms}} </h2><br>
                            <h2>   <b> Project Code:</b> {{$entries->projects->Projectcode}} </h2><br>
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
                   <th width="40%" align= "center">costcentre</th>

    <th width="40%" align="center" >Ledger</th>

    <th width="20%" align= "center">Amount</th>
  </tr>

  
        
    
        @foreach($ledger as $ledger)
        
  <tr>
  @if( $ledger->costcentre == 'NULL')
  <td width="40%">&nbsp;</td>
  @else
  <td width="40%">{{$ledger->costcentres->name}}</td>
  @endif
       


    <td width="40%">{{$ledger->ledgers->name}}</td>
    <td width="20%" align="right">{{$ledger->amount }}<b> {{ $ledger->cr_dr}} </b></td>
    

  </tr>
  
@endforeach
               
        
                 <tr>
    
  <td width="75%" align="right" colspan="2"><b> Net :</b></td>
  
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
               <b> Approved payment of Rs:</b> {{$entries->amount}}<br><br>
               <b> Net Amount in words :</b> {{$entries->amount}}<br>
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
               <b> Paid a sum of Rs :</b> {{$entries->amount}}<br>
               <b> Net Amount in words :</b> {{$entries->amount}}<br>
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
                      
    
<button id="printPageButton" class="btn btn-primary btn-sm" onClick="window.print();">Print</button>



                                     </BR></BR></div></div></div></div>                             
                                     @endsection