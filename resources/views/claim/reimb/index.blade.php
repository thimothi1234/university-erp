@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Bills</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Claims</h4>

                      @can('claim-create')
            <a class="btn btn-success" href="{{ route('reimb.create') }}"> New Claim


            </a>
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
                <th class="wd-15p">ID</th>
                  <th class="wd-15p">Name</th>
                 
                  
                  <th class="wd-15p">amount</th>
                  
                  <th class="wd-10p">Date</th>
                  <th class="wd-10p">Approval</th>
                  <th class="wd-10p">Status</th>
                  <th class="wd-10p">ACTION</th>


                </tr>
              </thead>
              <tbody>
              
              @foreach($payorders as $payorder)
              
			<tr>
			<td>{{$payorder->id}}</td>
			<td>{{$payorder->name}}</td>
			
      <td>{{$payorder->amount}}</td>
      <td>{{$payorder->created_at->diffForHumans()}}</td>
      <td><a href="{{asset('uploads/'.$payorder->path)}}" target="_blank">Open</a></td>
      <td>{{$payorder->status}}</td>
      
     
			
    
			<td><form action="{{ route('projects.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('reimb.show',$payorder->id) }}">Show</a>
                    @can('project-edit')
                    <a class="btn btn-primary" href="{{ route('reimb.edit',$payorder->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('project-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
           
@endsection