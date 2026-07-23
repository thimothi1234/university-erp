@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">bankaccounts</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Banka Accounts Table</h4>

											<a href="{{url('add/bankaccounts/insert')}}" class="btn btn-primary">Insert</a>
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
                  <th class="wd-15p">Account Number</th>
                  <th class="wd-20p">Name</th>
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
			<td><a href="{{url('/add/bankaccounts/edit/'.$payorder->id)}}" class="btn btn-outline-primary">Edit</a>
				<a href="{{url('/add/bankaccounts/delete/'.$payorder->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a></td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection