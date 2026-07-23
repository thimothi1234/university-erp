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

                      @can('project-create')
            <a class="btn btn-success" href="{{ url('bulkinward') }}"> Process


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
                <th class="wd-15p">Select</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-20p">vendor</th>
                  
               
                  
                  <th class="wd-10p">Date</th>
                  <th class="wd-10p">Status</th>
                  <th class="wd-10p">ACTION</th>


                </tr>
              </thead>
              <tbody>
              
              @foreach($payorders as $payorder)
          <form action="{{ url('bulkinward') }}"  method="POST" enctype="multipart/form-data">
          @csrf
			<tr>
			<td><input type="checkbox" name="iid[]" value="{{$payorder->id}}"></td>
			<td>{{$payorder->name}}</td>
			<td>{{$payorder->vendor}}</td>
   
      
     
			<td>{{$payorder->created_at->diffForHumans()}}</td>
      <td>
    
     </td>
			<td>
                    <a class="btn btn-primary" href="{{ url('ceaprocess',$payorder->id) }}">Process</a>
                   


                    </td>
			</tr>
       
			@endforeach
      <button type="submit" class="btn btn-primary">process ✓</button>
      </form> 
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
           
@endsection