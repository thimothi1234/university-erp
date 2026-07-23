@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Add</a>
        <a class="breadcrumb-item" href="">Budget Head</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Budget Heads</h4>

                      @can('project-create')
            <a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Budget Head</a>
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
               
                  <th class="wd-15p">Name</th>
                  <th class="wd-10p">Avaliable Fund</th>
                  <th class="wd-10p">created at</th>
                  <th class="wd-10p">ACTION</th>


                </tr>
              </thead>
              <tbody>
              
              @foreach($payorders as $payorder)
              
			<tr>
		
			<td>{{$payorder->name}}</td>
			
      <td>{{$payorder->sanctioned}}</td>
     
     
			<td>{{$payorder->created_at}}</td>
			<td><form action="{{ route('projects.destroy',$payorder->id) }}" method="POST">
                
                    @can('project-edit')
                    <a class="btn btn-primary" href="{{ route('projects.edit',$payorder->id) }}">Edit</a>
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