@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Payorders</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Payorder Type Table</h4>

                      @can('payorder-create')
            <a class="btn btn-success" href=""> Create New Role</a>
            @endcan
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
                  <th class="wd-15p">Name</th>
                  <th class="wd-20p">Group</th>
                  <th class="wd-15p">Created</th>
                  <th class="wd-10p">Action</th>
                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
			<td>{{$payorder->id}}</td>
			<td>{{$payorder->name}}</td>
			<td>{{$payorder->group}}</td>
			<td>{{$payorder->created_at->diffForHumans()}}</td>
			<td>
      @can('payorder-edit')
                <a class="btn btn-primary" href="">Edit</a>
            @endcan
            @can('payorder-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['payorders.destroy', $payorder->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div>
        </div>

@endsection