@foreach ($query as $payorder)
    <div class="transaction">
    <tr>
      <td style="white-space:normal;">{{$payorder->id}}</td>
      <td style="white-space:normal;">{{$payorder->sum}}</td>

      <td style="white-space:normal;">{{$payorder->ven}}</td>
      <td style="white-space:normal;">

      @if ($payorder->status == 1)
      <span class="badge badge-pill badge-primary">Pending with AR(F&A)</span>
      @elseif ($payorder->status == 2)
      <span class="badge badge-pill badge-primary">Pending with DDO</span>
      @elseif ($payorder->status == 3)
      <span class="badge badge-pill badge-primary">Pending with DR(F&A)</span>
      @elseif ($payorder->status == 4)
      <span class="badge badge-pill badge-primary">Pending with Cashier to issue cheque </span>
      @elseif ($payorder->status == 'paid')
      <span class="badge badge-pill badge-success">Transaction Sucess with Cheque {{$payorder->chequeno}} dated  {{$payorder->transactiondate}}</span>
      @endif


      </td>
      <td style="white-space:normal;">{{$payorder->debit_credit}}</td>
   
    
      
			<td style="white-space:normal;"><form action="{{ route('voucher.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                    
                  
     
              
                  

</td>
			</tr>
    </div>
@endforeach

{{ $query->links() }} <!-- Display pagination links -->
