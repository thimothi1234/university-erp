@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Advance</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Advance Vouchers</h4>

                      <div class="pull-right">
                @can('voucher-create')
                <a class="btn btn-success" href="{{ route('advance.create') }}"> New Voucher Entry</a>
                @endcan
            </div>


										</div>
          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                <th class="wd-15p">S.No</th>
                  <th class="wd-15p">Entered on</th>
            
                  <th class="wd-15p">amount</th>
                  <th class="wd-15p">vendor </th>
                  <th class="wd-15p">Status </th>
         
                  <th class="wd-15p">Settled Amount </th>
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
			<td>{{$payorder->created_at}}</td>
			
    
      <td>{{$payorder->sum}}</td>
 
      <td>{{$payorder->vendors->name}}</td>
      <td>

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
    
      <td>@php $gross = $grossMap[$payorder->id] ?? null; @endphp
      @if ($gross == '')
      @else
    {{$gross->sum}}  
    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$gross->id) }}">Settlement</a>
    @endif
    </td> 
			
			<td><form action="{{ route('voucher.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                    <a class="btn btn-primary" target="_blank" href="{{ url('settle',$payorder->id) }}">Settle</a>
                    @if ($payorder->status == 4 or $payorder->status == 'paid')
                    

                    @else
                    <a class="btn btn-primary" target="_blank" href="{{ route('voucher.edit',$payorder->id) }}">Edit</a>
                    @endif
                  

</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection