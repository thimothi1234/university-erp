@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('contra.index') }}">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('contra.index') }}">Contra</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Contra Vouchers</h4>

                      <div class="pull-right">
                @can('voucher-create')
                <a class="btn btn-success" href="{{ route('contra.create') }}"> New Contra Entry</a>
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
                
              
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
			<td>{{$payorder->created_at->diffForHumans()}}</td>
			
    
      <td>{{$payorder->sum}}</td>
 
      <td>{{$payorder->vendors->name}}</td>
     
     
			
			<td><form action="{{ route('contra.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" target="_blank" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                    
                    @can('voucher-edit')
                    <a class="btn btn-primary" target="_blank" href="{{ route('contra.edit',$payorder->id) }}">Edit</a>
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