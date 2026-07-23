@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Receipt</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Receipt Vouchers</h4>

                      <div class="pull-right">
                @can('voucher-create')
                <a class="btn btn-success" href="{{ route('receipt.create') }}"> New Receipt Entry</a>
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
                  <th class="wd-15p">Entered</th>
            
                  <th class="wd-15p">amount</th>
                  <th class="wd-10p">vendor </th>
                  <th class="wd-10p">Project </th>
                  <th class="wd-10p">Sub Head </th>
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
      @if ($payorder->ledger->costcentre == 'NULL')
      <td>Not Exists</td>
      @else
      <td>{{$payorder->ledger->costcentres->Projectcode}}</td>
      @endif
      <td>@if($payorder->ledger->sub == 0)  Does not exists  @else  {{$payorder->ledger->subs->head}} @endif</td>
			
			<td><form action="{{ route('receipt.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                    
                    @can('voucher-edit')
                    <a class="btn btn-primary" target="_blank" href="{{ route('receipt.edit',$payorder->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('voucher-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection