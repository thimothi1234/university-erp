@extends('project.admin_master')

@section('project')





<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">Budget Head</a>
        <span class="breadcrumb-item active">Sub head</span>
      </nav>

                                <div class="row">
								<div class="col-lg-6">
								
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Create new sub head under {{$payorders->name}}</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('budgetsub.create') }}" method="POST">
                                            @csrf

                                            
										<div class="form-group">
													<label for="exampleFormControlInput1">Sub head Name</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="head" placeholder="Budget sub Head">
                                                    @error('head')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>		
												<div class="form-group">
													<label for="exampleFormControlInput1">Sanction Amount</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="amount" placeholder="Sanction Amount">
                                                    @error('amount')
                                                    <span class="text-danger">{{ $message}}</span>
                                                    @enderror	
												</div>	
												<input type="hidden" name="project_id" value="{{$payorders->id}}">
											<div class="form-group">
											<button type="submit" class="btn btn-primary">Create sub Head</button>
											</div>
										
											</form>
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
               
                  <th class="wd-15p">Name</th>
                  <th class="wd-10p">Sanctioned amount</th>
                </tr>
              </thead>
              <tbody>
              
              @foreach($sub as $payorder)
              
			<tr>
		
			<td>{{$payorder->head}}</td>
			
      <td>{{$payorder->amount}}</td>
     
     
		
	
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
      


    <script type="text/javascript">
	$(document).ready(function(){
        

		$('.myselection').select2(
            {theme: "classic"
            }
        );
        
   });


</script>

                                    @endsection
