@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyledgers</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Employees</h4>


                      @can('staff-create')
            <a class="btn btn-success" href="{{ route('staff.create') }}"> New Staff</a>
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
                  <th class="wd-15p">eid</th>
                  <th class="wd-20p">name</th>
                  <th class="wd-20p">designation</th>
                  <th class="wd-15p">category</th>
                  <th class="wd-10p">dob</th>
                  <th class="wd-10p">department</th>
                  <th class="wd-10p">email</th>
                  <th class="wd-10p">mobile</th>
                  <th class="wd-10p">pan</th>
                  <th class="wd-10p">created at</th>
                  <th class="wd-10p">updated at</th>


                </tr>
              </thead>
              <tbody>
              
              @foreach($payorders as $payorder)
			<tr>
			<td>{{$payorder->id}}</td>
			<td>{{$payorder->eid}}</td>
			<td>{{$payorder->name}}</td>
      <td>{{$payorder->designation}}</td>
      <td>{{$payorder->category}}</td>
      <td>{{$payorder->dob}}</td>
      <td>{{$payorder->department}}</td>
      <td>{{$payorder->email}}</td>
      <td>{{$payorder->mobile}}</td>
      <td>{{$payorder->pan}}</td>
			<td>{{$payorder->created_at->diffForHumans()}}</td>
			<td><a href="{{url('/add/vouchertype/edit/'.$payorder->id)}}" class="btn btn-outline-primary">Edit</a>
				<a href="{{url('/add/vouchertype/delete/'.$payorder->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a></td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
                
           
@endsection